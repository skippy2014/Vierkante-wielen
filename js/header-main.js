window.addEventListener('scroll', function() {
    var body = document.querySelector('body');
    if (window.scrollY > 0) {
        body.classList.add('scrolled');
    } else {
        body.classList.remove('scrolled');
    }
});