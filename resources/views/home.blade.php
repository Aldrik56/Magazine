
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
                <h1>Check Out the Latest Updates From</h1>
                <h1 class='title'>ULTIMAGZ</h1>
            </div>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                Lorem ipsum dolor sit amet, consectetur adipiscing
            </p>
            <div class='hero__buttons'>
              <div class='read'>
                <strong> <a href='#'>Read Now</a></strong>
              </div>

              <div class='desc'>
                <strong><a href='#'>Description</a></strong>
              </div>
            </div>
        </div>
        <div class='illustration'>
            <img src="../assets/hero/test 5.svg"></img>
        </div>
    </div>

    @include('components.swiper')
    @include('components.footer')
    <script>
        //ini promise function dari pdf js
        // async function renderPage(jumlahBuku, url) {
        //     const canvas = document.querySelector('#the-canvas'+jumlahBuku);
        //     var loadingTask = pdfjsLib.getDocument(url);
        //     var scale = 1;
        //     const context = canvas.getContext('2d');
        //     const pdf = await loadingTask.promise;
        //     const page = await pdf.getPage(1);
        //     const viewport = page.getViewport({ scale: scale });
        //     canvas.width = viewport.width;
        //     canvas.height = viewport.height;
            
        //     const renderContext = {
        //         canvasContext: context,
        //         viewport: viewport
        //     };
            
        //     await page.render(renderContext).promise;
        // }


        // //ini buat render semua magazine
        // const listMagazine = @json($listMagazine);
        // listMagazine.forEach((magazine, index) => {
        //     renderPage(index + 1, magazine.url);
        // });
        
        //hamburger menu 
        

    </script>

    <script src='./js/navbar.js'></script>
    <script src='./js/swiper.js'></script>
</body>
</html>