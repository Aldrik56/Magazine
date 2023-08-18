
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
    ]
];
?>

<!DOCTYPE html>

<html lang="en">
@include('components.header')
<body class="home__page">
    @include('components.navbar')
    <div class='hero'>
        <div class='content'>
            <div class='main'>
                <h1>Check Out Latest Updates From</h1>
                <h1 class='title'>ULTIMAGZ</h1>
            </div>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                Lorem ipsum dolor sit amet, consectetur adipiscing
            </p>
            <form action="deskripsi" method="post" class='hero__buttons'>
                <button type="submit" class='read'>
                    <strong> <a href='#'>Read Now</a></strong>
                </button>
                <button type="submit" class="desc">
                    <strong><a href='#'>Description</a></strong>
                </button>
            </form>
        </div>
        <div class='illustration'>
            <img src="../assets/hero/test 5.svg"/>
        </div>
    </div>

    @include('components.swiper')
    @include('components.footer')
    <script src="{{ URL::asset('libraryJs/pdf.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('libraryJs/pdf.worker.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src='./js/navbar.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-element-bundle.min.js"></script>
    {{-- <script src='./js/swiper.js'></script> --}}
</body>
</html>