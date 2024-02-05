
<?php
$jumlahBuku;
$sorting = "oldest";
$i=0;
?>


<div class="magazineCollection__section swiper__section">
    <div class="swiper-box">
        <div style="display:flex;justify-content:space-between;align-items:center;width:100%;">
            <h1 style="margin:0px">More From ULTIMAGZ</h1>
            <div>
                <select name="display" id="displaySelect" name="display" >
                    <option value="" disabled selected>View</option>
                    <option value="simple">Simple</option>
                    <option value="grid">Grid</option>
                </select>
                <select name="sorting" id="sortingSelect" name="sorting">
                    <option value="" disabled selected>Sort</option>
                    <option value="oldest">Oldest</option>
                    <option value="latest">Latest</option>
                    <option value="special_edition">Special Edition</option>
                </select>
            </div>
        </div>
        <div class="swiperControl">
            <button class="next_button" >
                <img src="{{ URL::asset('assets/Arrow bar.svg') }}" />
            </button>
        </div>
        {{-- Display grid --}}
        <div class="displayGrid sampulMagazine__container">
            @foreach($magazines as $magazine)
            <div class="sampulMagazine__hoverBox">
                <img src="{{ URL::asset('storage/' . $magazine->sampul) }}" class="sampulPDF1">
                <p>{{$magazine->judul}}</p>
                <div class='swiperSlide__buttons' style='flex-direction:column;justify-content:center'>
                    <a href='/pdf/{{$magazine->id}}'>
                        <div class='read'>
                            <strong> Read Now</strong>
                        </div>
                    </a>
                    <a href='/deskripsi/{{$magazine->id}}'>
                        <div class='desc'>
                            <strong>Description</strong>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        {{-- Display simple --}}
        <swiper-container class="mySwiper sampulMagazine__container" id="mySwiper">
            {{-- {{$sorting === "latest" ? @for($i=0;i<count($magazines)-1;i++) : @for($i=count($magazines)-1;i >= 0;i--)}} --}}
                @foreach($magazines as $magazine)
                <div class="sampulMagazine__hoverBox">
                    <img src="{{ URL::asset('storage/' . $magazine->sampul) }}" class="sampulPDF1">
                    <p>{{$magazine->judul}}</p>
                    <div class='swiperSlide__buttons' style='flex-direction:column;justify-content:center'>
                        <a href='/pdf/{{$magazine->id}}'>
                            <div class='read'>
                                <strong> Read Now</strong>
                            </div>
                        </a>
                        <a href='/deskripsi/{{$magazine->id}}'>
                            <div class='desc'>
                                <strong>Description</strong>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
      </swiper-container>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    const displaySelect = document.querySelector('#displaySelect');
    const sortingSelect = document.querySelector('#sortingSelect');
    const displayGrid = document.querySelector('.displayGrid');
    const swiperControl = document.querySelector('.swiperControl');
    // const swiperEl = document.querySelector('.mySwiper');
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
              spaceBetween: 16,
          },
          432: {
              slidesPerView: "auto",
              spaceBetween: 16,
          },
          480 : {
              slidesPerView:  "auto",
              spaceBetween: 24,
          },
          810: {
              slidesPerView:  "auto",
              spaceBetween: 36,
          },
          1024: {
              slidesPerView:  "auto",
              spaceBetween: 48,
          },
          1280 : {
              slidesPerView: "auto",
              spaceBetween: 48,
          },
          1560 : {
              slidesPerView: "auto",
              spaceBetween: 67,
          },
          2560 : {
              slidesPerView: "auto",
              spaceBetween: 67,
          }
      }
  }
  Object.assign(mySwiper, params)
  document.querySelector('.next_button').addEventListener('click', () => {
      mySwiper.swiper.slideNext();
  });
    // const mySwiper = document.querySelector('.mySwiper');
    displaySelect.addEventListener('change', function () {
        const selectedValue = this.value;
        if (selectedValue === 'grid') {
            displayGrid.style.display = 'grid';
            mySwiper.style.display = 'none';
            swiperControl.style.display = 'none';
            // mySwiper.swiper.destroy();
        } else {
            displayGrid.style.display = 'none';
            mySwiper.style.display = 'block';
            swiperControl.style.display = 'block';
            mySwiper.initialize();
        }
    });
    sortingSelect.addEventListener('input', function () {
        const selectedValue = this.value;
        axios('/fetch-sorted-data', { params: { sorting: selectedValue } })
            .then(function (response) {
                const sortedMagazines = response.data;
                updateMagazineContent(sortedMagazines);
            })
            .catch(function (error) {
                console.error('Error fetching sorted data:', error);
            });
    });

function updateMagazineContent(sortedMagazines) {
    if(displaySelect.value === 'grid' || displaySelect.value === '') {
        const displayGrid = document.querySelector('.displayGrid'); // Change this selector accordingly
        const assetBaseUrl = "{{ asset('') }}";
        // Clear existing content in displayGrid
        displayGrid.innerHTML = '';
        sortedMagazines.forEach((magazine) => {
            const hoverBox = document.createElement('div');
            hoverBox.classList.add('sampulMagazine__hoverBox');
            hoverBox.innerHTML = `
                <img src="${assetBaseUrl}storage/${magazine.sampul}" class="sampulPDF1">
                <p>${magazine.judul}</p>
                <div class="swiperSlide__buttons" style="flex-direction:column;justify-content:center">
                    <div class="read">
                        <strong><a href="/pdf/${magazine.id}">Read Now</a></strong>
                    </div>
                    <div class="desc">
                        <strong><a href="/deskripsi/${magazine.id}">Description</a></strong>
                    </div>
                </div>
            `;
            displayGrid.appendChild(hoverBox);
        });
    } else if (displaySelect.value === 'simple') {
        const element = document.querySelector('.mySwiper');
        const assetBaseUrl = "{{ asset('') }}";
        // Clear existing content in element
        element.innerHTML = '';
        sortedMagazines.forEach((magazine) => {
            const swiperSlide = document.createElement('swiper-slide'); // Change to 'swiper-slide'
            swiperSlide.classList.add('sampulMagazine__hoverBox');
            swiperSlide.innerHTML = `
                <img src="${assetBaseUrl}storage/${magazine.sampul}" class="sampulPDF2">
                <p>${magazine.judul}</p>
                <div class="swiperSlide__buttons" style="flex-direction: column; justify-content: center">
                    <div class="read">
                        <strong><a href="/pdf/${magazine.id}">Read Now</a></strong>
                    </div>
                    <div class="desc">
                        <strong><a href="/deskripsi/${magazine.id}">Description</a></strong>
                    </div>
                </div>
            `;
            element.appendChild(swiperSlide);
            Object.assign(element, params);
            element.initialize();
        });
    }

}
</script>