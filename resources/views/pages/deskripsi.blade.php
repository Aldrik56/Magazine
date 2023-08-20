{{-- ini halaman deskripsi (bagiannya maryadi) --}}
<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('components.header')
<body class="badan">
    @include('components.navbar')
  <div class="backtoback">
        <div class="container">
        </div>
    </div>
    <div class="parent">
    <img class="pdf" src="test 5.svg">
    <div class="parent-title">
    <h1>Title : Lorem Ipsum Dolor Sit Amet</h1>
    <br>
    <p>Edisi : 2021</p>
    <br>
    <p>Terbit : Januari 4, 2023</p>
    <br>
    <p>Tebal : 89 halaman</p>
    <form action="deskripsi" method="post" class='hero__buttons'>
                <button type="submit" class='read'>
                    <strong> <a>Read Now</a></strong>
                </button>
                <button type="submit" class="desc">
                    <strong><a href='#'>Share</a></strong>
                </button>
            </form>
    </div>
</div>
<div class="parent-deskripsi">
    <h3>Description :</h3>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipiscing</p>
    <br>
    <h4>Bahasa :</h4>
    <p>Bahasa Indonesia</p>
    
</div>
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