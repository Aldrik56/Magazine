
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
                    <strong><a href='#'>Description</a></strong>
                </button>
            </form>
        </div>
        <div class='illustration'>
            <canvas id="highlight_magazine"></canvas>
        </div>
    </div>

    @include('components.swiper')
    @include('components.footer')
    <script>
        //ini promise function dari pdf js
        async function renderIllustration(url, index) {
            const canvas = document.querySelector("#highlight_magazine");
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
        
        renderIllustration( listMagazine[listMagazine.length -1].file,  1);
    </script>
    <script src="{{ URL::asset('libraryJs/pdf.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('libraryJs/pdf.worker.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src='./js/navbar.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-element-bundle.min.js"></script>
    {{-- <script src='./js/swiper.js'></script> --}}
</body>
</html>