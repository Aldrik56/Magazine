<h1>Create new magazine</h1>
<form action="/magazine" method="post" enctype="multipart/form-data">
    @csrf
    judul : <input type="text" name="judul" id="judul"><br>
    deskripsi : <input type="text" name="deskripsi" id="deskripsi"><br>
    edisi : <input type="text" name="edisi" id="edisi"><br>
    tanggal_terbit : <input type="text" name="tanggal_terbit" id="tanggal_terbit"><br>
    tebal : <input type="text" name="tebal" id="tebal"><br>
    bahasa : <input type="text" name="bahasa" id="bahasa"><br>
    upload majalah pdf : <input type="file" name="file" id="file"><br>

    <button type="submit">submit</button>
    {{-- $table->string('judul');
            $table->string('deskripsi');
            $table->string('edisi');
            $table->string('tanggal_terbit');
            $table->string('tebal');
            $table->string('bahasa');
            $table->string('link')->nullable(); --}}

</form>