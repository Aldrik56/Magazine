const magazines = Array.from(document.getElementsByClassName('magazine'));
const buttons = Array.from(document.getElementsByClassName('toggle'));


let magWidth = window.innerWidth >= 800 ? 240 : 100;

//hanya 4 setengah majalah yang dapat dilihat langsung dari menu swiper
let endDisplay = getMaximumDisplayedMags();
let startDisplay = 0;


//jumlah majalah yang tercover/terdisplay setiap kali di swipe
//satu swipe akan menutup setengah majalah (jika ke kiri), dan mendisplay 
//setengah dari majalah berikutnya (jika ke kanan). Contoh, jika majalah di paling kanan
//hanya setengah keliatan karena ketutup oleh container, satu swipe ke kanan akan membuat 
//majalah tersebut keliatan penuh (0.5 + 0.5 = 1)

let magazinesPerSwipe = 1;
let steps = 0;

function getMaximumDisplayedMags() {
  const magRect = magazines[0].getBoundingClientRect();
  const magazineArea = document.querySelector('.magazines');
  const rect = magazineArea.getBoundingClientRect();
  const gap = 20;
  const totalWidth = gap + magRect.width;
  return rect.width/totalWidth;

}



function resizePosterWidth() {
  posterWidth = window.innerWidth >= 800 ? 240 : 150;
}

function toggleLightbox(magazine, isOpen) {
  const magLightbox = magazine.querySelector('.magazine__lightbox');
  magLightbox.style.height = isOpen ? '100%' : '0%';
  magLightbox.style.display = isOpen ? 'flex' : 'none';

}

function parseValue(px) {
  let numericalValue = px.split('p');
  return parseInt(numericalValue[0]);
}

function rearrangeMagazines() {
  
}

function swipe(dir) {
  const moveValue = 200 * dir;
  const newEnd = endDisplay + (dir * magazinesPerSwipe);
  const newStart = startDisplay + (dir * magazinesPerSwipe);
  const condition = dir == 1 ? newEnd <= magazines.length : newStart >= 0;

  console.log(`new End: ${newEnd}`);
  console.log(`new Start: ${newStart}`);
  console.log(condition);

  magazines.forEach((mag)=> {
    if (condition) {
      mag.style.left = `${parseValue(mag.style.left) - moveValue}px`;
      startDisplay = newStart;
      endDisplay = newEnd;
    }
  });

}

magazines.forEach((mag)=>{
  //initialize for swipe function
  mag.style.left = '0px';
  mag.addEventListener('mouseover', ()=> {
    toggleLightbox(mag,true);
  });

  mag.addEventListener('mouseout',  ()=> {
    toggleLightbox(mag,false);
  });
})

buttons.forEach((button)=> {
  button.addEventListener('click', ()=> {
    if (button.classList.contains('left')) {
      swipe(-1); 
    }
    else {
      swipe(1);
    }
  });
})

window.addEventListener('resize', ()=> {
  endDisplay = getMaximumDisplayedMags();
  console.log(endDisplay);
})

//detect swipe
let startX,startY,endX,endY;
magazines.addEventListener('touchstart', ()=> {
  
})