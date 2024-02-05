<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\List_magazines;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth'); // Apply auth middleware to all methods
    }

    public function index()
    {
        // $list_magazine=List_magazines::all();
        $list_magazine = List_magazines::orderByRaw("CAST(SUBSTRING_INDEX(edisi, ', ', 1) AS UNSIGNED)")->get();
        if (Auth::check()) {
            $user = Auth::user();
            $name = $user->name;
            $email = $user->email;
            return view('admins.index', compact('name', 'email','list_magazine'));
        } else {
            return redirect()->route('login');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admins.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate($request,[
        //     'nim'=>'required|max:10|unique:admins',
        //     'nama'=>'required|max:50'
        // ]);
        $this->validate($request, [
            'file' => 'required|mimes:pdf', 
            'sampul' => 'required|image|mimes:jpeg,png,jpg,gif,webp,svg',
            'video' => 'nullable|url',
            'halamanVideo' => 'nullable|integer', 
            // Other validation rules...
        ],[
            'file.required'=>'File tidak boleh kosong',
            'file.mimes'=>'File harus berupa pdf',
            'sampul.required'=>'Sampul tidak boleh kosong',
            'sampul.mimes'=>'Sampul harus berupa image',

        ]);
        //Minta original name untuk file pdf
        $ext=$request->file('file')->extension();
        $originalFilename = pathinfo($request->file('file')->getClientOriginalName(), PATHINFO_FILENAME);
        $newFilename = $originalFilename . '_' . time() . '.' . $ext;
        $path = $request->file('file')->storePubliclyAs('files', $newFilename, 'public');

        //Minta original name untuk file
        $ext=$request->file('sampul')->extension();
        $originalFilename = pathinfo($request->file('sampul')->getClientOriginalName(), PATHINFO_FILENAME);
        $newFilename = $originalFilename . '_' . time() . '.' . $ext;
        $path2 = $request->file('sampul')->storePubliclyAs('sampuls', $newFilename, 'public');

        $magazine=new List_magazines();
        $magazine->judul=$request->judul;
        $magazine->deskripsi=$request->deskripsi;
        $magazine->edisi=$request->edisi;
        $magazine->tebal=$request->tebal;
        $magazine->bahasa=$request->bahasa;
        $magazine->video = $request->has('video') ? $request->video : null;
        $magazine->halamanVideo = $request->has('halamanVideo') ? $request->halamanVideo : null;
        $magazine->file = $path;
        $magazine->sampul = $path2;
        $magazine->save();

        return view('admins.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $list_magazine=List_magazines::all();
        $magazine=List_magazines::findOrFail($id);
        return view('admins.deskripsi',['admin_magazines'=>$list_magazine,'admin_magazine'=>$magazine]);
    }
    public function deskripsi($id)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $name = $user->name;
            $email = $user->email;
            $magazine=List_magazines::findOrFail($id);
            return view('admins.deskripsi', compact('name', 'email','magazine'));
        } else {
            return redirect()->route('login');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $magazine=List_magazines::findOrFail($id);
        return view('admins.edit',['magazine'=>$magazine]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $magazine=List_magazines::findOrFail($id);
        $magazine->judul=$request->judul;
        $magazine->deskripsi=$request->deskripsi;
        $magazine->edisi=$request->edisi;
        $magazine->tebal=$request->tebal;
        $magazine->bahasa=$request->bahasa;
        $magazine->video = $request->video;
        $magazine->halamanVideo = $request->halamanVideo;

        $this->validate($request, [
            'file' => 'mimes:pdf', // Max size in kilobytes
            'sampul' => 'image|mimes:jpeg,png,jpg,gif,webp,svg',
            // Other validation rules...
        ],[
            'file.mimes'=>'File harus berupa pdf',
            'sampul.mimes'=>'Sampul harus berupa image',

        ]);
        
        if ($request->file('file')) {
            // Delete the old file if it exists
            if (Storage::disk('public')->exists($magazine->file)) {
                Storage::disk('public')->delete($magazine->file);
            }

            
            $ext = $request->file('file')->extension();
            $originalFilename = pathinfo($request->file('file')->getClientOriginalName(), PATHINFO_FILENAME);
            $newFilename = $originalFilename . '_' . time() . '.' . $ext;
            $path = $request->file('file')->storePubliclyAs('files', $newFilename, 'public');
            $magazine->file = $path;
        }

        if ($request->file('sampul')) {
            // Delete the old file if it exists
            if (Storage::disk('public')->exists($magazine->sampul)) {
                Storage::disk('public')->delete($magazine->sampul);
            }
            $ext = $request->file('sampul')->extension();
            $originalFilename = pathinfo($request->file('sampul')->getClientOriginalName(), PATHINFO_FILENAME);
            $newFilename = $originalFilename . '_' . time() . '.' . $ext;
            $path2 = $request->file('sampul')->storePubliclyAs('sampuls', $newFilename, 'public');
            $magazine->sampul = $path2;
        }
        $magazine->save();
        return redirect('/admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $magazine=List_magazines::find($id);
        if ($magazine) {
            // Get the file path from the database
            $filePath = $magazine->file;
            $filePath2 = $magazine->sampul;
        
            // Delete the file from storage if it exists
            if (Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }
            if (Storage::disk('public')->exists($filePath2)) {
                Storage::disk('public')->delete($filePath2);
            }
            // Delete the record from the database
            $magazine->delete();
        }
        return redirect('/admin');
    }


    public function profile()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $name = $user->name;
            $email = $user->email;
            return view('admins', compact('name', 'email'));
        } else {
            return redirect()->route('login');
        }
    }
    
}
