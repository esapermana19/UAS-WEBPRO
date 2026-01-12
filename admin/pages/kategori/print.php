<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Data Kategori</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.3.0/paper.css">
    
    <style>
        /* Konfigurasi Ukuran F4 */
        @page { 
            size: 210mm 330mm; /* Standar Folio/F4 Indonesia */
            margin: 0;
        }

        body {
            background-color: #f1f1f1; /* Warna abu-abu di luar kertas seperti di gambar */
        }

        .F4 .sheet {
            width: 210mm;
            height: 330mm;
        }

        article {
            padding: 20mm; /* Memberikan margin dalam agar tidak terlalu mepet tepi kertas */
        }

        /* Styling nama_kategori */
        h2 {
            font-family: Arial, sans-serif;
            color: #00426D; /* Biru sesuai gambar */
            text-align: center;
            margin-top: 0;
            margin-bottom: 25px;
            font-size: 24px;
        }

        /* Styling Tabel agar mirip dengan gambar */
        table {
            width: 100%;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
            font-size: 13px;
        }

        table th {
            background-color: #00426D; /* Biru muda header */
            color: #ffffffff;
            border: 1px solid #dee2e6;
            padding: 10px;
            text-align: center;
        }

        table td {
            border: 1px solid #dee2e6;
            padding: 8px 10px;
            vertical-align: middle;
        }

        /* Center alignment untuk kolom tertentu */
        .text-center {
            text-align: center;
        }

        /* Menghilangkan background abu-abu saat diprint */
        @media print {
            body {
                background-color: white;
            }
            h2, table th {
                -webkit-print-color-adjust: exact; /* Memaksa warna muncul di print */
            }
        }
    </style>
</head>

<body class="F4">

    <section class="sheet">
        <article>
            <h2>Data Kategori</h2>
            
            <table>
                <thead>
                    <tr>
                        <th style="width: 30px">No</th>
                        <th>ID Kategori</th>
                        <th>Nama Kategori</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "../../../config/koneksi.php";

                    $no = 1;
                    $sql = "SELECT * FROM kategori";

                    $where = [];
                    if (!empty($_GET['nama_kategori'])) {
                        $nama_kategori = mysqli_real_escape_string($koneksi, $_GET['nama_kategori']);
                        $where[] = "buku.nama_kategori LIKE '%$nama_kategori%'";
                    }
                    if (!empty($_GET['kategori_id'])) {
                        $kategori_id = mysqli_real_escape_string($koneksi, $_GET['kategori_id']);
                        $where[] = "buku.kategori_id = '$kategori_id'";
                    }

                    if (!empty($where)) {
                        $sql .= " WHERE " . implode(" AND ", $where);
                    }

                    $query = mysqli_query($koneksi, $sql);
                    while ($buku = mysqli_fetch_array($query)) {
                        echo "<tr>
                                <td class='text-center'>{$no}</td>
                                <td>{$buku['kategori_id']}</td>
                                <td>{$buku['nama_kategori']}</td>
                              </tr>";
                        $no++;
                    }
                    ?>
                </tbody>
            </table>
        </article>
    </section>

    <script>
        // Otomatis print saat halaman selesai dimuat
        window.onload = function() {
            window.print();
        }
    </script>
</body>

</html>