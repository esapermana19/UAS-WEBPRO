<div class="mb-4">
    <h1 class="text-2xl font-bold text-primary mb-6">
        Tambah Kategori
    </h1>
    <form action="pages/kategori/action.php?act=insert" method="POST">

        <!-- Grid Form -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- ID Kategori -->
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">
                    ID Kategori
                </label>
                <input
                    type="text"
                    name="kategori_id"
                    class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-accent2 focus:border-accent2 outline-none transition"
                    placeholder="Masukkan ID Kategori"
                    required>
            </div>

            <!-- Nama Kategori -->
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">
                    Nama Kategori
                </label>
                <input
                    type="text"
                    name="nama_kategori"
                    class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-accent2 focus:border-accent2 outline-none transition"
                    placeholder="Masukkan nama kategori"
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
</div>