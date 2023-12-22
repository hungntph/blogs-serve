//show file image
let loadFile = (event) => {
  let showImage = document.getElementById('showImage');
  showImage.src = URL.createObjectURL(event.target.files[0]);
  showImage.onload = function() {
    URL.revokeObjectURL(showImage.src);
  };
};

//toogle popup
let tooglePoup = () => {
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
let toggle = document.getElementById('toggleFrofile');
let profile = document.getElementById('profile');

toggle.addEventListener('click', () => {
  profile.classList.toggle('show-profile');
})
