<?php
$listMagazine = [
    [
        'id' => 1,
        'name' => 'Magazine 1',
        'url' => URL::asset('magizine/test.pdf'),
        'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.',
        'uploaded_at' => '2021-08-20 00:00:00'
    ],
    [
        'id' => 2,
        'name' => 'Magazine 2',
        'url' => URL::asset('magizine/random.pdf'),
        'description' => 'Lorem ipsum dolor sit amet dddd consectetur adipisicing elit. Quisquam, voluptatum.',
        'uploaded_at' => '2021-08-20 00:00:00'
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
    @include('components.header')
<body>
    <div class="home_section">
        @foreach($listMagazine as $magazine)
            <div>
                <canvas id="the-canvas"></canvas>
                <h1>{{ $magazine['name'] }}</h1>
                <p>{{ $magazine['description'] }}</p>
                <p>{{ $magazine['uploaded_at'] }}</p>
                <p>Index: {{ $loop->index }}</p>
                {{-- <a href="{{ URL::asset('magizine/test.pdf') }}">Read</a> --}}
            </div>
        @endforeach
    </div>
    <script>
        async function renderPage(pageNumber) {
            const canvas = document.querySelector('#the-canvas' + pageNumber);
            const context = canvas.getContext('2d');
            
            const pdf = await loadingTask.promise;
            const page = await pdf.getPage(pageNumber);
            
            const viewport = page.getViewport({ scale: scale });
            canvas.width = viewport.width;
            canvas.height = viewport.height;
            
            const renderContext = {
                canvasContext: context,
                viewport: viewport
            };
            
            await page.render(renderContext).promise;
        }
        listMagazine=[
            {
                id:1,
                name:"Magazine 1",
                url:"{{ URL::asset('magizine/test.pdf') }}",
                description : "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.",
                uploaded_at : "2021-08-20 00:00:00"
            },
            {
                id:1,
                name:"Magazine 2",
                url:"{{ URL::asset('magizine/random.pdf') }}",
                description : "Lorem ipsum dolor sit amet dddd consectetur adipisicing elit. Quisquam, voluptatum.",
                uploaded_at : "2021-08-20 00:00:00"
            }
        ]
    </script>
</body>
</html>