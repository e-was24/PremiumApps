<?php

function updateIfExpired()
{
    $cacheFile = __DIR__ . "/../../api/listDigiflazz.json";
    $updateUrl = "http://localhost:3000/digiflazz/update";

    if (!file_exists($cacheFile) || (time() - filemtime($cacheFile)) > 1800) {
        @file_get_contents($updateUrl);
    }
}

updateIfExpired();

function toRupiah($angka)
{
    return "Rp " . number_format($angka, 0, ',', '.');
}

// Ambil data dari API Node.js
$json = @file_get_contents("http://localhost:3000/digiflazz/list");
if ($json === false) {
    echo "<p>Gagal mengambil data dari server Node.js.</p>";
    exit;
}

$data = json_decode($json, true);
if (!$data || !isset($data['data'])) {
    echo "<p>Data produk tidak ditemukan.</p>";
    exit;
}

$produk = $data['data'];

// Ambil daftar brand unik
$brandList = array_unique(array_column($produk, 'brand'));
sort($brandList);

// Ambil brand yang dipilih user via GET
$selectedBrand = isset($_GET['brand']) ? $_GET['brand'] : '';
$selectedType = isset($_GET['type']) ? $_GET['type'] : "";

// Pagination setup
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$perPage = 10;

// status product
function getFinalProductStatus($produk)
{
    $buyer = $produk['buyer_product_status'];
    $seller = $produk['seller_product_status'];
    if ($buyer && $seller) {
        return '<span style="color: green; font-weight: bold; background:#024d0273; ">Available</span>';
    }

    if (!$buyer) {
        return '<span style="color: red; font-weight: bold; background: #7713066E;  font-size: .9em;">Not Available</span>';
    }

    if (!$seller) {
        return '<span style="color: orange; font-weight: bold; background: #8055046E;">unavailable</span>';
    }
    return '<span style="color: gray;">Unknown</span>';
}

// type option

$typeList = [];

if ($selectedBrand) {
    $filteredBrand = array_filter($produk, function ($p) use ($selectedBrand, $selectedType) {
        return strtolower(trim($p['brand'])) === strtolower(trim($selectedBrand));
    });
    $typeList = array_values(array_unique(array_column($filteredBrand, 'type')));
    sort($typeList);
}



?>

<title>Daftar Harga</title>
<?php include 'navbar.php'; ?>
<link rel="stylesheet" href="../assets/css/navbarV1.6.css">
<link rel="stylesheet" href="../assets/css/price_listV2.css">

<div class="cover">
    <form method="GET">
        <label>Pilih Brand:</label>
        <select name="brand" required onchange="this.form.submit()">
            <option value="">-- Pilih brand --</option>
            <?php foreach ($brandList as $br): ?>
                <option value="<?= htmlspecialchars($br) ?>"
                    <?= $selectedBrand === $br ? 'selected' : '' ?>>
                    <?= htmlspecialchars($br) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <!-- reset -->
        <input type="hidden" name="type" value="">
        <input type="hidden" name="page" value="1">
    </form>

    <!-- Type -->
    <?php if ($selectedBrand && !empty($typeList)): ?>
        <form method="GET" style="margin-top: 10px;">
            <input type="hidden" name="brand" value="<?= htmlspecialchars($selectedBrand) ?>">
            <input type="hidden" name="page" value="1">

            <label>Pilih Type:</label>
            <select name="type"
                <?= !$selectedBrand ? 'disabled' : '' ?>
                onchange="this.form.submit()">

                <option value="">-- Semua Type --</option>

                <?php foreach ($typeList as $tp): ?>

                    <option value="<?= htmlspecialchars($tp) ?>"
                        <?= $selectedType === $tp ? 'selected' : '' ?>>
                        <?= htmlspecialchars($tp) ?>
                    </option>

                <?php endforeach; ?>
            </select>
        </form>
    <?php endif ?>

    <?php if ($selectedBrand): ?>
        <h2>Daftar Harga <span><?= htmlspecialchars($selectedBrand) ?></span></h2>

        <?php if ($selectedType): ?>
            <h5>Type <span><?= htmlspecialchars($selectedType) ?></span></h5>
        <?php else: ?>
            <h5>Type <span>Semua Type</span></h5>
        <?php endif; ?>

    <?php else: ?>
        <h2>Daftar Harga [ pilih produk ]</h2>
        <h5>Type [ Pilih Type ]</h5>
    <?php endif; ?>
    <p class="disclaimer">Harga diurutkan dari yang termurah untuk memudahkan perbandingan.</p>

    <table class="table" border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>Code</th>
            <th>Layanan</th>
            <th>Brand</th>
            <th>Guest</th>
            <th>Harga Bronze</th>
            <th>Harga Silver</th>
            <th>Harga Gold</th>
            <th>Status</th>
            <th>Type</th>
        </tr>

        <?php
        if (!$selectedBrand) {
            echo '<tr><td colspan="8" style="text-align:center; font-weight:bold;">Silahkan pilih brand terlebih dahulu</td></tr>';
        } else {
            // fn (function)
            $filteredProduk = array_filter($produk, function ($p) use ($selectedBrand, $selectedType) {
                if (strtolower(trim($p['brand'])) !== strtolower(trim($selectedBrand))) {
                    return false;
                }
                if (!empty($selectedType)) {
                    if (strtolower(trim($p['type'])) !== strtolower(trim($selectedType))) {
                        return false;
                    }
                }
                return true;
            });

            if (empty($filteredProduk)) {
                echo '<tr><td colspan="8" style="text-align:center; font-weight:bold;">Produk untuk brand ' . htmlspecialchars($selectedBrand) . ' tidak ditemukan</td></tr>';
            } else {
                // Sortir harga member dari termurah
                usort($filteredProduk, fn($a, $b) => $a['price_member'] <=> $b['price_member']);

                $totalProduk = count($filteredProduk);
                $totalPages = ceil($totalProduk / $perPage);
                $start = ($page - 1) * $perPage;
                $currentProduk = array_slice($filteredProduk, $start, $perPage);

                foreach ($currentProduk as $p) {
                    echo '<tr>';
                    echo '<td class="code">' . htmlspecialchars($p['buyer_sku_code']) . '</td>';
                    echo '<td style="text-align:left; min-width:250px; max-width:350px;">' . htmlspecialchars($p['product_name']) . '</td>';
                    echo '<td class="brand">' . htmlspecialchars($p['brand']) . '</td>';
                    echo '<td>' . toRupiah($p['price_member']) . '</td>';
                    echo '<td>' . toRupiah($p['price_bronze']) . '</td>';
                    echo '<td>' . toRupiah($p['price_silver']) . '</td>';
                    echo '<td>' . toRupiah($p['price_gold']) . '</td>';
                    echo '<td class="status">' . '<span>' . getFinalProductStatus($p) . '</span>' . '</td>';
                    echo '<td>' . htmlspecialchars($p['type']) . '</td>';
                    echo '</tr>';
                }

                // Pagination links
                if ($totalPages > 1) {
                    echo '<tr><td colspan="8" style="text-align:center;" class="page-level">';
                    for ($i = 1; $i <= $totalPages; $i++) {
                        if ($i == $page) {
                            echo " <a class='click'>$i</a> ";
                        } else {
                            echo ' <a href="?brand=' . urlencode($selectedBrand) . '&type=' . urlencode($selectedType) . '&page=' . $i . '">' . $i . '</a> ';
                        }
                    }
                    echo '</td></tr>';
                }
            }
        }
        ?>
    </table>
</div>