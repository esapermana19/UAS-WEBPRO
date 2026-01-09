<?php
include "../config/koneksi.php";
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    switch ($page) {
        //USERS
        case 'users':
            include "pages/users/view.php";
            break;
        //ANGGOTA
        case 'anggota':
            include "pages/anggota/view.php";
            break;
        case 'tambah_anggota':
            include "pages/anggota/create.php";
            break;
        case 'edit_anggota':
            include "pages/anggota/edit.php";
            break;
        //BUKU
        case 'buku':
            include "pages/buku/view.php";
            break;
        case 'tambah_buku':
            include "pages/buku/create.php";
            break;
        case 'edit_buku':
            include "pages/buku/edit.php";
            break;
        //KATEGORI
        case 'kategori':
            include "pages/kategori/view.php";
            break;
        case 'tambah_kategori':
            include "pages/kategori/create.php";
            break;
        case 'edit_kategori':
            include "pages/kategori/edit.php";
            break;
        //HOME
        default:
            include "pages/home.php";
            break;
    }
} else {
    include "pages/home.php";
}
