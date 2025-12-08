<?php
// lib/helper.php

/**
 * Memformat angka (disimpan sebagai unit terkecil) dan kode mata uang menjadi string yang mudah dibaca.
 * Contoh: (50000, 'USD') akan menjadi "$500.00".
 * Contoh: (50000, 'IDR') akan menjadi "Rp 50.000".
 *
 * @param int    $amount_in_smallest_unit Jumlah dalam unit mata uang terkecil (misal: sen untuk USD).
 * @param string $currency_code Kode mata uang ISO 3 huruf (misal: 'IDR', 'USD').
 * @return string String mata uang yang telah diformat.
 */
function format_currency($amount_in_smallest_unit, $currency_code = 'USD') {
    $currency_code = strtoupper($currency_code);

    // Daftar subunit untuk mata uang umum. 1 unit utama = X unit terkecil.
    // Untuk IDR dan JPY, kita anggap tidak ada subunit dalam praktik umum.
    $subunits = [
        'USD' => 100, 'EUR' => 100, 'GBP' => 100,
        'JPY' => 1,   'IDR' => 1,
    ];

    $subunit_value = $subunits[$currency_code] ?? 100; // Default 100 untuk mata uang lain

    // Hitung nilai dalam unit utama
    $amount_in_major_unit = $amount_in_smallest_unit / $subunit_value;

    // Lokalisasi untuk pemformatan
    $locales = [
        'USD' => 'en_US', 'EUR' => 'de_DE', 'GBP' => 'en_GB',
        'IDR' => 'id_ID', 'JPY' => 'ja_JP',
    ];
    
    $locale = $locales[$currency_code] ?? 'en_US'; // Locale default

    $formatter = new NumberFormatter($locale, NumberFormatter::CURRENCY);

    // Untuk mata uang yang tidak memiliki bagian desimal dalam model penyimpanan kita,
    // jangan tampilkan angka di belakang koma.
    if (in_array($currency_code, ['IDR', 'JPY'])) {
        $formatter->setAttribute(NumberFormatter::FRACTION_DIGITS, 0);
    } else {
        $formatter->setAttribute(NumberFormatter::FRACTION_DIGITS, 2);
    }

    return $formatter->formatCurrency($amount_in_major_unit, $currency_code);
}