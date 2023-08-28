{{-- script navbar --}}
<script>
    const hamburgerMenu = document.querySelector('#hamburger-menu')
    const navMenu = document.querySelector('.nav__menu')
  
    hamburgerMenu.addEventListener('click', () => {
  
      navMenu.classList.toggle('active')
    })
</script>
{{-- cdn jquery --}}
<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
{{-- cdn swiper js --}}
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-element-bundle.min.js"></script>
{{-- initialize swiper --}}
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
  Object.assign(swiperEl, params)
  document.querySelector('.next_button').addEventListener('click', () => {
      swiperEl.swiper.slideNext();
  });
  swiperEl.initialize();
</script>