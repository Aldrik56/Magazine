<!DOCTYPE html>
<html lang="en">
@include('components.header')
<body class="deskripsi__page">
    @include('components.navbar')
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
    @include('components.swiper')
    @include('components.footer')
    @include('components.globalScript')
</body>
</html>