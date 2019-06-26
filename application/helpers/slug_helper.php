<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * WEBSITE E COMMERCE BERBASIS CODEIGNITER & AJAX 
 * @version 1.0
 * @author Muhammad Ilham Rizaldi | Email : muhammadilhamrizaldi@gmail.com | WA : 0822 3444 7450 
 * @copyright (c) 2019
 * PERINGATAN :
 * 1. DILARANG MENJUAL BELIKAN WEBSITE INI TANPA SEIZIN OLEH PIHAK PENGEMBANG APLIKASI
 * 2. TIDAK DIIZINKAN UNTUK MENGHAPUS KODE SUMBER APLIKASI
 * 3. SOURCE CODE DIPERBOLEHKAN UNTUK DIRUBAH UNTUK DIKEMBANGKAN DENGAN CATATAN TIDAK MENGHAPUS KODE SUMBER APLIKASI
 */

function slug($text)
{
    // replace non letter or digits by -
    $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
    // trim
    $text = trim($text, '-');
    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    // lowercase
    $text = strtolower($text);
    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);
    if (empty($text))
    {
        return 'n-a';
    }
    return $text;
}
