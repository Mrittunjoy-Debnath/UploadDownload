<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function onFileUp(Request $request)
    {
        $result = $request->file('fileKey')->store('images');
        return $result;
    }
}
