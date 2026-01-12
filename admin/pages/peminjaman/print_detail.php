<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Data Pinjaman</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.3.0/paper.css">

    <style>
        /* Konfigurasi Ukuran F4 */
        @page {
            size: 210mm 330mm;
            /* Standar Folio/F4 Indonesia */
            margin: 0;
        }

        body {
            background-color: #f1f1f1;
            /* Warna abu-abu di luar kertas seperti di gambar */
        }

        .F4 .sheet {
            width: 210mm;
            height: 330mm;
        }

        article {
            padding: 20mm;
            /* Memberikan margin dalam agar tidak terlalu mepet tepi kertas */
        }

        /* Styling Judul */
        h2 {
            font-family: Arial, sans-serif;
            color: #00426D;
            /* Biru sesuai gambar */
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
            background-color: #00426D;
            /* Biru muda header */
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

            h2,
            table th {
                -webkit-print-color-adjust: exact;
                /* Memaksa warna muncul di print */
            }
        }
    </style>
</head>

<body class="F4">

    <section class="sheet">
        <article>
            <h2>Data Pinjaman</h2>

            <table>
                <thead>
                    <tr>
                        <th style="width: 30px">No</th>
                        <th>Judul Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Status</th>
                        <th>Hari Terlambat</th>
                        <th>Tanggal Dikembalikan</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "../../../config/koneksi.php";

                    // Menangkap parameter 'id' dari tombol di atas
                    if (!isset($_GET['id'])) {
                        die("<tr><td colspan='8' class='text-center'>ID Peminjaman tidak ditemukan</td></tr>");
                    }

                    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
                    $no = 1;

                    // Query untuk mengambil detail semua buku dalam satu transaksi
                    $sql = "SELECT 
                        dp.id_detail_peminjaman,
                        b.judul,
                        p.tgl_pinjam,
                        p.tgl_kembali,
                        dp.status,
                        dp.tgl_dikembalikan,
                        dp.hari_terlambat,
                        dp.keterangan
                    FROM detail_peminjaman dp
                    JOIN buku b ON dp.kode_buku = b.kode_buku
                    JOIN peminjaman p ON dp.id_peminjaman = p.id_peminjaman
                    WHERE dp.id_peminjaman = '$id'";

                    $query = mysqli_query($koneksi, $sql);

                    if (mysqli_num_rows($query) > 0) {
                        while ($row = mysqli_fetch_array($query)) {
                            // Logika format tampilan sesuai gambar
                            $terlambat = ($row['hari_terlambat'] > 0) ? $row['hari_terlambat'] . " Hari" : "-";
                            $tgl_kembali_fisik = ($row['tgl_dikembalikan'] && $row['tgl_dikembalikan'] != '0000-00-00')
                                ? $row['tgl_dikembalikan'] : "-";

                            echo "<tr>
                    <td class='text-center'>{$no}</td>
                    <td>{$row['judul']}</td>
                    <td class='text-center'>{$row['tgl_pinjam']}</td>
                    <td class='text-center'>{$row['tgl_kembali']}</td>
                    <td class='text-center'>
                        <span style='padding: 2px 8px; border-radius: 4px; font-size: 11px; background-color: #d1fae5; color: #065f46;'>
                            {$row['status']}
                        </span>
                    </td>
                    <td class='text-center'>{$terlambat}</td>
                    <td class='text-center'>{$tgl_kembali_fisik}</td>
                    <td>
                        <span style='color: #1e40af; font-size: 11px;'>
                            {$row['keterangan']}
                        </span>
                    </td>
                </tr>";
                            $no++;
                        }
                    } else {
                        echo "<tr><td colspan='8' class='text-center'>Tidak ada data buku untuk ID: $id</td></tr>";
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