<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Magazine;
use Storage;

class magazineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $magazines=Magazine::all();
        return view('magazines.index',['magazines'=>$magazines]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('magazines.create');
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
        //     'nim'=>'required|max:10|unique:magazines',
        //     'nama'=>'required|max:50'
        // ]);
        $path=$request->file('file')->storePublicly('files','public');
        $ext=$request->file('file')->extension();
        // return "File stored ar:".$path."<br> File extension:".$ext;
        $magazine = new Magazine();
        $magazine->judul = $request->judul;
        $magazine->deskripsi = $request->deskripsi;
        $magazine->edisi = $request->edisi;
        $magazine->tanggal_terbit = $request->tanggal_terbit;
        $magazine->tebal = $request->tebal;
        $magazine->bahasa = $request->bahasa;
        $magazine->file = $path;
        $magazine->save();
        return redirect('/magazines');
        // return "Berhasil menyimpan data magazine dengan id=".$magazine->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $magazine=Magazine::findOrFail($id);
        $photo =Storage::url($magazine->photo);
        return view('magazines.show',['magazine'=>$magazine,'photo'=>$photo]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $magazine=Magazine::findOrFail($id);
        return view('magazines.edit',['magazine'=>$magazine]);
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
        $magazine=Magazine::findOrFail($id);
        $magazine->nim=$request->nim;
        $magazine->nama=$request->nama;
        $magazine->prodi=$request->prodi;
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
        $magazine=Magazine::find($id);
        $magazine->delete();
        return redirect('/admin');
    }
    
}
