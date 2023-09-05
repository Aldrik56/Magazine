<!DOCTYPE html>
<html lang="en">
@include('components.header')
<body class="main__page">
    @include('components.loading')
    @include('components.navbar')

    <main controls id="main"> 
        <div class="main_top">
            <div class="magazine_section">
                <div id="magazine"class="animated">
                    <canvas id="main-canvas1"></canvas>
                </div>
            </div>
        </div>
        <div class="control_section">
            <div class="prev_button">
                    <img src="{{URL::asset('assets/arrow_left.svg')}}" alt="">
                </div>
            <div class="pagenumber__control">
                <p class="current__page">1</p>
                
                <p>/</p>
                <p class="total__page"></p>
                <input type="range" class="page__slider" min="1" max="100" value="1" step="1"/>
            </div>
            <div class="zoom__control">
                <input type="image" src="{{URL::asset('assets/minus.svg')}}" class="zoom__control__zoomout" style="padding:0px 5px" value="-">
                <input type="range" class="zoom__slider" min="100" max="400" value="100" step="1"/>
                <input type="image" src="{{URL::asset('assets/plus.svg')}}" class="zoom__control__zoomin" style="padding:0px 5px" value="+">
            </div>
            <div class="fullscreen_control">
                <svg viewBox="0 0 36 36"><path d="M27.7 10.29A.98.98 0 0 0 27 10h-4a1 1 0 0 0 0 2h3v3a1 1 0 0 0 2 0v-4a.98.98 0 0 0-.29-.7Zm-19.4 0A.98.98 0 0 1 9 10h4a1 1 0 0 1 0 2h-3v3a1 1 0 0 1-2 0v-4c0-.28.11-.52.29-.7ZM27.71 25.7A.98.98 0 0 0 28 25v-4a1 1 0 0 0-2 0v3h-3a1 1 0 0 0 0 2h4c.28 0 .52-.11.7-.29Zm-19.42 0A.98.98 0 0 1 8 25v-4a1 1 0 0 1 2 0v3h3a1 1 0 0 1 0 2H9a.98.98 0 0 1-.7-.29Z" fill="currentColor"></path></svg>
                <img src="{{URL::asset('assets/fullscreen.svg')}}" alt="">
            </div>
            <div class="main_next_button">
                <img src="{{URL::asset('assets/arrow_right.svg')}}" alt="">
            </div>
        </div>
    </main>
    @include('components.swiper')
    @include('components.globalScript')

    <script src="{{ URL::asset('libraryJs/pdf.js') }}" type="text/javascript"></script>
    <script src="{{URL::asset('js/loading.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('libraryJs/turn.js') }}" type="text/javascript"></script>
    <script id="script">
        // import pdfjsLib from 'pdfjs-dist';
        $(function() {
            pdfjsLib.GlobalWorkerOptions.workerSrc = '/js/pdf.worker.min.js';    
        });
        const url = @json($magazine);
        const pdfurl = '{{ asset('storage/') }}/' + url.file;
        var loadingTask = pdfjsLib.getDocument(pdfurl);
        var currentPage=1;
        var totalPage = 0;
        var scale = 1;

        async function renderPage(pageNumber) {
            const canvas = document.querySelector('#main-canvas' + pageNumber);
            const context = canvas.getContext("2d", { colorSpace: 'srgb',alpha:true, willReadFrequently: true });
            
            const pdf = await loadingTask.promise;
            const page = await pdf.getPage(pageNumber);
            const scale = 2.5;
            const viewport = page.getViewport({ scale });
            canvas.width = viewport.width;
            canvas.height = viewport.height;
            
            const renderContext = {
                canvasContext: context,
                viewport: viewport
            };  
            await page.render(renderContext).promise;
        }

        $(window).ready(function() {
            if(window.innerWidth<=820){
                $("#magazine").turn("display", "single");
                setStyleMobile(1);
            }else {
                $("#magazine").turn("display", "double");
                setStyleLaptop(1);
            }
            loadingTask.promise.then((pdf)=> {
                $(".total__page").html(pdf.numPages);
                $(".page__slider").attr("max",pdf.numPages);
                for(var i=2;i<=pdf.numPages;i++){
                    if(i%2==0){
                        element = $("<canvas />", {"id": "main-canvas"+i,"class":"even"}).html("Loading...");
                        $("#magazine").turn("addPage", element);  
                    }else {
                        element = $("<canvas />", {"id": "main-canvas"+i,"class":"odd"}).html("Loading...");
                        $("#magazine").turn("addPage", element);
                    }
                }
                totalPage=parseInt(pdf.numPages);
                for (var i = 1; i <= pdf.numPages; i++) {
                    renderPage(i);
                }
                $("main").css("display","flex");
                $(".loading_screen").css("display","none");

            });
        });

        $(window).resize(function() {
            if(window.innerWidth<=820){
                $("#magazine").turn("display", "single");
                setStyleMobile(currentPage);
            }else{
                $("#magazine").turn("display", "double");
                setStyleLaptop(currentPage);
            }
        });

    </script>
    <script>
        //semua event listener
        var mainEl = document.querySelector('#main');
        var magazine = document.querySelector('#magazine');
        var magazine_section = document.querySelector('.magazine_section');
        var main_top = document.querySelector('.main_top');

        var zoom__slider = document.querySelector('.zoom__slider');
        var zoom__control__zoomin = document.querySelector('.zoom__control__zoomin');
        var zoom__control__zoomout = document.querySelector('.zoom__control__zoomout');
        var main = document.querySelector('#main');
        var fullscreen_control = document.querySelector('.fullscreen_control');
        var current__page = document.querySelector('.current__page');
        var prev_button = document.querySelector('.prev_button');
        var next_button = document.querySelector('.main_next_button');
        var page__slider = document.querySelector('.page__slider');


        var dragStartX, dragStartY;
        var scrollStartLeft, scrollStartTop;
        var isDragging = false;

        magazine_section.addEventListener('mousedown', (e)=>{
            isDragging = true;
            dragStartX = e.clientX  || e.touches[0].clientX;
            dragStartY = e.clientY || e.touches[0].clientY ;
            scrollStartLeft = magazine_section.scrollLeft;
            scrollStartTop = main_top.scrollTop;
        });
        magazine_section.addEventListener('mousemove', (e)=>{
            if(isDragging){
                var clientX = e.clientX || e.touches[0].clientX; ;
                var clientY = e.clientY || e.touches[0].clientY;
                magazine_section.scrollLeft = scrollStartLeft - clientX + dragStartX;
                magazine_section.scrollTop = scrollStartTop - clientY + dragStartY;
            }
        });

        magazine_section.addEventListener('touchstart', (e)=>{
            isDragging = true;
            dragStartX = e.touches[0].clientX ;
            dragStartY = e.touches[0].clientY;
            scrollStartLeft = magazine_section.scrollLeft;
            scrollStartTop = magazine_section.scrollTop;
        });
        
        magazine_section.addEventListener('touchmove', (e)=>{
            if(isDragging){
                var clientX = e.touches[0].clientX;
                var clientY = e.touches[0].clientY;
                magazine_section.scrollLeft = scrollStartLeft - clientX + dragStartX;
                magazine_section.scrollTop = scrollStartTop - clientY + dragStartY;
            }
        });

        magazine_section.addEventListener('mouseup', (e)=>{
            isDragging = false;
        });

        // all event listener
        zoom__slider.addEventListener('input',(e)=>{
            var scale = e.target.value;
            // $('#magazine').turn('zoom', scale/100);
            magazine.style.zoom = scale/100;
            const value = (e.target.value - e.target.min) / (e.target.max - e.target.min);
            const percent = value * 100;
            e.target.style.background = `linear-gradient(to right, #ED2736 ${percent}%, white ${percent}%)`;
        });

        zoom__control__zoomin.addEventListener('click', () => {
            var scale = parseInt(zoom__slider.value);
            scale+=1;
            zoom__slider.value = scale;
            if(scale<400 ){
                magazine.style.zoom = scale/100;
            }

        });
        zoom__control__zoomout.addEventListener('click', (e) => {
            var scale = parseInt(e.target.value);
            scale-=1;
            e.target.value = scale;
            if(scale<400 ){
                magazine.style.zoom = scale/100;
            }
        });
        page__slider.addEventListener('input', (e)=>{
            var page = e.target.value;
            const value = (e.target.value - e.target.min) / (e.target.max - e.target.min);
            const percent = value * 100;
            e.target.style.background = `linear-gradient(to right, #ED2736 ${percent}%, white ${percent}%)`;
            $('#magazine').turn('page', page);
        });
        next_button.addEventListener('click',()=>{
            $('#magazine').turn('next');
        });
        prev_button.addEventListener('click',()=>{
            page__slider.value = currentPage;
            $('#magazine').turn('previous');
        }); 
        
        document.addEventListener('keydown',(e)=>{
            if(e.keyCode==39){
                $('#magazine').turn('next');
            }else if(e.keyCode==37){
                $('#magazine').turn('previous');
            }
        });

        fullscreen_control.addEventListener('click', () => {
            if(!document.fullscreenElement && !document.mozFullScreenElement && !document.webkitFullscreenElement && !document.msFullscreenElement){
                if(mainEl.requestFullscreen){
                    mainEl.requestFullscreen();
                    document.querySelector('.main_top').style.height = "90vh";
                }else if(mainEl.mozRequestFullScreen){
                    mainEl.mozRequestFullScreen();
                    document.querySelector('.main_top').style.height = "90vh";
                }else if(main.webkitRequestFullscreen){
                    mainEl.webkitRequestFullscreen();
                    document.querySelector('.main_top').style.height = "90vh";
                }else if(mainEl.msRequestFullscreen){
                    mainEl.msRequestFullscreen();
                    document.querySelector('.main_top').style.height = "90vh";
                }
            }else {
                if(document.exitFullscreen){
                    document.exitFullscreen();
                }else if(document.mozCancelFullScreen){
                    document.mozCancelFullScreen();
                }else if(document.webkitExitFullscreen){
                    document.webkitExitFullscreen();
                }else if(document.msExitFullscreen){
                    document.msExitFullscreen();
                }
            }
        });
        
        marginForOnePage = true;
        $('#magazine').turn({gradients: true, acceleration: true});
        $("#magazine").bind("turned", function(event, page, view) {
            currentPage = page;
            page__slider.value = currentPage;
            const value = (page__slider.value - page__slider.min) / (page__slider.max - page__slider.min);
            const percent = value * 100;
            page__slider.style.background = `linear-gradient(to right, #ED2736 ${percent}%, white ${percent}%)`;
            current__page.innerHTML = $("#magazine").turn("view").join(" - ");
            if($(document).width()<=800){
                setStyleMobile(page);
            }else {
                setStyleLaptop(page);
            }
        });

    </script>
    <script>
        var magazine2 = $("#magazine");
        //styling javascript
        var main = $("#main");
        //margin y
        var originalMarginY = (main.height()-magazine2.height())/2+"px";
        //margin untuk page awal
        var originalMarginXFirstPage = (main.width()-magazine2.width()-(magazine2.width()/2))/2+"px";
        //margin untuk page terakhir
        var originalMarginXLast = (main.width()-magazine2.width()+(magazine2.width()/2))/2+"px";
        //margin untuk page tengah
        var originalMarginX = (main.width()-magazine2.width())/2+"px";

        const setStyleLaptop = (page)=> {
        // Set margin
            magazine2.css({
                marginTop: originalMarginY,
                marginBottom: originalMarginY,
                marginLeft: originalMarginXFirstPage,
                marginRight: originalMarginXFirstPage
            });

            if (totalPage <= page && page!=1) {
                magazine2.css({
                marginLeft: originalMarginXLast,
                marginRight: originalMarginXLast
                });
            } else if (page === 1) {
                marginForOnePage = true;
                magazine2.css({
                    marginLeft: originalMarginXFirstPage,
                    marginRight: originalMarginXFirstPage
                });
            } else {
                marginForOnePage = false;
                magazine2.css({
                marginLeft: originalMarginX,
                marginRight: originalMarginX
                });
            }
        };

        const setStyleMobile = (page) => {
            magazine2.css({
                marginTop: "0px",
                marginBottom: "0px",
                marginLeft: "0px",
                marginRight: "0px"
            });
        };
        
    </script>

</body>
</html>