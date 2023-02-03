<?php

namespace App\Http\Controllers\Resizer;

use App\Http\Controllers\Controller;
use App\Http\Services\Resizer\Service;

class BaseController extends Controller
{
    public Service $service;
    public function __construct(Service $service)
    {
        $this->service = $service;
    }
}
