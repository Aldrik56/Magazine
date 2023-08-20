

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
        .login__form {
            width:fit-content;
            
            margin-top: 100px;
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
        .login__button {
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
        .canvas_edit {
            width: 320px;
            height: 434px;
        }

        
    </style>
    <body>
        <div class="login__section">
            <h1>Edit PDF</h1>
            <form action="/admin/{{$admin->id}}" method="POST" class="login__form" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="login_form_box">
                    <div>
                        <canvas id="the-canvas1" class="canvas_edit"></canvas>
                    </div>
                    <div class="form_kanan">
                        <div>
                            <label for="email">Judul</label>
                            <input type="text" name="judul" id="judul" value="{{$admin->judul}}">
                        </div>
                        <div>
                            <label  >Deskripsi</label>
                            <input type="text" name="deskripsi" id="deskripsi" value="{{$admin->deskripsi}}">
                        </div> 
                        <div>
                            <label >Edisi</label>
                            <input type="text" name="edisi" id="edisi" value="{{$admin->edisi}}">
                        </div>
                        <div >
                            <label  >Tanggal Terbit</label>
                            <input type="text" name="tanggal_terbit" id="tanggal_terbit" value="{{$admin->tanggal_terbit}}">
                        </div>
                        <div >
                            <label for="password" >Tebal</label>
                            <input type="text" name="tebal" id="tebal" value="{{$admin->tebal}}">
                        </div>
                        <div >
                            <label for="password" >Bahasa</label>
                            <input type="text" name="bahasa" id="bahasa" value="{{$admin->bahasa}}">
                        </div>
                        <div>
                            <label >File</label>
                            <input type="file" name="file" id="file" value="{{$admin->file}}">
                        </div>
                        <button class="login__button">Save changes</button>
                    </div>
                </div>
                
            </form>
        </div>
        <footer style="background-color: #2C2C2C;height:300px;width:100%">
            <p>^</p>
            Back To Top
        </footer>
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
        const listMagazine = @json($admin);
            renderPage( listMagazine.file, 1);
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


