// ハンバーガーメニュー
window.onload = function () {
    var nav = document.getElementById('nav-wrapper');
    var hamburger = document.getElementById('js-hamburger');
    var blackBg = document.getElementById('js-black-bg');

    


    hamburger.addEventListener('click', function () {
        nav.classList.toggle('open');

        
    });

    blackBg.addEventListener('click', function () {
        nav.classList.remove('open');
        
        
    });
};

var hamburger = document.getElementById('js-hamburger');
var blackBg = document.getElementById('js-black-bg');

var penBtn = document.getElementById('pen_btn');
var closeBtn = document.getElementById('close_btn');

penBtn.addEventListener('click', function () {
    penBtn.classList.add("hidden");
    closeBtn.classList.remove("hidden");
});

closeBtn.addEventListener('click', function () {
    penBtn.classList.remove("hidden");
    closeBtn.classList.add("hidden");
    
    
});

