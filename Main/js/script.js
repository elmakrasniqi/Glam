let slideIndex = 1;
let slideTimer; 
showSlides(slideIndex);


function plusSlides(n) {
    clearInterval(slideTimer); 
    showSlides(slideIndex += n);
    startSlideTimer(); 
}

// Function to show a specific slide
function currentSlide(n) {
    clearInterval(slideTimer); 
    showSlides(slideIndex = n);
    startSlideTimer(); r
}

// Function to display slides
function showSlides(n) {
    const slides = document.querySelectorAll(".mySlidesFade");
    const dots = document.querySelectorAll(".dot");

    slideIndex = (n > slides.length) ? 1 : (n < 1) ? slides.length : n;

    slides.forEach(slide => slide.style.display = "none");
    dots.forEach(dot => dot.classList.remove("active"));

    slides[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].classList.add("active");
}

// Function to start the slide timer
function startSlideTimer() {
    slideTimer = setInterval(() => {
        plusSlides(1); 
    }, 5000); 
}


startSlideTimer();
