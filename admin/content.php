<?php
include "../config/koneksi.php";
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    switch ($page) {
        case 'users':
            include "pages/users/view.php";
            break;
    
        case 'anggota':
            include "pages/anggota/view.php";
            break;
    
        case 'buku':
            include "pages/buku/view.php";
            break;
    
        case 'kategori':
            include "pages/kategori/view.php";
            break;
    
        default:
            include "pages/home.php";
            break;
    }
} else {
    include "pages/home.php";
}
