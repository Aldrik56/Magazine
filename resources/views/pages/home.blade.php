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
                $deskripsi = $magazine->deskripsi;
                $words = str_word_count($deskripsi,1);
                $first_25_words = array_slice($words, 0, 25);
                echo implode(' ', $first_25_words);
                if (count($words) > 25) {
                    echo '... '; 
                }
                ?>
                <a style="color:#B9B9B9;text-decoration:none" href="/deskripsi/{{$magazine->id}}" >Read More</a>
            </p>
            <div class='hero__buttons'>
                <a href='/pdf/{{$magazine->id}}'>
                    <button type="submit" class='read'>
                        <strong>Read Now</strong>
                    </button>
                </a>
                <a href='/deskripsi/{{$magazine->id}}'>
                    <button type="submit" class="desc">
                        <strong>Description</strong>
                    </button>
                </a>
            </div>
        </div>
        <div class='illustration'>
            <img src="{{ URL::asset('storage/' . $magazine->sampul) }}" id="highlight_magazine"/>
        </div>
    </div>

    @include('components.swiper')
    @include('components.footer')
    @include('components.globalScript')
    
    <script src="{{ URL::asset('libraryJs/pdf.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('libraryJs/pdf.worker.js') }}"></script>
</body>
</html>