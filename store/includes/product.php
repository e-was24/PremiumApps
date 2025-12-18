<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Detail Produk</title>
</head>
<body style="color:white;padding:20px">

<?php
$brand  = $_GET['brand']  ?? '';
$name   = $_GET['name']   ?? '';
$price  = $_GET['price']  ?? 0;
$stock  = $_GET['stock']  ?? 0;
$buyer  = $_GET['buyer']  ?? 0;
$seller = $_GET['seller'] ?? 0;

if (!$brand || !$name) {
    echo "Produk tidak ditemukan";
    exit;
}

function rupiah($n) {
    return "Rp " . number_format($n, 0, ',', '.');
}
?>



<h2><?= htmlspecialchars($name) ?></h2>
<p><b>Brand:</b> <?= htmlspecialchars($brand) ?></p>
<p><b>Harga:</b> <?= rupiah($price) ?></p>

<p><b>Status:</b>
<?php
if ($buyer && $seller) echo "<span style='color:green'>Available</span>";
elseif (!$buyer) echo "<span style='color:red'>Not Available</span>";
elseif (!$seller) echo "<span style='color:orange'>System Gangguan</span>";
?>
</p>

<p><b>Stock:</b>
<?= $stock == 0 ? "Infinite" : "Limited" ?>
</p>

</body>
</html>
