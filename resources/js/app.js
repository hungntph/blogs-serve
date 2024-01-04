//show file image
let loadFile = (event) => {
  let showImage = document.getElementById('showImage');
  showImage.src = URL.createObjectURL(event.target.files[0]);
  showImage.onload = function () {
    URL.revokeObjectURL(showImage.src);
  };
};

//toogle popup
let tooglePopup = () => {
  document.getElementById("popup").classList.toggle("active");
}


//scroll
let previousScroll = window.scrollY;

document.addEventListener('scroll', () => {
  const header = document.getElementById('navbar');
  if (window.scrollY > previousScroll) {
    header.classList.remove('header-down');
    header.classList.add('header-up');
  } else {
    header.classList.remove('header-up');
    header.classList.add('header-down');
  }
  previousScroll = window.scrollY;
});

//show profile
function showProfile() {
  let profile = document.getElementById('profile');
  profile.classList.toggle('show-profile');
}

//show menu mobie
function showMenu() {
  let menu = document.getElementById('menu');
  menu.classList.toggle('show-profile');
}

//show search input
function showSearchInput() {
  let toggleSearch = document.getElementById("searchForm");
  toggleSearch.hasAttribute("hidden") ? toggleSearch.removeAttribute("hidden") : toggleSearch.setAttribute("hidden", "");
}

//Slides related blog
var slideIndex = 1;
var mediaQuery = window.matchMedia("(max-width: 768px)")

checkMediaQuery(mediaQuery);

function checkMediaQuery(mediaQuery) {
  if (mediaQuery.matches) {
    showSlides(slideIndex);
  }
}

mediaQuery.onchange = (e) => {
  if (e.matches) {
    checkMediaQuery(mediaQuery);
  } else {
    let slides = document.getElementsByClassName("slides");
    for (let i = 0; i < slides.length; i++) {
      slides[i].style.display = "block";
    }
  }
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  let slides = document.getElementsByClassName("slides");
  let dots = document.getElementsByClassName("dot");
  for (let i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (let i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex - 1].style.display = "block";
  dots[slideIndex - 1].className += " active";
}
