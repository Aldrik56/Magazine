{{-- ini halaman home (bagiannya kevin) --}}

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
    @include('components.swiper')
    <div class="home__section" style="display:flex; height:3000px">
        @foreach($listMagazine as $magazine)
            <div>
                <canvas id="the-canvas{{$jumlahBuku}}"></canvas>
                <h1>{{ $magazine['name'] }}</h1>
                <p>{{ $magazine['description'] }}</p>
                <p>{{ $magazine['uploaded_at'] }}</p>
                <p>Index: {{ $loop->index }}</p>
                {{$jumlahBuku++}}
            </div>
        @endforeach
    </div>

    <script>
        //ini promise function dari pdf js
        async function renderPage(jumlahBuku, url) {
            const canvas = document.querySelector('#the-canvas'+jumlahBuku);
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
            renderPage(index + 1, magazine.url);
        });


    </script>
</body>
</html>