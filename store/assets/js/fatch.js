// Contoh JSON produk
const products =
    [
        {
            "name": "Netflix Premium",
            "image": "https://images.unsplash.com/photo-1662338034986-39d0ca684d6c?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTV8fG5ldGZsaXglMjBsb2dvfGVufDB8fDB8fHww"
        },
        {
            "name": "Spotify Family",
            "image": "https://images.unsplash.com/photo-1614680376593-902f74cf0d41?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8c3BvdGlmeSUyMGxvZ298ZW58MHx8MHx8fDA%3D"
        },
        {
            "name": "Disney+ Hotstar",
            "image": "https://images.unsplash.com/photo-1662338571362-5ad7a300074a?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTJ8fERpc25leSUyQiUyMGxvZ298ZW58MHx8MHx8fDA%3D"
        },
        {
            "name": "HBO Max",
            "image": "https://images.unsplash.com/photo-1761044591020-9a797e979b38?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8N3x8SEJPJTIwTWF4JTIwbG9nb3xlbnwwfHwwfHx8MA%3D%3D"
        },
        {
            "name": "Apple Music",
            "image": "https://images.unsplash.com/photo-1683105020625-5f7c8dd746bf?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OHx8QXBwbGUlMjBNdXNpYyUyMGxvZ298ZW58MHx8MHx8fDA%3D"
        }
    ];

// Ambil container
const container = document.getElementById("product");

// Render produk
products.forEach(product => {
    const card = document.createElement("div");
    card.className = "product-card";

    card.innerHTML = `
    <img src="${product.image}" alt="${product.name}" class="w-full h-48 object-cover">
    <div class="descript">
        <h3 class="text-lg font-semibold mb-2">${product.name}</h3>
    </div>
    `;

    container.appendChild(card);
});
