const magazines = Array.from(document.getElementsByClassName('magazine'));
const buttons = Array.from(document.getElementsByClassName('toggle'));
const magazineArea = document.querySelector('.magazines');
let magRect = magazines[0].getBoundingClientRect();
let magWidth = magRect.width;

let maxMagazinesDisplayed = getMaximumDisplayedMags();
let indexLimit = calculcateIndexLimit();

alert(indexLimit);

function getMaximumDisplayedMags() {
  const magRect = magazines[0].getBoundingClientRect();
  const rect = magazineArea.getBoundingClientRect();
  return rect.width/magRect.width;

}

function calculcateIndexLimit() {
  return Math.ceil(magazines.length / maxMagazinesDisplayed);
}

function resizePosterWidth() {
  let newMagRect = magazines[0].getBoundingClientRect();
  magWidth = newMagRect.width;
}

function toggleLightbox(magazine, isOpen) {
  const magLightbox = magazine.querySelector('.magazine__lightbox');
  magLightbox.style.height = isOpen ? '90%' : '0%';
  magLightbox.style.display = isOpen ? 'flex' : 'none';

}

function parseValue(px) {
  let numericalValue = px.split('p');
  return parseInt(numericalValue[0]);
}

let sliderIndex = 0;
let lastDir;

function swipe(dir) {
  // const newEnd = endDisplay + (dir * magazinesPerSwipe);
  // const newStart = startDisplay + (dir * magazinesPerSwipe);
  // const condition = dir == -1 ? newEnd <= magazines.length : newStart >= 0;

  if (dir == 1) sliderIndex++;
  else sliderIndex--;

  if (sliderIndex < 0) {
    sliderIndex = indexLimit;
  }

  if (sliderIndex > indexLimit) {
    sliderIndex = 0;
  }
  
  magazines.forEach((mag)=> {
    mag.style.transform = `translateX(${-100 * sliderIndex}%)`;
  });


}

magazines.forEach((mag)=>{
  // mag.style.left = '0px';
  mag.addEventListener('mouseover',()=> {
    toggleLightbox(mag,true);
  });

  mag.addEventListener('mouseout', ()=> {
    toggleLightbox(mag,false);
  });
})

buttons.forEach((button)=> {
  button.addEventListener('click', ()=> {
    if (button.classList.contains('right')) {
      swipe(1); 
    }
    else {
      swipe(-1);
    }
  });
})

window.addEventListener('resize', ()=> {
  maxMagazinesDisplayed = getMaximumDisplayedMags();
  indexLimit = calculcateIndexLimit();
})  

//detect swipe on smartphone/tablet
const minimumSwipeDistance = 50;
let startX,startY,endX,endY;
magazineArea.addEventListener('touchstart', (event)=> {
  startX = event.touches[0].clientX;
})

magazineArea.addEventListener('touchend', (event)=> {
  endX = event.changedTouches[0].clientX;
  const swipeDistance = Math.abs(endX-startX);
  if (swipeDistance >= minimumSwipeDistance) {
    if (endX-startX < 0) {
      swipe(1);
    }

    else {
      swipe(-1);
    }
  }
})