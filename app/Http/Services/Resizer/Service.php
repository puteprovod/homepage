<?php

namespace App\Http\Services\Resizer;

use App\Models\ResizedImage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class Service
{
    public function resizeImages ($data): \Illuminate\Http\JsonResponse
    {
        $startTime = $this->getTime();
        $images = $data['images'];
        unset($data['images']);

        $token = substr(md5(Carbon::now() . '_' . $data['targetWidth'] . $data['targetHeight'] . $data['keepAspectRatio']), 0, 8);
        $folderPath = 'ResizedImages/' . $token;
        $folderPathPreview = 'ResizedImages/Previews/' . $token;

        Storage::disk('public')->makeDirectory($folderPath);
        Storage::disk('public')->makeDirectory($folderPathPreview);

        $widthTarget = (int)$data['targetWidth'];
        $heightTarget = (int)$data['targetHeight'];
        $targetAspectRatio = $widthTarget/$heightTarget;
        $keepAspectRatio = $data['keepAspectRatio'];
        $keepWidth = $data['keepWidth'];
        $keepHeight = $data['keepHeight'];

        $i = 0;
        $pyRequest = [];
        foreach ($images as $image) {

            $fileName = $image->getClientOriginalName();
            $imageTempPathName=$image->getPathName();
            $previewName = 'prev_' . $fileName;

            list($widthOriginal, $heightOriginal, $type, $attr) = getimagesize($imageTempPathName);

            $targetBox=$this->getTargetBox($widthTarget,$heightTarget,$widthOriginal,$heightOriginal,$keepWidth,$keepHeight,$keepAspectRatio,$targetAspectRatio);
            $targetThumbBox=$this->getTargetBox(80,80,$widthOriginal,$heightOriginal,'true','true',$keepAspectRatio,$targetAspectRatio);

            $pyRequest['images'][$i++] = [
                'id' => $i,
                'path' => $imageTempPathName,
                'filename' => 'storage/' . $folderPath . '/' . $fileName,
                'thumbfilename' => 'storage/' . $folderPathPreview . '/'.$previewName,
                'targetWidth' => $targetBox['width'],
                'targetHeight' => $targetBox['height'],
                'thumbWidth' => $targetThumbBox['width'],
                'thumbHeight' => $targetThumbBox['height'],
            ];

            ResizedImage::create([
                'token' => $token,
                'path' =>  $folderPath . '/' . $fileName,
                'url' => url('/storage/'. $folderPath. '/' . $fileName),
                'width' => $targetBox['width'],
                'height' => $targetBox['height'],
                'title' => $fileName,
                'extension' => $image->getClientOriginalExtension(),
                'preview_url' => url('/storage/'. $folderPathPreview . '/' . $previewName),
                'size' => 0
            ]);

        }
        $endTime = $this->getTime();
        $timeTaken = round(($endTime - $startTime), 2);


        $startTime = $this->getTime();
        $json=json_encode($pyRequest);
        file_put_contents("storage/".$folderPath.".json", $json);
        exec("python3 ../kart3.py storage/".$folderPath.".json", $output);

        $resizedImages=ResizedImage::all()->where('token',$token);
        foreach ($resizedImages as $item) {
            $item->update(['size' => ceil(filesize('storage/'.$item->path)/1000)]);
        }

        $endTime = $this->getTime();
        $timeTakenPy = round(($endTime - $startTime), 2);
        return response()->json(['status' => 'success', 'token' => $token, 'timeTaken' => $timeTaken, 'timeTakenPy' => $timeTakenPy, 'output' => $output]);

    }
    private function getTime(): float|int
    {
        return array_sum(explode(" ", microtime()));
    }
    private function getTargetBox($targetWidth, $targetHeight, $widthOriginal, $heightOriginal, $keepWidth, $keepHeight, $keepAspectRatio, $targetAspectRatio): array
    {
        $factWidth=$targetWidth;
        $factHeight=$targetHeight;
        $aspectRatio = $widthOriginal / $heightOriginal;
        if ($keepWidth === 'true' and $keepHeight === 'false')
            ($keepAspectRatio === 'true') ?
                $factHeight = round($targetWidth/$aspectRatio) :  $factHeight = $heightOriginal;

        if ($keepHeight === 'true' and $keepWidth === 'false')
            ($keepAspectRatio === 'true') ?
                $factWidth = round($targetHeight*$aspectRatio) : $factWidth = $widthOriginal;

        if ($keepHeight === $keepWidth)
            if ($keepAspectRatio === 'true')
                ($targetAspectRatio>$aspectRatio) ?
                    $factWidth = round($factHeight*$aspectRatio) : $factHeight = round($factWidth/$aspectRatio);

        return [
            'width' => $factWidth,
            'height' => $factHeight
        ];
    }
}
