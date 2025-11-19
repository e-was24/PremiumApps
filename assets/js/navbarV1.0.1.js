const menu = document.getElementById('menu');
const nav = document.getElementById('Navbar');

window.addEventListener("load", () => {
    initWebGL(); // atau renderer.setSize(...)
});


menu.addEventListener("click", () => {
    canvas.width = canvas.clientWidth;
    canvas.height = canvas.clientHeight;
    renderer.setSize(canvas.width, canvas.height);
});
