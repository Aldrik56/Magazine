const magazines = document.getElementsByClassName('magazine');


function toggleLightbox(magazine, isOpen) {
  const magLightbox = magazine.querySelector('.magazine__lightbox');
  magLightbox.style.height = isOpen ? '100%' : '0%';
  magLightbox.style.display = isOpen ? 'flex' : 'none'
  console.log(magLightbox.style.height)

}

Array.from(magazines).forEach((mag)=>{
  mag.addEventListener('mouseover', function() {
    toggleLightbox(mag, true);
  });

  mag.addEventListener('mouseout', function() {
    toggleLightbox(mag,false);
  })
})