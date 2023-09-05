
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
                <?php
                $deskripsi = $magazines[count($magazines) - 1]->deskripsi;
                $words = str_word_count($deskripsi,1);
                $first_30_words = array_slice($words, 0, 30);
                echo implode(' ', $first_30_words);
                if (count($words) > 30) {
                    echo '...'; 
                }
                ?>
            </p>
            <div class='hero__buttons'>
                <a href='/pdf/{{$magazines[count($magazines)-1]->id}}'>
                    <button type="submit" class='read'>
                        <strong>Read Now</strong>
                    </button>
                </a>
                <a href='/deskripsi/{{$magazines[count($magazines)-1]->id}}'>
                    <button type="submit" class="desc">
                        <strong>Description</strong>
                    </button>
                </a>
            </div>
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