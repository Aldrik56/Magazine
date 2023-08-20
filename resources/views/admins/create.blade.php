<!DOCTYPE html>
<html lang="en">
@include('components.header')
</head>
<style>
    @font-face {
    font-family: 'verdana';
    src : url('fonts/verdana.ttf');
    }
    @font-face {
    font-family: 'verdana bold';
    src : url('fonts/verdana-bold.ttf');
    }
    @font-face {
    font-family: 'verdana bold italix';
    src : url('fonts/verdana-bold-italic.ttf');
    }
    body {
        margin:0px;
        padding:0px;
    }
    .login__section {
        height: 100vh;
        width: 100vw;
        padding:0px;
        margin:0px;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }
    .login__container {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }
    .login__form {
        width:50vw;
        margin-top: 20px;
        margin-left: 0;
        padding:26px 26px;
        font-weight: 400;
        overflow: hidden;
        background: #fff;
        border: 1px solid #c3c4c7;
        box-shadow: 0 1px 3px rgba(0,0,0,.04);
        border-radius: 9px !important;
        border: 2px solid #ffffff !important;
        background: rgba(235,64,52,1) url() repeat top left !important;
        -moz-box-shadow: 0 4px 10px -1px #555555 !important;
        -webkit-box-shadow: 0 4px 10px -1px #555555 !important;
        box-shadow: 0 4px 10px -1px #555555 !important;
    }
    .login__form label {
        color: #ffffff;
        font-size: 14px;
        font-weight: 400;
    }
    .login__form input {
        /* padding:0px 20px; */
        display:flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        margin:0px;
        width:100%;
        height: 40px;
        margin-bottom: 10px;
        border: 1px solid #c3c4c7;
        border-radius: 4px;
        font-size: 14px;
        font-weight: 400;
        color: #555;
        background-color: #fff;
        -webkit-box-shadow: inset 0 1px 2px rgba(0,0,0,.1);
        box-shadow: inset 0 1px 2px rgba(0,0,0,.1);
        -webkit-transition: border .15s linear,box-shadow .15s linear;
        -o-transition: border .15s linear,box-shadow .15s linear;
        transition: border .15s linear,box-shadow .15s linear; */
    }
    .login__form textarea {
        /* padding:0px 20px; */
        display:flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        margin:0px;
        width:100%;
        margin-bottom: 10px;
        border: 1px solid #c3c4c7;
        border-radius: 4px;
        font-size: 14px;
        font-weight: 400;
        color: #555;
        background-color: #fff;
        -webkit-box-shadow: inset 0 1px 2px rgba(0,0,0,.1);
        box-shadow: inset 0 1px 2px rgba(0,0,0,.1);
        -webkit-transition: border .15s linear,box-shadow .15s linear;
        -o-transition: border .15s linear,box-shadow .15s linear;
        transition: border .15s linear,box-shadow .15s linear; */
    }
    .login__section__judul {
        color: #ffffff;
        font-family: 'arial';
        font-size: 48px;
        font-weight: 700;
        text-align: center;
        margin-bottom: 20px;
    }
    .password {
        margin-top: 20px;
    }
    .login__button {
        margin-top: 20px;
        background: rgba(85,85,85, 0.9);
        border:none;
        border-radius: 6px;
        width:80px;
        height: 30px;
        color:#ffffff;
        font-weight: 400;
    }
    .input_file {
        width:auto !important;
        height:auto !important;
    }
    
</style>
<body>
    <div class="login__section">
        <h1 class="title">Upload PDF</h1>
        <form action="/admin" method="POST" class="login__form" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div>
                <label for="email">Judul</label>
                <input type="text" name="judul" id="judul" >
            </div>
            <div>
                <label  >Deskripsi / Sinopsis PDF</label><br>
                <textarea type="text" rows="5"name="deskripsi" id="deskripsi" ></textarea>
            </div> 
            <div>
                <label >Edisi</label>
                <input type="text" name="edisi" id="edisi">
            </div>
            <div >
                <label  >Tanggal Terbit</label>
                <input type="text" name="tanggal_terbit" id="tanggal_terbit">
            </div>
            <div >
                <label for="password" >Tebal</label>
                <input type="text" name="tebal" id="tebal">
            </div>
            <div >
                <label for="password" >Bahasa</label>
                <input type="text" name="bahasa" id="bahasa">
            </div>
            <div>
                <label >File</label>
                <input type="file" class="input_file" name="file" id="file">
            </div>
            <button type="submit" class="login__button">Upload</button>
        </div>
            
        </form>
    </div>
</body>
</html>
<div class="admin_pdf"><h1>Upload PDF</h1></div>
<div class="tambahPDF__section">
    <div class="form_box">
        <form action="/PDFadmin" method="post" enctype="multipart/form-data">
            @csrf
            judul : <input type="text" name="judul" id="judul"><br>
            deskripsi : <input type="text" name="deskripsi" id="deskripsi"><br>
            edisi : <input type="text" name="edisi" id="edisi"><br>
            tanggal_terbit : <input type="date" name="tanggal_terbit" id="tanggal_terbit"><br>
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
    </div>
</div>

<style>
    .tambahPDF__section{
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }
    .form_box{
        width: 70%;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        border: 1px solid #ED2736;
    }
</style>