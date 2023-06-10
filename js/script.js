window.addEventListener('scroll', function () {
  var body = document.querySelector('body');
  if (window.scrollY > 0) {
    body.classList.add('scrolled');
  } else {
    body.classList.remove('scrolled');
  }
});

window.addEventListener('scroll', function () {
  var header = document.querySelector('header.navbar');
  var logo = header.querySelector('.logo img');
  var scrolledClass = 'scrolled';

  if (window.scrollY > 0) {
    header.classList.add(scrolledClass);
    logo.src = 'img/logo_dark.png'; // New image source
  } else {
    header.classList.remove(scrolledClass);
    logo.src = 'img/logo_light.png'; // Default image source
  }
});
