<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\List_magazines;
use Illuminate\Support\Facades\Storage;
class VisitorController extends Controller
{
    public function index()
    {
        // $list_magazine=List_magazines::all();
        $list_magazine = List_magazines::orderByRaw("CAST(SUBSTRING_INDEX(edisi, ', ', 1) AS UNSIGNED) ASC")->get();
        return view('pages.home',['magazines'=>$list_magazine]);

    }
    public function show($id)
    {
        $magazine=List_magazines::findOrFail($id);
        // $list_magazine=List_magazines::all();
        $list_magazine = List_magazines::orderByRaw("CAST(SUBSTRING_INDEX(edisi, ', ', 1) AS UNSIGNED) ASC")->get();
        // $file =Storage::url($magazine->file);
        return view('pages.baca',['magazines'=>$list_magazine,'magazine'=>$magazine]);
    }

    public function deskripsi($id)
    {
        $list_magazine=List_magazines::all();
        $magazine=List_magazines::findOrFail($id);
        return view('pages.deskripsi',['magazines'=>$list_magazine,'magazine'=>$magazine]);
    }
    public function fetchSortedData(Request $request)
    {
        $sorting = $request->input('sorting');
        
        // Add your logic to fetch and sort data based on the $sorting value
        if ($sorting === 'oldest') {
            $sortedMagazines = List_magazines::orderBy('created_at', 'asc')->get();
        } elseif ($sorting === 'latest') {
            $sortedMagazines = List_magazines::orderBy('created_at', 'desc')->get();
        } else {
            // Handle other sorting options if needed
            // $sortedMagazines = ...
        } // Your logic here;
        
        return response()->json($sortedMagazines);
    }
}