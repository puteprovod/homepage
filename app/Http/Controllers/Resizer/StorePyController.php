<?php

namespace App\Http\Controllers\Resizer;
use App\Http\Requests\Resizer\StoreRequest;
use App\Models\ResizedImage;


class StorePyController extends BaseController
{
    public function __invoke(StoreRequest $request)
    {
        ResizedImage::clearOldEntries();
        $data = $request->validated();
        return ($this->service->resizeImages($data));

  }

}
