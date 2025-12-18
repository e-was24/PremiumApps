const productOut = document.getElementById("product_output");

// ================= STATUS =================
function finalStatus(product) {
    if (product.buyer_product_status && product.seller_product_status) {
        return '<span style="color:green">Available</span>';
    }
    if (!product.buyer_product_status) {
        return '<span style="color:red">Not Available</span>';
    }
    if (!product.seller_product_status) {
        return '<span style="color:orange">System Gangguan</span>';
    }
    return '<span style="color:gray">Unknown</span>';
}

// ================= RUPIAH =================
function toRupiah(angka) {
    return "Rp " + Number(angka).toLocaleString("id-ID");
}

// ================= STOCK =================
function stockChack(product) {
    return product.stock == 0
        ? '<span style="color: green; background:#0a5a1586; padding:5px 20px; border-radius:10px;">infinite</span>'
        : '<span style="color:red;">limited</span>';
}

// ================= FETCH =================
async function fetchData() {
    try {
        const response = await fetch("http://localhost:3000/digiflazz/list");
        if (!response.ok) throw new Error(response.status);

        const dataValue = await response.json();

        const products = Array.isArray(dataValue)
            ? dataValue
            : Array.isArray(dataValue.data) ? dataValue.data : [];

        if (!products.length) {
            productOut.innerText = "Data produk kosong";
            return;
        }

        // 1 brand = 1 card
        const onePerBrand = Array.from(
            new Map(products.map(p => [p.brand, p])).values()
        );

        let html = "";

        onePerBrand.forEach(item => {
            html += `
                <a href="includes/brand.php?brand=${encodeURIComponent(item.brand)}" class="card-link">
                    <div class="product-out">
                        <b>${item.brand}</b><br>
                        <p style="flex-direction: column;display:flex;justify-content:center;align-items:center;">
                            Status:&nbsp; ${stockChack(item)}
                            Category: &nbsp; ${item.category}
                        </p>
                    </div>
                </a>
            `;
        });

        productOut.innerHTML = html;

    } catch (err) {
        productOut.innerHTML = `<p class="product-err">Server mengalami gangguan. <br> <span> Gagal memuat data </span></p>`;
        console.error("FETCH ERROR:", err);
    }
}

fetchData();
