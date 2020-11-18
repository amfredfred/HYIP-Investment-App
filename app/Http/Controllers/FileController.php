<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class FileController extends Controller
{
    public function downloadFinra($slug)
    {
        $file_path = 'file' . "/" . $slug;
        return Response::download($file_path);
    }
    public function downloadSec($slug)
    {
        $file_path = 'file' . "/" . $slug;
        return Response::download($file_path);
    }
}
