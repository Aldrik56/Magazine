
<?php
$jumlahBuku=1;

?>


<div class="swiper__section">
    <div class="swiperControl">
        <button class="next_button" >
            <img src="{{ URL::asset('Assets/Arrow bar.svg') }}" />
        </button>
    </div>
    <div class="swiper-box">
        <h1>More From ULTIMAGZ</h1>
        <swiper-container class="mySwiper" >
            @foreach($magazines as $magazine)
                <swiper-slide>
                    <canvas id="the-canvas{{$jumlahBuku}}"></canvas>
                    <?php $jumlahBuku++; ?>
                    <div class='swiperSlide__buttons' style='flex-direction:column;justify-content:center'>
                        <div class='read'>
                            <strong> <a href='/pdf/{{$magazine->id}}'>Read Now</a></strong>
                        </div>
                        <div class='desc'>
                            <strong><a href='#'>Description</a></strong>
                        </div>
                    </div>
                </swiper-slide>
            @endforeach
      </swiper-container>
    </div>
</div>

  <script>
        const swiperEl = document.querySelector('.mySwiper')
        const params = {
            slidesPerView: 5,
            spaceBetween: 30,
            loop: false,
            // navigation: {
            //     enabled : false,
            //     nextEl: '.next_button'
            // },
            breakpoints: {
                320: {
                    slidesPerView: 3,
                    spaceBetween: 52,
                },480 : {
                    slidesPerView: 3,
                },
                768: {
                    slidesPerView: 3,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
                1280 : {
                    slidesPerView: 5,
                    spaceBetween: 60,
                }
            }
        }
        Object.assign(swiperEl, params)
        document.querySelector('.next_button').addEventListener('click', () => {
            swiperEl.swiper.slideNext();
        });
        swiperEl.initialize();
</script>
  <script>
    //ini promise function dari pdf js
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
    const listMagazine = @json($magazines);
    listMagazine.forEach((magazine, index) => {
        console.log(magazine.file);
        renderPage( magazine.file, index + 1);
    });

</script>