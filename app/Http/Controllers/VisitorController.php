<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\List_magazines;
use Storage;

class VisitorController extends Controller
{
    public function index()
    {
        $list_magazine=List_magazines::all();
        return view('pages.home',['magazines'=>$list_magazine]);

    }
    public function show($id)
    {
        $magazine=List_magazines::findOrFail($id);
        $list_magazine=List_magazines::all();
        $file =Storage::url($magazine->file);
        return view('pages.baca',['magazines'=>$list_magazine,'magazine'=>$magazine,'file'=>$file]);
    }

    public function deskripsi($id)
    {
        $list_magazine=List_magazines::all();
        $magazine=List_magazines::findOrFail($id);
        return view('pages.deskripsi',['magazines'=>$list_magazine,'magazine'=>$magazine]);
    }
}