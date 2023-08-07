<!DOCTYPE html>
<html lang="en">
<head>
    @include('components.header')
</head>
<body>
    @include('loading')
    @include('components.main')
    
    <script src="{{ URL::asset('libraryJs/pdf.worker.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script id="script">
        const url = '{{ URL::asset('magazine/test.pdf') }}';
        var loadingTask = pdfjsLib.getDocument(url);
        var canvas = document.getElementById('the-canvas1');
        var context = canvas.getContext('2d');
        var currentPage=1;
        var totalPage = 0;
        var scale = 1;

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

        $(window).ready(function() {
            if(window.innerWidth<=980){
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
                    element = $("<canvas />", {"id": "the-canvas"+i}).html("Loading...");
                    $("#magazine").turn("addPage", element);  
                }
                totalPage=parseInt(pdf.numPages);
                console.log(totalPage);
                for (var i = 1; i <= pdf.numPages; i++) {
                    renderPage(i);
                }
                $("main").css("display","flex");
                $(".loading_screen").css("display","none");

            });
        });

        $(window).resize(function() {
            if(window.innerWidth<=980){
                $("#magazine").turn("display", "single");
                setStyleMobile(currentPage);
            }else{
                $("#magazine").turn("display", "double");
                setStyleLaptop(currentPage);
            }
        });
        
    </script>
    <script src="{{URL::asset('js/loading.js')}}"></script>
    <script src="{{ URL::asset('libraryJs/turn.js') }}" type="text/javascript"></script>
    <script>
        //semua event listener
        // var main = document.querySelector('#main');
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
        var next_button = document.querySelector('.next_button');
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
        });

        zoom__control__zoomin.addEventListener('click', () => {
            var scale = parseInt(zoom__slider.value);
            scale+=1;
            zoom__slider.value = scale;
            if(scale<400 ){
                magazine.style.zoom = scale/100;
            }
        });
        zoom__control__zoomout.addEventListener('click', () => {
            var scale = parseInt(zoom__slider.value);
            scale-=1;
            zoom__slider.value = scale;
            if(scale<400 ){
                magazine.style.zoom = scale/100;
            }
        });

        
        page__slider.addEventListener('input', (e)=>{
            var page = e.target.value;
            $('#magazine').turn('page', page);
        });

        next_button.addEventListener('click',()=>{
            $('#magazine').turn('next');
            console.log(currentPage);
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
                if(main.requestFullscreen){
                    main.requestFullscreen();
                    document.querySelector('.main_top').style.height = "90vh";
                }else if(main.mozRequestFullScreen){
                    main.mozRequestFullScreen();
                    document.querySelector('.main_top').style.height = "90vh";
                }else if(main.webkitRequestFullscreen){
                    main.webkitRequestFullscreen();
                    document.querySelector('.main_top').style.height = "90vh";
                }else if(main.msRequestFullscreen){
                    main.msRequestFullscreen();
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