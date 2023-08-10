const menuButton = document.getElementById('hamburger-menu');
  const menuOptions = document.querySelector('.nav__menu');
  let open = false;
  menuButton.addEventListener('click', function() {
    open = !open;
    alert(open);
    
    if (open) {   
      menuOptions.style.display = 'flex';
    }

    else {
      menuOptions.style.display = 'none';
    }
    
});