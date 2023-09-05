{{-- script navbar --}}
<script>
    const hamburgerMenu = document.querySelector('#hamburger-menu')
    const navMenu = document.querySelector('.nav__menu')
  
    hamburgerMenu.addEventListener('click', () => {
  
      navMenu.classList.toggle('active')
    })
    const otherProductSelect = document.querySelector(".otherProductSelect");

  otherProductSelect.addEventListener("change", function () {
    const selectedValue = this.value;
    if (selectedValue) {
      // Redirect to the selected URL
      window.location.href = selectedValue;
    }
  });
</script>
<script></script>
{{-- cdn jquery --}}
<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
{{-- cdn swiper js --}}
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-element-bundle.min.js"></script>
{{-- initialize swiper --}}
<script>
  
</script>