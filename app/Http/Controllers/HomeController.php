<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{
    public function index()
    {
        $data['posts'] = Post::where('language_id', Language::where('short_name', App::getLocale())->first()->id)->get();
        dd($data);
        return view('welcome', $data);
    }
}
