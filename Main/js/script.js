let slideIndex = 1;
let slideTimer; 
showSlides(slideIndex);


function plusSlides(n) {
    clearInterval(slideTimer); 
    showSlides(slideIndex += n);
    startSlideTimer(); 
}

function currentSlide(n) {
    clearInterval(slideTimer); 
    showSlides(slideIndex = n);
    startSlideTimer(); r
}

function showSlides(n) {
    const slides = document.querySelectorAll(".mySlidesFade");
    const dots = document.querySelectorAll(".dot");

    slideIndex = (n > slides.length) ? 1 : (n < 1) ? slides.length : n;

    slides.forEach(slide => slide.style.display = "none");
    dots.forEach(dot => dot.classList.remove("active"));

    slides[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].classList.add("active");
}

function startSlideTimer() {
    slideTimer = setInterval(() => {
        plusSlides(1); 
    }, 5000); 
}


startSlideTimer();
