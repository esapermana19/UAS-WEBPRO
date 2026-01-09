<div class="mb-4">
    <h1 class="text-2xl font-bold text-primary mb-6">
        Edit Anggota
    </h1>
    <?php
    $kode_anggota = $_GET['kode_anggota'];
    $sql = "SELECT * FROM anggota WHERE kode_anggota = '$kode_anggota'";
    $execute = mysqli_query($koneksi, $sql);
    $dataanggota = mysqli_fetch_array($execute);
    ?>
    <form action="pages/anggota/action.php?act=edit_anggota&kode_anggota=<?php echo $kode_anggota ?>" method="POST">

        <!-- Grid Form -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Kode Anggota -->
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">
                    Kode Anggota
                </label>
                <input
                    type="text"
                    name="kode_anggota"
                    class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-accent2 focus:border-accent2 outline-none transition"
                    value="<?= $dataanggota['kode_anggota'] ?>"
                    required>
            </div>

            <!-- Nama Anggota -->
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">
                    Nama Anggota
                </label>
                <input
                    type="text"
                    name="nama_anggota"
                    class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-accent2 focus:border-accent2 outline-none transition"
                    value="<?= $dataanggota['nama_anggota'] ?>"
                    required>
            </div>

            <!-- Jenis Kelamin -->
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">
                    Jenis Kelamin
                </label>
                <select
                    name="jk"
                    class="w-full px-4 py-3 rounded-xl border border-slate-300 bg-white focus:ring-2 focus:ring-accent2 focus:border-accent2 outline-none transition"
                    required>
                    <option value="L" <?= $dataanggota['jk'] == 'L' ? 'selected' : '' ?>>
                        L
                    </option>
                    <option value="P" <?= $dataanggota['jk'] == 'P' ? 'selected' : '' ?>>
                        P
                    </option>
                </select>
            </div>


            <!-- No HP -->
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">
                    No HP
                </label>
                <input
                    type="text"
                    name="no_hp"
                    class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-accent2 focus:border-accent2 outline-none transition"
                    value="<?= $dataanggota['no_hp'] ?>"
                    required>
            </div>

            <!-- Alamat (Full Width) -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-slate-700 mb-1">
                    Alamat
                </label>
                <textarea
                    name="alamat"
                    rows="3"
                    class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-accent2 focus:border-accent2 outline-none transition"
                    required><?= htmlspecialchars($dataanggota['alamat']); ?></textarea>
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
</div>