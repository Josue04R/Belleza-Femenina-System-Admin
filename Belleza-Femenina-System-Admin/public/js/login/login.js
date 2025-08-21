document.addEventListener('DOMContentLoaded', function() {
    setTimeout(function() {
        document.querySelector('.graphicContent').style.opacity = '1';
        document.querySelector('.graphicContent').style.transform = 'translateY(0)';
        document.querySelector('.formContainer').style.opacity = '1';
        document.querySelector('.formContainer').style.transform = 'translateY(0)';
    }, 300);
});

// Prevenir scroll en toda la página
document.addEventListener('wheel', function(e) {
    e.preventDefault();
}, { passive: false });

document.addEventListener('touchmove', function(e) {
    e.preventDefault();
}, { passive: false });

document.addEventListener('keydown', function(e) {
    if ([32, 37, 38, 39, 40].indexOf(e.keyCode) > -1) {
        e.preventDefault();
    }
}, false);