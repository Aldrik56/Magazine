

<!DOCTYPE html>
<html lang="en">
@include('components.header')
<body>
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
        .edit__form {
            width:fit-content;
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
        .form_kanan input {
            /* padding:0px 20px; */
            display:flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            margin:0px;
            width:300px;
            height: 30px;
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
        /* .password {
            margin-top: 20px;
        } */
        .save__button, .delete__button {
            margin-top: 20px;
            background: rgba(85,85,85, 0.9);
            border:none;
            border-radius: 6px;
            width:fit-content;
            padding:0px 15px;
            height: 30px;
            color:#ffffff;
            font-weight: 400;
        }
        .login_form_box {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            gap:40px;
        }
        .sampul__edit >img {
            box-shadow: -4px 4px 4px 4px rgba(0, 0, 0, 0.50);
            width: 300px;
            height: 434px;
        }

        
    </style>
    <body>
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
        <div class="login__section">
            <h1>Edit PDF</h1>
            <div class="form__box">
                <form action="/admin/{{$magazine->id}}" method="POST" id="edit__form" class="edit__form" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="login_form_box">
                        <div class="sampul__edit">
                            <img src="{{URL::asset('storage/'.$magazine->sampul)}}" alt="">
                            {{-- <canvas id="the-canvas1" class="canvas_edit"></canvas> --}}
                        </div>
                        <div class="form_kanan">
                            <div>
                                <label for="email">Judul</label>
                                <input type="text" name="judul" id="judul" value="{{$magazine->judul}}">
                            </div>
                            <div>
                                <label  >Deskripsi</label>
                                <input type="text" name="deskripsi" id="deskripsi" value="{{$magazine->deskripsi}}">
                            </div> 
                            <div>
                                <label >Edisi</label>
                                <input type="text" name="edisi" id="edisi" value="{{$magazine->edisi}}">
                            </div>
                            <div >
                                <label  >Tanggal Terbit</label>
                                <input type="text" name="tanggal_terbit" id="tanggal_terbit" value="{{$magazine->tanggal_terbit}}">
                            </div>
                            <div >
                                <label for="password" >Tebal</label>
                                <input type="text" name="tebal" id="tebal" value="{{$magazine->tebal}}">
                            </div>
                            <div >
                                <label for="password" >Bahasa</label>
                                <input type="text" name="bahasa" id="bahasa" value="{{$magazine->bahasa}}">
                            </div>
                            <div>
                                <label >Sampul</label>
                                <input type="file" name="sampul" id="file" value="{{$magazine->sampul}}">
                            </div>
                            <div>
                                <label >File</label>
                                <input type="file" name="file" id="file" value="{{$magazine->file}}">
                            </div>
                            <button type="button" class="save__button" data-bs-toggle="modal" data-bs-target="#saveChangesModal{{$magazine->id}}">Save changes</button>
                            <button type="button" class="delete__button" data-bs-toggle="modal" data-bs-target="#deleteModal{{$magazine->id}}">Delete</button>
                        </div>
                    </div>   
                </form>
                <form id="deleteForm{{$magazine->id}}" action="/admin/{{$magazine->id}}" style="display:none" method="post">
                    @method('DELETE')
                    @csrf
                    <button type="button" class="login__button" data-bs-toggle="modal" data-bs-target="#deleteModal{{$magazine->id}}">DELETE</button>
                    {{-- <button class="login__button" type="button" data-toggle="modal" data-target="#deleteModal{{$magazine->id}}">DELETE</button> --}}
                </form>
                
                {{-- Modal untuk delete --}}
                <div class="modal" id="deleteModal{{$magazine->id}}" aria-labelledby="deleteModalLabel{{$magazine->id}}" tabindex="-1">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Warning</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <p style="font-size:16px">Apakah kamu yakin untuk menghapus PDF / majalah ini?</p>  
                          <p style="font-size:16px">Note : Majalah yang sudah dihapus tidak akan bisa dikembalikan lagi.</p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-danger" form="deleteForm{{$magazine->id}}">DELETE</button>
                        </div>
                      </div>
                    </div>
                </div>
                {{-- Modal untuk save changes --}}
                <div class="modal" id="saveChangesModal{{$magazine->id}}" aria-labelledby="saveChangesModalLabel{{$magazine->id}}" tabindex="-1">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Warning</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <p style="font-size:16px">Apakah kamu yakin untuk menyimpan perubahan ?</p>  
                          <p style="font-size:16px">Note : Data sebelumnya tidak dapat mengembalikan.</p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-danger" form="edit__form">Save Changes</button>
                        </div>
                      </div>
                    </div>
                </div>
        
            </div>

        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

        <script>
            async function renderPage(url, index) {
            const canvas = document.querySelector('#the-canvas'+index);
            const magazineUrl = '{{ asset('storage/') }}/' + url;

            console.log(magazineUrl);
            var loadingTask = pdfjsLib.getDocument(magazineUrl);
            var scale = 1;
            const context = canvas.getContext('2d');
            
            const pdf = await loadingTask.promise;
            const page = await pdf.getPage(1);
            
            const viewport = page.getViewport({ scale: scale });
            canvas.width = viewport.width;
            canvas.height = viewport.height;
            
            const renderContext = {
                canvasContext: context,
                viewport: viewport
            };
            await page.render(renderContext).promise;

        }
        const listMagazine = @json($magazine);
            renderPage( listMagazine., 1);
        </script>
            <script src="{{ URL::asset('libraryJs/pdf.js') }}" type="text/javascript"></script>
            <script src="{{ URL::asset('libraryJs/pdf.worker.js') }}"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
            <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    </body>
    </html>
</body>
</html>


