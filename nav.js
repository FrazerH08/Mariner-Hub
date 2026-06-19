const navEl = document.querySelector('.nav');
const hamburgerEl = document.querySelector('.hamburger');

hamburgerEl.addEventListener('click', () => {
    navEl.classList.toggle('nav--open');
    hamburgerEl.classList.toggle('hamburger--open');
    document.body.classList.toggle('menu-open');
});

navEl.addEventListener('click', () => {
    navEl.classList.remove('nav--open');
    hamburgerEl.classList.remove('hamburger--open');
    document.body.classList.remove('menu-open');
});


// const myPara =document.getElementById("login");

// myPara.innerHTML="<a 'class=nav_item' href=logout.php >Logout</a>";

// document.getElementById("login").href = "logout.php";
// document.getElementById("login").a = "Logout";