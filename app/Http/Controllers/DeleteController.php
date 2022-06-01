<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DeleteController extends Controller
{
    function onDelete()
    {
        Storage::delete('images/rNwh9puDPEabCWxMPMfS1YzdJB8L1HIJlTYrehAi.pdf');
    }
}
