<?php

function timeConvert ( $zaman ){
    $zaman =  strtotime($zaman);
    $zaman_farki = time() - $zaman;
    $saniye = $zaman_farki;
    $dakika = round($zaman_farki/60);
    $saat = round($zaman_farki/3600);
    $gun = round($zaman_farki/86400);
    $hafta = round($zaman_farki/604800);
    $ay = round($zaman_farki/2419200);
    $yil = round($zaman_farki/29030400);
    if( $saniye < 60 ){
        if ($saniye == 0){
            return "az önce";
        } else {
            return $saniye .' saniye önce';
        }
    } else if ( $dakika < 60 ){
        return $dakika .' dakika önce';
    } else if ( $saat < 24 ){
        return $saat.' saat önce';
    } else if ( $gun < 7 ){
        return $gun .' gün önce';
    } else if ( $hafta < 4 ){
        return $hafta.' hafta önce';
    } else if ( $ay < 12 ){
        return $ay .' ay önce';
    } else {
        return $yil.' yıl önce';
    }
}

function dateTurkish ($tarih) {

    $tarih = date("d F Y - l");

    $ing_aylar = array("January","February","March","May","April","June","July","August","September","October","November","December");
    $tr_aylar = array("Ocak","Şubat","Mart","Nisan","Mayıs","Haziran","Temmuz","Ağustos","Eylül","Ekim","Kasım","Aralık");

    $ing_gunler = array("Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday");
    $tr_gunler = array("Pazartesi","Salı","Çarşamba","Perşembe","Cuma","Cumartesi","Pazar");

    $tarih = str_replace($ing_aylar,$tr_aylar,$tarih);
    $tarih = str_replace($ing_gunler,$tr_gunler,$tarih);

    return $tarih;
}