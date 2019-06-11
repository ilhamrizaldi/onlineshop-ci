<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * WEBSITE E-COMMERCE BERBASIS CODEIGNITER & AJAX 
 * @version 1.0
 * @author Muhammad Ilham Rizaldi | Email : muhammadilhamrizaldi@gmail.com | WA : 0822 3444 7450 
 * @copyright (c) 2019
 * PERINGATAN :
 * 1. DILARANG MENJUAL BELIKAN WEBSITE INI TANPA SEIZIN OLEH PIHAK PENGEMBANG APLIKASI
 * 2. TIDAK DIIZINKAN UNTUK MENGHAPUS KODE SUMBER APLIKASI
 * 3. SOURCE CODE DIPERBOLEHKAN UNTUK DIRUBAH UNTUK DIKEMBANGKAN DENGAN CATATAN TIDAK MENGHAPUS KODE SUMBER APLIKASI
 */
function sms($msg, $to)
{
    $urlkita    = 'https://websms.co.id/api/smsgateway?user=username&pass=password&to='.$to.'&msg='.$msg.'';
    $stream_options = array(
        'https' => array(
            'method'  => 'GET',
        ),
    );
    $context  = stream_context_create($stream_options);
    $urlkita = preg_replace("/ /", "%20", $urlkita);
    $response = file_get_contents($urlkita, null, $context);

    return $response;
}
