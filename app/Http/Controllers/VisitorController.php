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
        $list_magazine = List_magazines::whereRaw("SUBSTRING_INDEX(edisi, ', ', 1) != 'Special Edition'")
            ->orderByRaw("CAST(SUBSTRING_INDEX(edisi, ', ', 1) AS UNSIGNED) ASC")
            ->get();
        $list_magazine = $list_magazine->merge(List_magazines::whereRaw("SUBSTRING_INDEX(edisi, ', ', 1) = 'Special Edition'")->get());
        $magazine= List_magazines::orderBy("created_at", "DESC")->first();
        return view('pages.home',['magazine'=>$magazine,'magazines'=>$list_magazine]);

    }
    public function show($id)
    {
        $magazine=List_magazines::findOrFail($id);
        $list_magazine = List_magazines::whereRaw("SUBSTRING_INDEX(edisi, ', ', 1) != 'Special Edition'")
            ->orderByRaw("CAST(SUBSTRING_INDEX(edisi, ', ', 1) AS UNSIGNED) ASC")
            ->get();
        $list_magazine = $list_magazine->merge(List_magazines::whereRaw("SUBSTRING_INDEX(edisi, ', ', 1) = 'Special Edition'")->get());
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
        if ($sorting === 'oldest') {
            $sortedMagazines = List_magazines::whereRaw("SUBSTRING_INDEX(edisi, ', ', 1) != 'Special Edition'")
            ->orderByRaw("CAST(SUBSTRING_INDEX(edisi, ', ', 1) AS UNSIGNED) ASC")
            ->get();
            $sortedMagazines = $sortedMagazines->merge(List_magazines::whereRaw("SUBSTRING_INDEX(edisi, ', ', 1) = 'Special Edition'")->get());

        } elseif ($sorting === 'latest') {
            $sortedMagazines = List_magazines::whereRaw("SUBSTRING_INDEX(edisi, ', ', 1) != 'Special Edition'")
            ->orderByRaw("CAST(SUBSTRING_INDEX(edisi, ', ', 1) AS UNSIGNED) DESC")
            ->get();
            $sortedMagazines = $sortedMagazines->merge(List_magazines::whereRaw("SUBSTRING_INDEX(edisi, ', ', 1) = 'Special Edition'")->get());
        } elseif($sorting === 'special_edition'){
            $sortedMagazines = List_magazines::whereRaw("SUBSTRING_INDEX(edisi, ', ', 1) = 'Special Edition'")->get();
            $sortedMagazines = $sortedMagazines->merge(List_magazines::whereRaw("SUBSTRING_INDEX(edisi, ', ', 1) != 'Special Edition'")
            ->orderByRaw("CAST(SUBSTRING_INDEX(edisi, ', ', 1) AS UNSIGNED) DESC")->get());
        }
        return response()->json($sortedMagazines);
    }
}