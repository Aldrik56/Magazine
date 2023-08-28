<!DOCTYPE html>
<html lang="en">
@include('components.header')
<style>
    * {
        margin:0px;
        padding:0px;
        font-family: 'verdana';
    }
    .profile__name {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .listmagazine__section {
        padding:0px 200px;
        display:flex;
        gap:67px;
        min-height: 100vh;
        /* grid-template-columns: repeat(5, 1fr);  */
        /* justify-content:space-between; */
        flex-wrap: wrap;
           
    }
    .magazine_box {
        position:relative;
        top:100px;

        width:fit-content;
    }
    .navbar__admin {
        display:flex;
        padding:0px 100px;
        justify-content: space-between;
        background-color: #ED2736;
        color:#FFFFFF;
    }
    .navbar__admin button {
        height:60px;
    }
    .sampul__img {
        width: 250px;
        height: 362px;
        box-shadow: -4px 4px 4px 4px rgba(0, 0, 0, 0.50);
    }
    .swiperSlide__buttons {
        display: none;
        position:absolute;
        top:0px;
        left:0px;
        justify-content: center;
        align-items: center;
        gap:20px;
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
        width: 250px;
        height: 362px;
        -webkit-backdrop-filter: blur(20px);
        background-color: rgba(0, 0, 0, 0.55);
    }
    .swiperSlide__buttons button {
        border: none;
        width:214px;
        height:45px;
        border-radius: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .admin_a, .admin__redirectHome {
      font-size: 36px;
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
    .upload_button {
        background-color: #FFFFFF;
        padding:5px 15px;
        border-radius:20px;
    }
    .upload_button a {
        text-decoration: none;
        color: #ED2736;
        font-size:28px;
    }
    @media(max-width:520px){
        .profile__name > h1 {
            font-size: 20px;
        }
        .listmagazine__section {
        padding:0px 20px;
        display:flex;
        gap:24px;
        justify-content: space-between;
        flex-wrap: wrap;
           
    }
    .magazine_box {
        position:relative;
        top:20px;

        width:fit-content;
    }
    .navbar__admin {
        display:flex;
        padding:0px 20px;
        justify-content: space-between;
        background-color: #ED2736;
        color:#FFFFFF;
    }
    .navbar__admin button {
        height:50px;
    }
    .sampul__img {
        width: 170px;
        height: 260px;
        box-shadow: -4px 4px 4px 4px rgba(0, 0, 0, 0.50);
    }
    .swiperSlide__buttons {
        display: none;
        position:absolute;
        top:0px;
        left:0px;
        justify-content: center;
        align-items: center;
        width: 170px;
        height: 260px;
        gap:20px;
        -webkit-backdrop-filter: blur(20px);
        background-color: rgba(0, 0, 0, 0.55);
        
        
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
        padding:0px 0px;
        width:100%;
        /* height: 362px; */
        /* margin-top: 20px; */
    }
    .swiperSlide__buttons button {
        border: none;
        width:80%;
        height:50px;
        border-radius: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .admin_a, .admin__redirectHome {
      font-size: 16px !important;
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
    .upload_button {
        background-color: #FFFFFF;
        /* height:100%; */
        padding:0px 15px;
        border-radius:20px;
    }
    .upload_button a {
        text-decoration: none;
        color: #ED2736;
        font-size:16px;
    }
}
</style>
<body>
    {{-- @php 
        $detailBuku=null;
        function bukaDetail($list_magazine){
            // $detailBuku = $list_magazine;
            session(['detailBuku' => $list_magazine]);
        }
    @endphp --}}
    <nav class="navbar__admin" id="nav">
        @auth
            <div class="profile__name">
                <h1>Welcome, {{ $name }}!</h1>
            </div>
            <div style="display:flex;gap:10px;align-items:center">
                <a href="/admin" class="admin__redirectHome">Home</a>
                <button class="upload_button">
                    <a href="/admin/create">Upload</a>
                </button>
            </div>
        @else
            <p>Please log in to see your profile.</p>
        @endauth
    </nav>
    <div class="listmagazine__section">
        @php
            $count = count($list_magazine);
        @endphp
        @for($i = $count -1; $i >= 0; $i--)
            <div class="magazine_box">
                <img class="sampul__img"src="{{URL::asset('storage/'.$list_magazine[$i]->sampul)}}" alt="">
                {{-- <canvas id="the-canvas{{$i+1}}" class="flex-item"></canvas> --}}
                <div class='swiperSlide__buttons' style='flex-direction:column;justify-content:center'>
                    <button class='read'>
                        <strong><a class="admin_a" href='/pdf/{{$list_magazine[$i]->id}}'>Read</a></strong>
                    </button>
                    <button class='desc'>
                        <strong><a class="admin_a" href='/admin/deskripsi/{{$list_magazine[$i]->id}}'>Detail</a></strong>
                    </button>
                    <button class="desc">
                        <strong><a class="admin_a" href='/admin/{{$list_magazine[$i]->id}}/edit'>Edit</a></strong>
                    </button>
                </div>
            </div>
        @endfor
    </div>
    <footer style="background-color: #2C2C2C;height:fit-content;margin-top:200px;width:100%;color:white;display:flex;flex-direction:column;justify-content:center;">
        <a href="#nav" style="text-decoration: none;color:white;">
            <p style="font-size: 50px;margin:0px;text-align:center">⏏</p>
            <p style="font-size: 30px;margin:0px;text-align:center">Back to top</p>
        </a>
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

    // ini buat render semua magazine
    const listMagazine = @json($list_magazine);
    listMagazine.forEach((magazine, index) => {
        console.log(magazine.file);
        renderPage( magazine.file, index + 1);
    });
    </script>
    <script src="{{ URL::asset('libraryJs/pdf.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('libraryJs/pdf.worker.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
</body>
</html>

