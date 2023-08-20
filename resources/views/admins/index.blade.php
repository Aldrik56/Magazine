<!DOCTYPE html>
<html lang="en">
@include('components.header')
<style>
    .listmagazine__section {
        padding:0px 200px;
        display:flex;
        gap:67px;
        /* grid-template-columns: repeat(5, 1fr);  */
        /* justify-content:space-between; */
        flex-wrap: wrap;
           
    }
    .magazine_box {
        position:relative;
        top:0px;
        width:fit-content;
    }
    .navbar__admin {
        background-color: #ED2736;
        color:#FFFFFF;
    }
    canvas {
        max-width: 250px;
        max-height: 362px;
    }
    .swiperSlide__buttons {
        display: none;
        position:absolute;
        top:0px;
        left:0px;
        justify-content: center;
        align-items: center;
        gap:20px;
        margin-top: 20px;
        
    }
    .magazine_box:hover .swiperSlide__buttons {
        display: flex;
    }
    .swiperSlide__buttons {
        display: none;
        position:absolute;
        justify-content: center;
        align-items: center;
        gap:20px;
        padding:12px 0px;
        width:100%;
        height:100%;
        /* margin-top: 20px; */
    }
    .swiperSlide__buttons button {
        border: none;
        width:214px;
        height:35px;
        border-radius: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    /* * {
      width:214px;
      border-radius: 40px;
      display: flex;
      justify-content: center;
      align-items: center;
    } */

    .admin_a {
      font-size: 24px;
      padding:12px 0px;
      text-decoration: none;
      color:inherit;
    }

    .swiperSlide_buttons:hover {
      cursor: pointer;
    }
    .read {
      background-color:#E92233;
      color:white;
    }

    .desc {
      color: #ED2736;
      background-color: #F8F8F8;
      border-style: solid;
      border-color: #E92233;
    }
    .flex-item {
        flex-basis: calc(20%); 
        background-color: #f2f2f2;
        text-align: center;
        box-sizing: border-box; 
    }
</style>
<body>
    <nav class="navbar__admin">
        <h1>Admin Page</h1>
        @auth
            <div>
                <h1>Welcome, {{ $name }}!</h1>
            </div>
        @else
            <p>Please log in to see your profile.</p>
        @endauth
    </nav>
    
    <div>

    </div>


    <h1>Daftar Mahasiswa</h1>
    <div class="listmagazine__section">
        @php
            $count = count($list_magazine);
        @endphp
        @for($i = $count -1; $i >= 0; $i--)
            <div class="magazine_box">
                <canvas id="the-canvas{{$i+1}}" class="flex-item"></canvas>
                <div class='swiperSlide__buttons' style='flex-direction:column;justify-content:center'>
                    <button class='read'>
                        <strong><a class="admin_a" href='/pdf/{{$list_magazine[$i]->id}}'>Read</a></strong>
                    </button>
                    <button class='desc'>
                        <strong><a class="admin_a" href='#'>Detail</a></strong>
                    </button>
                    <button>
                        <strong><a class="admin_a" href='/admin/{{$list_magazine[$i]->id}}/edit'>Edit</a></strong>
                    </button>
                </div>
            </div>
        @endfor

        <div id="modalEdit" class="modal">
            <div class="w3-modal-content">
              <div class="w3-container">
                <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                <p>Some text. Some text. Some text.</p>
                <p>Some text. Some text. Some text.</p>
              </div>
            </div>
          </div>


    </div>
    
    <a href="/PDFadmin/create">Create new admin</a>
    <table border="1">
        <tr>
            <th>NIM</th>
            <th>Nama</th>
            <th>Prodi</th>
            <th>Tindakan</th>
        </tr>
        @foreach($list_magazine as $magazine)
        <tr>
            <td>{{$magazine->judul}}</td>
            <td>{{$magazine->deskripsi}}</td>
            <td>{{$magazine->file}}</td>
            <td>
                <a href="/PDFadmin/{{$magazine->id}}">SHOW</a>
                <a href="/PDFadmin/{{$magazine->id}}/edit">EDIT</a>
                <form action="/PDFadmin/{{$magazine->id}}" method="post">
                    @method('DELETE')
                    @csrf 
                    <button type="submit">DELETE</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
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

    // ini buat render semua magazine
    const listMagazine = @json($list_magazine);
    listMagazine.forEach((magazine, index) => {
        console.log(magazine.file);
        renderPage( magazine.file, index + 1);
    });
    </script>
    <script src="{{ URL::asset('libraryJs/pdf.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('libraryJs/pdf.worker.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
</body>
</html>

