<?php

namespace App\Http\Controllers\Resizer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use ZipArchive;

class ZipController extends Controller
{

    public function __invoke($token)
    {

        $zip = new ZipArchive();
        $zipFileName = 'archive_' . $token . '.zip';
        try {
            if ($zip->open(public_path('/storage/ResizedImages/' . $zipFileName), ZipArchive::CREATE) === true) {
                if ($files = File::files(public_path('/storage/ResizedImages/' . $token))) {
                    foreach ($files as $key => $value) {
                        $relativeNameInZipFile = basename($value);
                        $zip->addFile($value, $relativeNameInZipFile);
                    }
                    $zip->close();
                    return response()->download(public_path('/storage/ResizedImages/' . $zipFileName));
                }
            }
        } catch (\Exception $exception) {
            return inertia('Resizer/Index');
        }
        return '';
    }


}
