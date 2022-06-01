<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class UploadController extends Controller
{
    public function onFileUp(Request $request)
    {
        $path = $request->file('fileKey')->store('images');
//        alert($path) ;
        $result = DB::table('my_files')
            ->insert(
                [
                    'file_path'=>$path,
                ]
            );
        if($result==true)
        {
            return 1;
        }
        else {
            return 0;
        }
    }
}
