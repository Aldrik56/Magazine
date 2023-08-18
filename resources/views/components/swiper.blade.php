
<?php
$jumlahBuku=1;
$listMagazine = [
    [
        'id' => 1,
        'name' => 'Magazine 1',
        'url' => URL::asset('magazine/test.pdf'),
        'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.',
        'uploaded_at' => '2021-08-20 00:00:00'
    ],
    [
        'id' => 2,
        'name' => 'Magazine 2',
        'url' => URL::asset('magazine/random.pdf'),
        'description' => 'Lorem ipsum dolor sit amet dddd consectetur adipisicing elit. Quisquam, voluptatum.',
        'uploaded_at' => '2021-08-20 00:00:00'
    ],
    [
        'id' => 3,
        'name' => 'Magazine 2',
        'url' => URL::asset('magazine/random.pdf'),
        'description' => 'Lorem ipsum dolor sit amet dddd consectetur adipisicing elit. Quisquam, voluptatum.',
        'uploaded_at' => '2021-08-20 00:00:00'
],
[
        'id' => 4,
        'name' => 'Magazine 2',
        'url' => URL::asset('magazine/random.pdf'),
        'description' => 'Lorem ipsum dolor sit amet dddd consectetur adipisicing elit. Quisquam, voluptatum.',
        'uploaded_at' => '2021-08-20 00:00:00'
],
[
        'id' => 5,
        'name' => 'Magazine 2',
        'url' => URL::asset('magazine/random.pdf'),
        'description' => 'Lorem ipsum dolor sit amet dddd consectetur adipisicing elit. Quisquam, voluptatum.',
        'uploaded_at' => '2021-08-20 00:00:00'
],
[
        'id' => 6,
        'name' => 'Magazine 2',
        'url' => URL::asset('magazine/random.pdf'),
        'description' => 'Lorem ipsum dolor sit amet dddd consectetur adipisicing elit. Quisquam, voluptatum.',
        'uploaded_at' => '2021-08-20 00:00:00'
],
[
        'id' => 7,
        'name' => 'Magazine 2',
        'url' => URL::asset('magazine/random.pdf'),
        'description' => 'Lorem ipsum dolor sit amet dddd consectetur adipisicing elit. Quisquam, voluptatum.',
        'uploaded_at' => '2021-08-20 00:00:00'
],
[
    [
        'id' => 8,
        'name' => 'Magazine 2',
        'url' => URL::asset('magazine/random.pdf'),
        'description' => 'Lorem ipsum dolor sit amet dddd consectetur adipisicing elit. Quisquam, voluptatum.',
        'uploaded_at' => '2021-08-20 00:00:00'
],
]
];
?>


<div class="swiper__section">
    <div class="swiperControl">
        <button class="next_button" >
            <img src="{{ URL::asset('Assets/Arrow bar.svg') }}" />
        </button>
    </div>
    <swiper-container class="mySwiper" >
            @foreach($listMagazine as $magazine)
                <swiper-slide>
                    <canvas id="the-canvas{{$jumlahBuku}}"></canvas>
                    <?php $jumlahBuku++; ?>
                </swiper-slide>
            @endforeach
      </swiper-container>
