var loader;

function loadNow(opacity) {
    if (opacity <= 0) {
        displayContent();
    } else {
        loader.style.opacity = opacity;
        window.setTimeout(function() {
            loadNow(opacity - 0.05);
        }, 90);
    }
}

function displayContent() {
    loader.style.display = 'none';
    document.getElementById('mobile').style.display = 'block';
}

document.addEventListener("DOMContentLoaded", function() {
    loader = document.getElementById('loader');
    loadNow(1);
});

// document.addEventListener('DOMContentLoaded', function() {
//     setTimeout(function() {
//         $('#page-loader').fadeOut(3000);
//     }, 3000);
// });
