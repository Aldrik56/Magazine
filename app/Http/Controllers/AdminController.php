<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\models\List_magazines;
use Storage;

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
        $list_magazine=List_magazines::all();
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
            'file' => 'required|file|max:' . (200 * 1024), // Max size in kilobytes
            // Other validation rules...
        ]);
        $ext=$request->file('file')->extension();

        $originalFilename = pathinfo($request->file('file')->getClientOriginalName(), PATHINFO_FILENAME);
        $newFilename = $originalFilename . '_' . time() . '.' . $ext;
        $path = $request->file('file')->storePubliclyAs('files', $newFilename, 'public');

        $magazine=new List_magazines();
        $magazine->judul=$request->judul;
        $magazine->deskripsi=$request->deskripsi;
        $magazine->edisi=$request->edisi;
        $magazine->tanggal_terbit=$request->tanggal_terbit;
        $magazine->tebal=$request->tebal;
        $magazine->bahasa=$request->bahasa;
        $magazine->file = $path;
        $magazine->save();
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
        $magazine=List_magazines::findOrFail($id);
        $file =Storage::url($magazine->file);
        return view('admins.show',['list_magazine'=>$magazine,'file'=>$file]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {

        $magazine=List_magazines::findOrFail($id);
        return view('admins.edit',['admin'=>$magazine]);
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
        $magazine->nim=$request->nim;
        $magazine->nama=$request->nama;
        $magazine->prodi=$request->prodi;
        $magazine->save();
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
        $magazine=List_magazines::find($id);
        if ($magazine) {
            // Get the file path from the database
            $filePath = $magazine->file;
    
            // Delete the file from storage if it exists
            if (Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }
    
            // Delete the record from the database
            $magazine->delete();
        }
        return redirect('/PDFadmin');
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
