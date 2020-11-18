<?php

namespace App\Http\Controllers;
use App\Page;
use Illuminate\Http\Request;

class ViewPageController extends Controller
{
    public function index($slug) {
         $page = Page::whereSlug($slug)->firstOrFail();
        return view('pages.page', ['page' => $page]);
        
    }
     public function aboutUs() {
         $page = Page::whereSlug('about-us')->firstOrFail();
        return view('pages.about', ['about' => $page]);
        
    }
}
