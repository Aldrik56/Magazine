<h1>Edit admin</h1>
<form action="/PDFadmin/{{$admin->id}}"method="post">
    @method('PUT')
    @csrf
    judul : <input type="text" name="judul" id="judul"><br>
    deskripsi : <input type="text" name="deskripsi" id="deskripsi"><br>
    edisi : <input type="text" name="edisi" id="edisi"><br>
    tanggal_terbit : <input type="text" name="tanggal_terbit" id="tanggal_terbit"><br>
    tebal : <input type="text" name="tebal" id="tebal"><br>
    bahasa : <input type="text" name="bahasa" id="bahasa"><br>
    {{-- upload majalah pdf : <input type="file" name="file" id="file"><br> --}}
    <button type="submit">Submit</button>
</form>