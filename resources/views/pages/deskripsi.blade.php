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
    <p>Edisi : 2021</p>
    <p>Terbit : Januari 4, 2023</p>
    <p>Tebal : 89 halaman</p>
    </div>
</div>
<div class="parent-deskripsi">
    <h3>Description :</h3>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipiscing</p>
    <h4>Bahasa :</h4>
    <p>Bahasa Indonesia</p>
</div>
    
    @include('components.footer')
</body>
</html>