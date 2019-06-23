<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoadTemplateController extends Controller
{
    public function loadTemplate()
    {

        return view('index.index');
    }

    public function loadWhyUs()
    {

        return view('pages.why_us');
    }



        public function loadAboutUs()
    {

        return view('pages.about');
    }

    public function loadContactUs()
    {
        return view('pages.contact');
    }



}