</div>


  <script>
        const swiperEl = document.querySelector('.mySwiper')
        const params = {
            slidesPerView: 5,
            spaceBetween: 30,
            loop: false,
            // navigation: {
            //     enabled : true,
            //     nextEl: '.next_button'
            // },
            breakpoints: {
                640: {
                    slidesPerView: 1,
                },
                768: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
                1280 : {
                    slidesPerView: 5,
                    spaceBetween: 66,
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
        var loadingTask = pdfjsLib.getDocument(url);
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

    //ini buat render semua magazine
    const listMagazine = @json($listMagazine);
    listMagazine.forEach((magazine, index) => {
        renderPage(magazine.url, index + 1);
    });

</script>
{{-- <div class='swiper'>
  <div class='swiper__title'>
    <h3>More From ULTIMAGZ</h3>
  </div>

    <div class='magazines'>
      <div class="magazine">
        <div class='img__container'>
            <div class='magazine__lightbox'>
                <div class='hero__buttons' style='flex-direction:column;justify-content:center'>
                    <div class='read'>
                        <strong> <a href='#'>Read Now</a></strong>
                    </div>

                    <div class='desc'>
                        <strong><a href='#'>Description</a></strong>
                    </div>
                </div>
            </div>
            <img src='assets/hero/test 5.svg'>
        </div>
        <p>Issue</p>

        
        </div>

    

        <div class="magazine">
        <div class='img__container'>
            <div class='magazine__lightbox'>
                <div class='hero__buttons' style='flex-direction:column;justify-content:center'>
                    <div class='read'>
                        <strong> <a href='#'>Read Now</a></strong>
                    </div>

                    <div class='desc'>
                        <strong><a href='#'>Description</a></strong>
                    </div>
                </div>
            </div>
            <img src='assets/hero/test 5.svg'>
        </div>
        <p>Issue</p>

        
        </div>


   <div class='magazines'>
      <div class="magazine">
        <div class='img__container'>
            <div class='magazine__lightbox'>
                <div class='hero__buttons' style='flex-direction:column;justify-content:center'>
                    <div class='read'>
                        <strong> <a href='#'>Read Now</a></strong>
                    </div>

                    <div class='desc'>
                        <strong><a href='#'>Description</a></strong>
                    </div>
                </div>
            </div>
            <img src='assets/hero/test 5.svg'>
        </div>
        <p>Issue</p>

        
        </div>


    </div>



    <div class="magazine">
      <div class='img__container'>
            <div class='magazine__lightbox'>

                <div class='hero__buttons' style='flex-direction:column;justify-content:center'>
                    <div class='read'>
                        <strong> <a href='#'>Read Now</a></strong>
                    </div>

                    <div class='desc'>
                        <strong><a href='#'>Description</a></strong>
                    </div>
                </div>
            </div>
            <img src='assets/hero/test 5.svg'>
            <p>Issue</p>


        </div>
    </div>
    <div class="magazine">
      <div class='img__container'>
            <div class='magazine__lightbox'>

                <div class='hero__buttons' style='flex-direction:column;justify-content:center'>
                    <div class='read'>
                        <strong> <a href='#'>Read Now</a></strong>
                    </div>

                    <div class='desc'>
                        <strong><a href='#'>Description</a></strong>
                    </div>
                </div>
            </div>
            <img src='assets/hero/test 5.svg'>
            <p>Issue</p>

        </div>
    </div>
    <div class="magazine">
      <div class='img__container'>
            <div class='magazine__lightbox'>

                <div class='hero__buttons' style='flex-direction:column;justify-content:center'>
                    <div class='read'>
                        <strong> <a href='#'>Read Now</a></strong>
                    </div>

                    <div class='desc'>
                        <strong><a href='#'>Description</a></strong>
                    </div>
                </div>
            </div>
            <img src='assets/hero/test 5.svg'>
            <p>Issue</p>


        </div>
    </div>
    <div class="magazine">
      <div class='img__container'>
            <div class='magazine__lightbox'>

                <div class='hero__buttons' style='flex-direction:column;justify-content:center'>
                    <div class='read'>
                        <strong> <a href='#'>Read Now</a></strong>
                    </div>

                    <div class='desc'>
                        <strong><a href='#'>Description</a></strong>
                    </div>
                </div>
            </div>
            <img src='assets/hero/test 5.svg'>
            <p>Issue</p>


        </div>
    </div>

    <div class='toggle left'>
        <i class='fas fa-caret-left'></i>
    </div>
    <div class='toggle right'>
        <i class='fas fa-caret-right'></i>
    </div>

    </div>
  </div>
</div> --}}
