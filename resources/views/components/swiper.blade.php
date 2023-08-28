
<?php
$jumlahBuku=1;

?>


<div class="swiper__section">
    <div class="swiperControl">
        <button class="next_button" >
            <img src="{{ URL::asset('assets/Arrow bar.svg') }}" />
        </button>
    </div>
    <div class="swiper-box">
        <h1>More From ULTIMAGZ</h1>
        <swiper-container class="mySwiper" >
            @foreach($magazines as $magazine)
                <swiper-slide>
                    <img src="{{ URL::asset('storage/' . $magazine->sampul) }}" class="sampulPDF">
                    <p>{{$magazine->judul}}</p>
                    <?php $jumlahBuku++; ?>
                    <div class='swiperSlide__buttons' style='flex-direction:column;justify-content:center'>
                        <div class='read'>
                            <strong> <a href='/pdf/{{$magazine->id}}'>Read Now</a></strong>
                        </div>
                        <div class='desc'>
                            <strong><a href='/deskripsi/{{$magazine->id}}'>Description</a></strong>
                        </div>
                    </div>
                </swiper-slide>
            @endforeach
      </swiper-container>
    </div>
</div>