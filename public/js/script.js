// Scroll Navbar Start
var nav = document.querySelector('nav');

window.addEventListener('scroll', function() {
    if (window.pageYOffset > 120) {
        nav.classList.add('nav-background', 'shadow');
    } else {
        nav.classList.remove('nav-background', 'shadow');
    }
});
// Scroll Navbar End

// Slider Start

// Javascript for image slider manual navigation
var btns = document.querySelectorAll('.manual-btn');
var sliders = document.querySelectorAll('.banner');
var s = document.getElementById("sliders");
// var firstSlider = document.querySelector('.banner');

let currentSlide = 1;
btns[0].classList.add('active');
sliders.forEach((slider) => {
    slider.classList.add('hidden');
});
sliders[0].classList.remove('hidden');

var manualNav = function(manual) {

    btns.forEach((btn) => {
        btn.classList.remove('active');
    });
    btns[manual].classList.add('active');

    sliders.forEach((slider) => {
        slider.classList.add('hidden');
    });
    sliders[manual].classList.remove('hidden');
    // sliders[0].style['margin-top'] = -800 * manual + 'px';
    s.style['margin-top'] = -800 * manual + 'px';
}

btns.forEach((btn, i) => {
    btn.addEventListener("click", () => {
        manualNav(i);
        currentSlide = i;
    });
});


// Javascript for image slider autoplay navigation
var repeat = function(activeClass) {

    var repeater = () => {
        setTimeout(function() {
            let active = document.querySelector('.active');
            active.classList.remove('active');
            sliders.forEach((slider) => {
                slider.classList.add('hidden');
            });

            sliders[currentSlide].classList.remove('hidden');
            // sliders[0].style['margin-top'] = -800 * currentSlide + 'px';
            // sliders[0].style['transition-duration'] = '2s';
            s.style['margin-top'] = -800 * currentSlide + 'px';
            btns[currentSlide].classList.add('active');
            currentSlide++;

            if (sliders.length == currentSlide) {
                currentSlide = 0;
            }
            if (currentSlide >= sliders.length) {
                return;
            }
            repeater();
        }, 10000);
    }
    repeater();
}
repeat();
// Slider End

// Toggle Theme Start - light and dark mode
function updateIcon() {
    if ($("body").hasClass("dark")) {
        $(".toggle-theme i").removeClass("bi-moon");
        $(".toggle-theme i").addClass("bi-sun");
    } else {
        $(".toggle-theme i").removeClass("bi-sun");
        $(".toggle-theme i").addClass("bi-moon");
    }
}

function toggleTheme() {
    if (localStorage.getItem("theme") !== null) {
        if (localStorage.getItem("theme") === "dark") {
            $("body").addClass("dark");
        } else {
            $("body").removeClass("dark");
        }
    }
    updateIcon();
}
toggleTheme();


$(".toggle-theme").on("click", function() {
    $("body").toggleClass("dark");
    if ($("body").hasClass("dark")) {
        localStorage.setItem("theme", "dark");
    } else {
        localStorage.setItem("theme", "light");
    }
    updateIcon();
});
// Toggle Theme End - light and dark mode