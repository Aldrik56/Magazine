
<?php
$jumlahBuku=1;
$pdfTerbaru = count($magazines)-1;
?>

<!DOCTYPE html>

<html lang="en">
@include('components.header')
<body class="home__page">
    @include('components.navbar')
    <div class='hero'>
        <div class='content'>
            <div class='main'>
                <h1>Check Out Latest Updates From</h1>
                <h1 class='title'>ULTIMAGZ</h1>
            </div>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                Lorem ipsum dolor sit amet, consectetur adipiscing
            </p>
            <form action="deskripsi" method="post" class='hero__buttons'>
                <button type="submit" class='read'>
                    <strong> <a href='/pdf/{{$magazines[count($magazines)-1]->id}}'>Read Now</a></strong>
                </button>
                <button type="submit" class="desc">
                    <strong><a href='/deskripsi/{{$magazines[count($magazines)-1]->id}}'>Description</a></strong>
                </button>
            </form>
        </div>
        <div class='illustration'>
            <img src="{{ URL::asset('storage/' . $magazines[count($magazines) - 1]->sampul) }}" id="highlight_magazine">
        </div>
    </div>

    @include('components.swiper')
    @include('components.footer')
    @include('components.globalScript')
    
    <script src="{{ URL::asset('libraryJs/pdf.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('libraryJs/pdf.worker.js') }}"></script>
</body>
</html>