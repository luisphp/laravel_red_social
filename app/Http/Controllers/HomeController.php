<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $images = Image::orderBy('id_image', 'desc')->paginate(5);

        //var_dump($images);

        return view('home')->with(
            'images', $images
        );
    }


}
