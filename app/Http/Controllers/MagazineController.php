<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\List_magazines;

class MagazineController extends Controller
{
    //
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
