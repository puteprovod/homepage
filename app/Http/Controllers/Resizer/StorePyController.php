<?php

namespace App\Http\Controllers\Resizer;
use App\Http\Requests\Resizer\StoreRequest;


class StorePyController extends BaseController
{
    public function __invoke(StoreRequest $request)
    {

        $data = $request->validated();
        return ($this->service->resizeImages($data));

  }

}
