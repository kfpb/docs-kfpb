<?php
/**
 * function.php - Helper functions untuk aplikasi docs-kfpb
 * File ini berisi fungsi-fungsi bantu yang digunakan di home.php
 * Dibuat sebagai placeholder karena file asli tidak ter-commit ke Git.
 */

/**
 * Format tanggal Indonesia
 */
if (!function_exists('tgl_indo')) {
    function tgl_indo($tgl) {
        $bulan = array(
            1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        );
        if (!$tgl || $tgl == '0000-00-00') return '-';
        $pecah = explode('-', $tgl);
        if (count($pecah) < 3) return $tgl;
        return $pecah[2] . ' ' . $bulan[(int)$pecah[1]] . ' ' . $pecah[0];
    }
}

/**
 * Format angka dengan pemisah ribuan
 */
if (!function_exists('format_angka')) {
    function format_angka($angka) {
        return number_format($angka, 0, ',', '.');
    }
}

/**
 * Sanitize input untuk mencegah SQL injection dasar
 */
if (!function_exists('bersihkan')) {
    function bersihkan($str) {
        return htmlspecialchars(strip_tags(trim($str)));
    }
}

/**
 * Truncate string
 */
if (!function_exists('potong_teks')) {
    function potong_teks($teks, $panjang = 50) {
        if (strlen($teks) > $panjang) {
            return substr($teks, 0, $panjang) . '...';
        }
        return $teks;
    }
}
