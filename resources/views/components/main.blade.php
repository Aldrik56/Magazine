<main controls id="main"> 
    <div class="main_top">
        <div class="prev_button">
            <svg style="transform:rotate(180deg);"viewBox="-4 -4 30 52"><path d="M1.15 42.05a2.62 2.62 0 0 1 0-3.45L16.17 22 1.15 5.4a2.62 2.62 0 0 1 0-3.45 2.06 2.06 0 0 1 3.12 0l16.58 18.32c.87.96.87 2.5 0 3.45L4.27 42.05c-.43.48-1 .72-1.56.72a2.1 2.1 0 0 1-1.56-.72Z" fill="currentColor"></path></svg>
        </div>
        <div class="magazine_section">
            <div id="magazine"class="animated">
                <canvas id="the-canvas1"></canvas>
            </div>
        </div>
        <div class="next_button">
            {{-- <div class="hidden__description"><p>Next</p></div> --}}
            <svg viewBox="-4 -4 30 52"><path d="M1.15 42.05a2.62 2.62 0 0 1 0-3.45L16.17 22 1.15 5.4a2.62 2.62 0 0 1 0-3.45 2.06 2.06 0 0 1 3.12 0l16.58 18.32c.87.96.87 2.5 0 3.45L4.27 42.05c-.43.48-1 .72-1.56.72a2.1 2.1 0 0 1-1.56-.72Z" fill="currentColor"></path></svg>
        </div>
    </div>
    <div class="control_section">
        <div class="pagenumber__control">
            <p class="current__page">1</p>
            
            <p>/</p>
            <p class="total__page"></p>
            <input type="range" class="page__slider" min="1" max="100" value="1" step="1"/>
        </div>
        <div class="zoom__control">
            <input type="button" class="zoom__control__zoomout" value="-">
            <input type="range" class="zoom__slider" min="100" max="400" value="100" step="1"/>
            <input type="button" class="zoom__control__zoomin" value="+">
        </div>
        <div class="fullscreen_control">
            <svg viewBox="0 0 36 36"><path d="M27.7 10.29A.98.98 0 0 0 27 10h-4a1 1 0 0 0 0 2h3v3a1 1 0 0 0 2 0v-4a.98.98 0 0 0-.29-.7Zm-19.4 0A.98.98 0 0 1 9 10h4a1 1 0 0 1 0 2h-3v3a1 1 0 0 1-2 0v-4c0-.28.11-.52.29-.7ZM27.71 25.7A.98.98 0 0 0 28 25v-4a1 1 0 0 0-2 0v3h-3a1 1 0 0 0 0 2h4c.28 0 .52-.11.7-.29Zm-19.42 0A.98.98 0 0 1 8 25v-4a1 1 0 0 1 2 0v3h3a1 1 0 0 1 0 2H9a.98.98 0 0 1-.7-.29Z" fill="currentColor"></path></svg> 
        </div>
    </div>
</main>