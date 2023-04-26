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

class StoreController extends Controller
{
    // UNUSED CONTROLLER, RESIZING BY PHP METHODS
    private function getTime()
    {
        return array_sum(explode(" ",microtime()));
    }
    public function __invoke(StoreRequest $request)
    {
        $startTime = $this->getTime();
        $data = $request->validated();
        $images = $data['images'];
        unset($data['images']);
        $token = substr(md5(Carbon::now() . '_' . $data['targetWidth'] . $data['targetHeight'] . $data['keepAspectRatio']), 0, 8);
        $folderPath = '/ResizedImages/' . $token;
        $folderPathPreview = '/ResizedImages/Previews/' . $token;

        foreach ($images as $image) {
            $fileName = $image->getClientOriginalName();
            $imageExtension = $image->getClientOriginalExtension();
            //Storage::disk('public')->putFileAs($folderPath, $image, $fileName); - пример использования для записи файла (безотносительно проекта)
            Storage::disk('public')->makeDirectory($folderPath);
            Storage::disk('public')->makeDirectory($folderPathPreview);
            $previewName = 'prev_' . $fileName;

            $imageTemp = \Intervention\Image\Facades\Image::make($image);

            $widthOriginal = $imageTemp->getWidth();
            $heightOriginal = $imageTemp->getHeight();

            $widthTarget = $data['targetWidth'];
            $heightTarget = $data['targetHeight'];
            $keepAspectRatio = $data['keepAspectRatio'];
            $keepWidth = $data['keepWidth'];
            $keepHeight = $data['keepHeight'];

            if ($keepWidth==='true' and $keepHeight==='false')
                $heightTarget=null;
            if ($keepHeight==='true' and $keepWidth==='false')
                $widthTarget=null;

            if ($keepAspectRatio==='true') {
                $imageTemp->resize($widthTarget, $heightTarget, function ($constraint) {
                    $constraint->aspectRatio();
                });
            } else {
                $imageTemp->resize($widthTarget, $heightTarget);
            }

            $factWidth = $imageTemp->getWidth();
            $factHeight = $imageTemp->getHeight();
            $imageTemp->save(storage_path('app/public/ResizedImages/') . $token . '/' . $fileName);
            $fileSize=ceil($imageTemp->filesize() / 1000);
            \Intervention\Image\Facades\Image::make($imageTemp)->fit(75, 75)
                ->save(storage_path('app/public/ResizedImages/Previews/') . $token . '/' . $previewName);

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
        $timeTaken = round(($endTime - $startTime),2);

        return response()->json(['status' => 'success', 'token' => $token, 'timeTaken' => $timeTaken ]);
    }

}
