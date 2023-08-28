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
<body class="deskripsi__page">
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
    <div class="background__hitam"></div>
    <div class="top__section">
        <img src="{{URL::asset('storage/'.$magazine->sampul)}}" alt="">
        <div class="top__description">
            <h1>Title : {{$magazine->judul}}</h1>
            <table>
                <tr>
                    <td>Edisi : </td>
                    <td>{{$magazine->edisi}}</td>
                </tr>
                <tr>
                    <td>Terbit : </td>
                    <td>{{$magazine->tanggal_terbit}}</td>
                </tr>
                <tr>
                    <td>Tebal : </td>
                    <td>{{$magazine->tebal}}</td>
                </tr>
                <tr>
                    <td>Bahasa  : </td>
                    <td>{{$magazine->bahasa}}</td>
                </tr>
            </table>

            <form action="deskripsi" method="post" class='hero__buttons'>
                <button type="submit" class='read'>
                    <strong> <a href='/pdf/{{$magazine->id}}'>Read Now</a></strong>
                </button>
            </form>
        </div>
    </div>
    <div class="second__section">
        <div>
            <h3>Sinopsis : </h3>
            <p>{{$magazine->deskripsi}}</p>
        </div>
    </div>
    <footer style="background-color: #2C2C2C;height:fit-content;margin-top:200px;width:100%;color:white;display:flex;flex-direction:column;justify-content:center;">
        <a href="#nav" style="text-decoration: none;color:white;">
            <p style="font-size: 50px;margin:0px;text-align:center">⏏</p>
            <p style="font-size: 30px;margin:0px;text-align:center">Back to top</p>
        </a>
    </footer>
    @include('components.globalScript')
</body>
</html>