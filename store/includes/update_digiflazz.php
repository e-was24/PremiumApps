<?php
function updateIfExpired() {
    $cacheFile = __DIR__ . "/../api/listDigiflazz.json"; 
    $updateUrl = "http://localhost:3000/digiflazz/update";

    // Kalau belum ada file → auto update
    if (!file_exists($cacheFile)) {
        file_get_contents($updateUrl);
        return;
    }

    // Ambil waktu terakhir file diupdate
    $lastUpdate = filemtime($cacheFile);
    $now = time();

    // 1800 detik = 30 menit
    if (($now - $lastUpdate) > 1800) {
        file_get_contents($updateUrl);
    }
}
