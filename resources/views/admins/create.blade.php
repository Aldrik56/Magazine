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
    .upload__form {
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
    .upload__form label {
        color: #ffffff;
        font-size: 14px;
        font-weight: 400;
    }
    .upload__form input {
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
    .upload__form textarea {
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
    .upload__button {
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
        @error('file')
            <script>
                alert("{{$message}}");
            </script>
        @enderror
        @error('sampul')
            <script>
                alert("{{$message}}");
            </script>
        @enderror
        <form action="/admin" method="POST" id="upload__form" class="upload__form" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="email">Judul</label>
                <input type="text" name="judul" id="judul" required>
            </div>
            <div>
                <label>Deskripsi / Sinopsis PDF</label><br>
                <textarea type="text" rows="5"name="deskripsi" id="deskripsi" required></textarea>
            </div> 
            <div>
                <label>Edisi</label>
                <input type="text" name="edisi" id="edisi">
            </div>
            <div >
                <label for="password" >Tebal</label>
                <input type="text" name="tebal" id="tebal" required>
            </div>
            <div >
                <label for="password" >Bahasa</label>
                <input type="text" name="bahasa" id="bahasa" required>
            </div>
            <div>
                <label >Sampul buku (png,jpg,jpeg, dsb.)</label>
                <input type="file" class="input_file" name="sampul" id="sampul">
            </div>
            <div>
                <label >File (pdf)</label>
                <input type="file" class="input_file" name="file" id="file">
            </div>
            <button type="button" class="upload__button" data-bs-toggle="modal" data-bs-target="#uploadModal">Upload</button>
        </div>       
        </form>
        <div class="modal" id="uploadModal" aria-labelledby="uploadModalLabel" tabindex="-1">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Warning</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <p style="font-size:16px">Apakah kamu yakin untuk mengupload PDF ini?</p>  
                  <p style="font-size:16px">Note : Periksa kembali kelengkapan dan keakuratan data sebelum mengupload.</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary" form="upload__form">UPLOAD</button>
                </div>
              </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>
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