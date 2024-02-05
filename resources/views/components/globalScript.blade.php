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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
{{-- cdn jquery --}}
<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
{{-- cdn swiper js --}}
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-element-bundle.min.js"></script>
{{-- initialize swiper --}}
<script>
  
</script>