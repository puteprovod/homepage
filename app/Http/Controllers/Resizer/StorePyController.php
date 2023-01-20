<?php

namespace App\Http\Controllers\Resizer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Resizer\StoreRequest;
use App\Models\ResizedImage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use JsonSerializable;
use Symfony\Component\Process\Process;

class StorePyController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $startTime = $this->getTime();
        $data = $request->validated();
        $images = $data['images'];

        unset($data['images']);
        $token = substr(md5(Carbon::now() . '_' . $data['targetWidth'] . $data['targetHeight'] . $data['keepAspectRatio']), 0, 8);
        $folderPath = '/ResizedImages/' . $token;
        $folderPathPreview = '/ResizedImages/Previews/' . $token;


        Storage::disk('public')->makeDirectory($folderPath);
        Storage::disk('public')->makeDirectory($folderPathPreview);
        $widthTarget = (int)$data['targetWidth'];
        $heightTarget = (int)$data['targetHeight'];
        $targetAspectRatio = $widthTarget/$heightTarget;
        $keepAspectRatio = $data['keepAspectRatio'];
        $keepWidth = $data['keepWidth'];
        $keepHeight = $data['keepHeight'];

        $i = 0;
        foreach ($images as $image) {

            $fileName = $image->getClientOriginalName();
            $imageExtension = $image->getClientOriginalExtension();
            $imageTempPathName=$image->getPathName();
            //$file1=Storage::disk('public')->putFileAs($folderPath, $image, 'orig_' . $fileName);

            $previewName = 'prev_' . $fileName;

            list($widthOriginal, $heightOriginal, $type, $attr) = getimagesize($imageTempPathName);

            $targetBox=$this->getTargetBox($widthTarget,$heightTarget,$widthOriginal,$heightOriginal,$keepWidth,$keepHeight,$keepAspectRatio,$targetAspectRatio);
            $factWidth=$targetBox['width'];
            $factHeight=$targetBox['height'];
            $targetThumbBox=$this->getTargetBox(80,80,$widthOriginal,$heightOriginal,'true','true',$keepAspectRatio,$targetAspectRatio);
            $factThumbWidth=$targetThumbBox['width'];
            $factThumbHeight=$targetThumbBox['height'];

            $pyRequest['images'][$i]['id'] = $i;
            //$pyRequest['images'][$i]['path'] = str_replace('/', '\\', 'storage\\' . $path1);
            $pyFile = 'ResizedImages/' . $token . '/' . $fileName;
            $pyFile2 = 'ResizedImages/' . $token . '/orig_' . $fileName;
            $pyRequest['images'][$i]['path'] = $imageTempPathName;
            //$pyRequest['images'][$i]['path'] = 'storage/' . $pyFile2;
            $pyThumbFile = 'ResizedImages/Previews/' . $token . '/prev_' . $fileName;
            $pyRequest['images'][$i]['filename'] = 'storage/' . $pyFile;
            $pyRequest['images'][$i]['thumbfilename'] = 'storage/' . $pyThumbFile;
            $pyRequest['images'][$i]['targetWidth'] = $factWidth;
            $pyRequest['images'][$i]['targetHeight'] = $factHeight;
            $pyRequest['images'][$i]['thumbWidth'] = $factThumbWidth;
            $pyRequest['images'][$i]['thumbHeight'] = $factThumbHeight;
            $i += 1;
            $fileSize = 0;

            ResizedImage::create([
                'token' => $token,
                'path' => 'ResizedImages/' . $token . '/' . $fileName,
                'url' => url('/storage/ResizedImages/' . $token . '/' . $fileName),
                'width' => $factWidth,
                'height' => $factHeight,
                'title' => $fileName,
                'extension' => $imageExtension,
                'preview_url' => url('/storage/ResizedImages/Previews/' . $token . '/' . $previewName),
                'size' => $fileSize
            ]);

        }
        $endTime = $this->getTime();
        $timeTaken = round(($endTime - $startTime), 2);


        $startTime = $this->getTime();
        $json=str_replace('"','"""',json_encode($pyRequest));
        $json=json_encode($pyRequest);
        //file_put_contents("storage/ResizedImages/$token.json", $json);
        file_put_contents("storage/ResizedImages/$token.json", $json);
        exec("python3 ../kart3.py storage/ResizedImages/$token.json", $output);

        $resizedImages=ResizedImage::all()->where('token',$token);
        foreach ($resizedImages as $item) {
            $item->update(['size' => ceil(filesize('storage/'.$item->path)/1000)]);
        }

        $endTime = $this->getTime();
        $timeTakenPy = round(($endTime - $startTime), 2);


        return response()->json(['status' => 'success', 'token' => $token, 'timeTaken' => $timeTaken, 'timeTakenPy' => $timeTakenPy]);
    }
    private function getTime()
    {
        return array_sum(explode(" ", microtime()));
    }
    private function getTargetBox($targetWidth, $targetHeight, $widthOriginal, $heightOriginal, $keepWidth, $keepHeight, $keepAspectRatio, $targetAspectRatio)
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
