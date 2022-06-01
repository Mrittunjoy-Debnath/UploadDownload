<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    public function onDownload($FolderPath,$name)
    {
        return Storage::download($FolderPath."/".$name);

    }
    public function onSelectFileList()
    {
        $result = DB::table('my_files')
            ->get();
        return $result;
    }
}
