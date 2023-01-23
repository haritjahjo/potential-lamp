<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\FrontImage;
use Illuminate\Http\Request;

class FrontImageController extends Controller
{
    public function getFrontImageData()
    {
        $aboutImage = About::where('id', '=', 1)
            ->withWhereHas('media', function($query){
                $query->where('collection_name', '=', 'abouts');
            })
            ->first();
        //dd($aboutImage);
        return view('pages.welcome', [
            'about' => $aboutImage,
        ]);
    }
}
