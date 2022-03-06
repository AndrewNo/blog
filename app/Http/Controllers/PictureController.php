<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PictureController extends Controller
{
    public function upload(Request $request)
    {
        return asset('storage/'.$request->file('file')->store('images'));
    }
}
