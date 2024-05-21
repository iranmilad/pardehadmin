<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;

class PageController extends Controller
{

    public function index($slug){
        $page = Page::whereSlug($slug)->first();
        $compiledContent = Blade::compileString($page->content);

        return view("single",compact('page','compiledContent'));
    }


    public function about(){
        return view('about-us');
    }

    public function terms(){
        return view('terms');
    }
}
