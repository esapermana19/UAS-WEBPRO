<div class="mb-4">
    <h1 class="text-2xl font-bold text-primary mb-6">
        Tambah Buku
    </h1>
    <form action="pages/buku/action.php?act=insert" method="POST">

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
                    $sql = "SELECT * FROM kategori";
                    $execute = mysqli_query($koneksi, $sql);
                    while ($categories = mysqli_fetch_array($execute)) {
                    ?>
                        <option value="<?= $categories['kategori_id']; ?>">
                            <?= $categories['nama_kategori']; ?>
                        </option>
                    <?php } ?>
                </select>

            </div>

            <!-- Kode Buku -->
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">
                    Kode Buku
                </label>
                <input
                    type="text"
                    name="kode_buku"
                    id="kode_buku"
                    readonly
                    class="w-full px-4 py-3 rounded-xl border border-slate-300 bg-slate-100 focus:ring-2 focus:ring-accent2 focus:border-accent2 outline-none transition"
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
                    placeholder="Masukkan judul buku"
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
                    placeholder="Masukkan nama pengarang"
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
                    placeholder="Masukkan nama penerbit"
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

                    for ($tahun = $tahun_mulai; $tahun <= $tahun_sekarang; $tahun++) {
                        echo "<option value='$tahun'>$tahun</option>";
                    }
                    ?>

                </select>
            </div>

            <!-- Stok -->
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">
                    Stok
                </label>
                <input
                    type="number"
                    name="stok"
                    class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-accent2 focus:border-accent2 outline-none transition"
                    placeholder="Masukkan stok"
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
                    href="dashboard.php?page=anggota"
                    class="px-4 py-2 rounded-lg bg-slate-200 text-slate-700 text-sm font-medium hover:bg-slate-300 transition">
                    Kembali
                </a>
            </div>


        </div>

    </form>
    <script>
        document.getElementById('kategori').addEventListener('change', function() {
            const kategoriId = this.value;

            if (kategoriId === '') {
                document.getElementById('kode_buku').value = '';
                return;
            }

            fetch('pages/buku/get_kode_buku.php?kategori_id=' + kategoriId)
                .then(response => response.text())
                .then(data => {
                    document.getElementById('kode_buku').value = data;
                });
        });
    </script>

</div>