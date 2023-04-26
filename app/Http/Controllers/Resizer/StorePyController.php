<?php

namespace App\Http\Controllers\Resizer;
use App\Http\Controllers\Controller;
use App\Http\Requests\Resizer\StoreRequest;
use App\Http\Services\Resizer\Service;
use App\Models\ResizedImage;


class StorePyController extends Controller
{
    public function __invoke(StoreRequest $request, Service $resizerService)
    {
        ResizedImage::clearOldEntries();
        $data = $request->validated();
        return ($resizerService->resizeImages($data));

  }

}
