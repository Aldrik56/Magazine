const menuButton = document.getElementById('hamburger-menu');
const navbar = document.getElementsByTagName('nav')[0];
const page = document.querySelector('.home__page');
const menuOptions = document.querySelector('.nav__menu');
let open = false;
const navbarRect = navbar.getBoundingClientRect();

menuButton.addEventListener('click', function() {
  open = !open;    
  menuOptions.style.display = open? 'flex' : 'none';
  menuOptions.style.top = open? `${navbarRect.height}px` : '';
  page.style.overflow = open? 'hidden' : 'scroll';
    
});




//disable scroll karena gbs overflow:hidden
// window.addEventListener('scroll',()=> {
//   if (open) {
//     const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
//     const scrollLeft = window.pageXOffset || document.documentElement.scrollLeft
  
//     window.scrollTo(scrollLeft,scrollTop);
//   }
 
// })




