<div class="mb-4">
    <h1 class="text-2xl font-bold text-primary mb-6">
        Edit Buku
    </h1>
    <?php
    $kode_buku = $_GET['kode_buku'];
    $sql = "SELECT * FROM buku WHERE kode_buku = '$kode_buku'";
    $execute = mysqli_query($koneksi, $sql);
    $databuku = mysqli_fetch_array($execute);
    ?>
    <form action="pages/buku/action.php?act=edit_buku&kode_buku=<?php echo $kode_buku ?>" method="POST">

        <!-- Grid Form -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- KATEGORI -->
            <div>
                <label>Kategori Buku</label>
                <select
                    id="kategori"
                    name="kategori_id"
                    class="w-full px-4 py-3 rounded-xl border border-slate-300 bg-white focus:ring-2 focus:ring-accent2 focus:border-accent2 outline-none transition"
                    required>

                    <option value="">Pilih</option>

                    <?php
                    $kategori_buku = $databuku['kategori_id']; // kategori dari buku yg diedit
                    $sql = "SELECT * FROM kategori";
                    $execute = mysqli_query($koneksi, $sql);

                    while ($categories = mysqli_fetch_array($execute)) {
                        $selected = ($categories['kategori_id'] == $kategori_buku) ? 'selected' : '';
                    ?>
                        <option value="<?= $categories['kategori_id']; ?>" <?= $selected; ?>>
                            <?= $categories['nama_kategori']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>


            <!-- Kode buku -->
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">
                    Kode Buku
                </label>
                <input
                    type="text"
                    name="kode_buku"
                    id="kode_buku"
                    class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-accent2 focus:border-accent2 outline-none transition"
                    value="<?= $databuku['kode_buku'] ?>"
                    readonly
                    required>
            </div>

            <!-- Judul Buku -->
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">
                    Judul Buku
                </label>
                <input
                    type="text"
                    name="judul"
                    class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-accent2 focus:border-accent2 outline-none transition"
                    value="<?= $databuku['judul'] ?>"
                    required>
            </div>

            <!-- Pengarang -->
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">
                    Pengarang
                </label>
                <input
                    type="text"
                    name="pengarang"
                    class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-accent2 focus:border-accent2 outline-none transition"
                    value="<?= $databuku['pengarang'] ?>"
                    required>
            </div>

            <!-- Penerbit -->
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">
                    Penerbit
                </label>
                <input
                    type="text"
                    name="penerbit"
                    class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-accent2 focus:border-accent2 outline-none transition"
                    value="<?= $databuku['penerbit'] ?>"
                    required>
            </div>

            <!-- Tahun Terbit -->
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">
                    Tahun Terbit
                </label>
                <select
                    name="tahun_terbit"
                    class="w-full px-4 py-3 rounded-xl border border-slate-300 bg-white focus:ring-2 focus:ring-accent2 focus:border-accent2 outline-none transition"
                    required>

                    <option value="">-- Pilih Tahun --</option>

                    <?php
                    $tahun_mulai = 2000;
                    $tahun_sekarang = date('Y');
                    $tahun_terbit_db = $databuku['tahun_terbit'];

                    for ($tahun = $tahun_mulai; $tahun <= $tahun_sekarang; $tahun++) {
                        $selected = ($tahun == $tahun_terbit_db) ? 'selected' : '';
                        echo "<option value='$tahun' $selected>$tahun</option>";
                    }
                    ?>
                </select>
            </div>



            <!-- stok_tersedia -->
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">
                    stok_tersedia
                </label>
                <input
                    type="text"
                    name="stok_tersedia"
                    class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-accent2 focus:border-accent2 outline-none transition"
                    value="<?= $databuku['stok_tersedia'] ?>"
                    required>
            </div>


            <!-- Action (Full Width) -->
            <div class="md:col-span-2 flex gap-3 pt-4">
                <button
                    type="submit"
                    class="px-4 py-2 rounded-lg bg-primary text-white text-sm font-semibold hover:bg-accent2 transition shadow">
                    Simpan
                </button>

                <a
                    href="dashboard.php?page=buku"
                    class="px-4 py-2 rounded-lg bg-slate-200 text-slate-700 text-sm font-medium hover:bg-slate-300 transition">
                    Kembali
                </a>
            </div>


        </div>

    </form>
    <script>
        const kategoriSelect = document.getElementById('kategori');
        const kodeBukuInput = document.getElementById('kode_buku');

        // simpan kode awal (dari database)
        const kodeAwal = kodeBukuInput.value;

        kategoriSelect.addEventListener('change', function() {
            const kategoriId = this.value;

            // kalau kategori dikosongkan → kembalikan kode awal
            if (kategoriId === '') {
                kodeBukuInput.value = kodeAwal;
                return;
            }

            fetch('pages/buku/get_kode_buku.php?kategori_id=' + kategoriId)
                .then(response => response.text())
                .then(data => {
                    if (data.trim() !== '') {
                        kodeBukuInput.value = data;
                    }
                })
                .catch(() => {
                    // fallback kalau fetch error
                    kodeBukuInput.value = kodeAwal;
                });
        });
    </script>

</div>