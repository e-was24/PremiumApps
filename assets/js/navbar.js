const menu = document.getElementById('menu');
const nav = document.getElementById('Navbar');

menu.addEventListener('click', () => {
    menu.classList.toggle('active');
    nav.classList.toggle('show');
});
