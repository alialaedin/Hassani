<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FileStoreRequest;
use App\Models\File;

class FileController extends Controller
{
    public function upload(FileStoreRequest $request) 
    {
        File::uploadFile($request);

        return to_route('dashboard');
    }
}
