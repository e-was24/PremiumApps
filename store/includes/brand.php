<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Produk Brand</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/brandV1.css">
    <link rel="stylesheet" href="../assets/css/navbarV1.6.css">

    <style>
        body {
            background: #111;
            color: white;
            font-family: "poppins", sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .brand-title {
            font-size: 24px;
            margin: 20px 0;
        }

        #product_list {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
            justify-content: center;
        }

        .product-out {
            border: 1px solid #282829;
            padding: 16px;
            border-radius: 12px;
            width: 260px;
            cursor: pointer;
            transition: 0.2s;
            background: #2D2D2E;
        }

        .product-out:hover {
            transform: scale(1.03);
            background: #020617dd;
        }
    </style>
</head>

<body>

    <?php
    $brand = $_GET['brand'] ?? '';
    if (!$brand) {
        echo "<p>Brand tidak ditemukan</p>";
        exit;
    }
    ?>

    <?php include 'navbar.php' ?>
    <h2 class="brand-title">Brand: <?= htmlspecialchars($brand) ?></h2>

    <div id="product_list">Loading produk...</div>

    <script>
        // ================= RUPIAH =================
        function toRupiah(num) {
            return "Rp " + Number(num).toLocaleString("id-ID");
        }

        // ================= STOCK =================
        function stockChack(product) {
            return product.stock == 0 ?
                '<span style="color:#22c55e">Infinite</span>' :
                '<span style="color:#ef4444">Limited</span>';
        }

        // ================= STATUS =================
        function finalStatus(product) {
            if (product.buyer_product_status && product.seller_product_status)
                return '<span style="color:#22c55e">Available</span>';
            if (!product.buyer_product_status)
                return '<span style="color:#ef4444">Not Available</span>';
            if (!product.seller_product_status)
                return '<span style="color:#f59e0b">System Gangguan</span>';
            return '<span style="color:#94a3b8">Unknown</span>';
        }


        // ================= FILTER TYPE PRODUK ============    

        function filterType(product, targetType) {
            return product.type?.toLowerCase() === targetType.toLowerCase();
        }

        // ================= LOAD PRODUCTS =================
        async function loadProducts() {
            try {
                const res = await fetch("http://localhost:3000/digiflazz/list");
                if (!res.ok) throw new Error(res.status);

                const data = await res.json();

                const products = Array.isArray(data) ?
                    data :
                    Array.isArray(data.data) ? data.data : [];

                const brandName = "<?= strtolower(addslashes($brand)) ?>";

                // ✅ FILTER BRAND + SORT TERMURAH
                const filtered = products
                    .filter(p => p.brand.toLowerCase() === brandName)
                    .sort((a, b) => a.price - b.price);

                if (!filtered.length) {
                    document.getElementById("product_list").innerText =
                        "Produk untuk brand ini tidak ada";
                    return;
                }

                let html = "";

                filtered.forEach(item => {
                    html += `
                    <div class="product-out"
                        onclick="location.href='product.php
                            ?brand=${encodeURIComponent(item.brand)}
                            &name=${encodeURIComponent(item.product_name)}
                            &price=${item.price}
                            &stock=${item.stock}
                            &buyer=${item.buyer_product_status ? 1 : 0}
                            &seller=${item.seller_product_status ? 1 : 0}'">

                        <b>${item.product_name}</b><br><br>
                        <div class="last-grup">
                            <p>Harga: ${toRupiah(item.price)}</p>
                            <p>Status: ${finalStatus(item)}</p>
                            <p>Stock: ${stockChack(item)}</p>
                        </div>
                    </div>
                `;
                });

                document.getElementById("product_list").innerHTML = html;

            } catch (err) {
                document.getElementById("product_list").innerText =
                    "Gagal memuat data produk";
                console.error(err);
            }
        }

        loadProducts();
    </script>

</body>

</html>