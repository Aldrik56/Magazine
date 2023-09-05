<nav class='flex nav__user' >
  <div class="nav__content">
    <img class='logo' src='{{URL::asset('assets/navbar/Ultimagz-logo.svg')}}'/>
    <div class="nav__menu__desktop navMenu">
      <a class='text-stone-200'>Home</a>
      {{-- <a>Lorem</a> --}}
      {{-- <select name="otherProduct" id="">
        <option value="" disabled selected >Other Product</option>
        <option value=""><a href="https://ultimagz.com/">News</a></option>
        <option value=""><a href="https://fokus.ultimagz.com">Fokus</a></option>
      </select> --}}
      <select name="otherProduct" class="otherProductSelect">
        <option value="" disabled selected>Other Products</option>
        <option value="https://ultimagz.com/">News</option>
        <option value="https://fokus.ultimagz.com">Fokus</option>
      </select>
    </div>

    <svg id='hamburger-menu' xmlns="http://www.w3.org/2000/svg" width="37" height="25" viewBox="0 0 37 25" fill="none">
      <path d="M4.625 12.5H32.375" stroke="black" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
      <path d="M4.625 6.25H32.375" stroke="black" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
      <path d="M4.625 18.75H32.375" stroke="black" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
  </div>

  <div class='nav__menu navMenu'>
    <a class='text-stone-200'>Home</a>
      {{-- <a>Lorem</a> --}}
      <select name="otherProduct" class="otherProductSelect">
        <option value="" disabled selected >OtherProduct</option>
        <option value="https://ultimagz.com/">News</option>
        <option value=""><a href="https://fokus.ultimagz.com">Fokus</a></option>
      </select>
  </div>

</nav>

