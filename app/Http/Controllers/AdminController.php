<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Admin;
use App\models\Posts;
use Storage;

class adminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins=Posts::all();
        return view('admins.index',['admins'=>$admins]);

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
        $ext=$request->file('file')->extension();

        $originalFilename = pathinfo($request->file('file')->getClientOriginalName(), PATHINFO_FILENAME);
        $newFilename = $originalFilename . '_' . time() . '.' . $ext;
        $path = $request->file('file')->storePubliclyAs('files', $newFilename, 'public');

        $admin=new Posts();
        $admin->judul=$request->judul;
        $admin->deskripsi=$request->deskripsi;
        $admin->edisi=$request->edisi;
        $admin->tanggal_terbit=$request->tanggal_terbit;
        $admin->tebal=$request->tebal;
        $admin->bahasa=$request->bahasa;
        $admin->file = $path;
        $admin->save();
        return redirect('/PDFadmin/create');
        // return "Berhasil menyimpan data admin dengan id=".$admin->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $admin=Posts::findOrFail($id);
        $file =Storage::url($admin->file);
        return view('admins.show',['admin'=>$admin,'file'=>$file]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin=Posts::findOrFail($id);
        return view('admins.edit',['admin'=>$admin]);
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
        $admin=Posts::findOrFail($id);
        $admin->nim=$request->nim;
        $admin->nama=$request->nama;
        $admin->prodi=$request->prodi;
        $admin->save();
        return redirect('/PDFadmin/create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin=Posts::find($id);
        if ($admin) {
            // Get the file path from the database
            $filePath = $admin->file;
    
            // Delete the file from storage if it exists
            if (Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }
    
            // Delete the record from the database
            $admin->delete();
        }
        return redirect('/PDFadmin');
    }
    
}
