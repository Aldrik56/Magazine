<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\List_magazines;
use Storage;

class HomeController extends Controller
{
    public function index()
    {
        $list_magazine=List_magazines::all();
        return view('pages.home',['magazines'=>$list_magazine]);

    }
    public function show($id)
    {
        $magazine=List_magazines::findOrFail($id);
        $file =Storage::url($magazine->file);
        return view('pages.test',['magazine'=>$magazine,'file'=>$file]);
    }

    public function deskripsi()
    {
        return view('pages.deskripsi');
    }
}