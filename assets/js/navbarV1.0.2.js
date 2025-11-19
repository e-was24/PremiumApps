const menu = document.getElementById('menu');
const nav = document.getElementById('Navbar');

// Pastikan variabel WebGL sudah ada
let canvas;
let renderer;

// Dipanggil saat halaman load
window.addEventListener("load", () => {
    setupWebGL();
});

// Buat WebGL / Three.js
function setupWebGL() {
    canvas = document.querySelector("canvas");

    if (!canvas) {
        console.error("Canvas tidak ditemukan!");
        return;
    }

    // Contoh WebGL biasa
    const gl = canvas.getContext("webgl");

    if (!gl) {
        console.error("WebGL tidak bisa diinisialisasi.");
        return;
    }

    // Set ukuran awal
    resizeCanvas();
}

// Resize canvas agar tidak 0px
function resizeCanvas() {
    canvas.width = canvas.clientWidth || 1;
    canvas.height = canvas.clientHeight || 1;

    // kalau kamu pakai Three.js
    if (renderer) {
        renderer.setSize(canvas.width, canvas.height);
    }
}

// Klik hamburger
menu.addEventListener("click", () => {
    nav.classList.toggle("show");
    menu.classList.toggle("active");

    resizeCanvas();
});
