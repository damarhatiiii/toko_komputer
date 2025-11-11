<?php
session_start();
include 'config/db.php';

// Pastikan user sudah login
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

// Cek role
if (!isset($_SESSION['role']) || ($_SESSION['role'] != 'admin' && $_SESSION['role'] != 'staf')) {
    die('Akses ditolak!');
}

// Proses simpan barang baru
if (isset($_POST['simpan'])) {
    $kode = mysqli_real_escape_string($conn, $_POST['kode']);
    $nama_part = mysqli_real_escape_string($conn, $_POST['nama_part']);
    $kategori = mysqli_real_escape_string($conn, $_POST['kategori']);
    $merek = mysqli_real_escape_string($conn, $_POST['merek']);
    $spesifikasi = mysqli_real_escape_string($conn, $_POST['spesifikasi']);
    $harga = (int) $_POST['harga'];
    $stok = (int) $_POST['stok'];

    // 🔍 Cek apakah kode sudah ada
    $cek = mysqli_query($conn, "SELECT * FROM part_komputer WHERE kode='$kode'");

    if (mysqli_num_rows($cek) > 0) {
        $row = mysqli_fetch_assoc($cek);
        $kategori_lama = $row['kategori'];

        // ⚠️ Jika kategori berbeda
        if ($kategori != $kategori_lama) {
            echo "<script>
                    alert('Kode barang $kode sudah terdaftar, tetapi dengan kategori berbeda ($kategori_lama)!');
                    window.history.back();
                    </script>";
        } else {
            // ❌ Jika kode & kategori sama
            echo "<script>
                    alert('Kode barang $kode sudah terdaftar dalam kategori yang sama!');
                    window.history.back();
                    </script>";
        }

    } else {
        // ✅ Jika kode belum ada, simpan data
        $insert = mysqli_query($conn, "INSERT INTO part_komputer 
            (kode, nama_part, kategori, merek, spesifikasi, harga, stok) 
            VALUES 
            ('$kode', '$nama_part', '$kategori', '$merek', '$spesifikasi', $harga, $stok)");

        if ($insert) {
            echo "<script>
                    alert('Barang baru berhasil ditambahkan!');
                    window.location='barang.php';
                    </script>";
        } else {
            echo "<script>
                    alert('Terjadi kesalahan saat menyimpan data!');
                    window.history.back();
                    </script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
</head>
<body>
    <!-- Navbar -->
    <?php include 'includes\navbar.php'; ?>

    <div class="p-6 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 rounded-xl shadow-md p-6">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6 border-b pb-3">Tambah Barang Baru</h2>

            <form method="POST" class="space-y-5">
                <div>
                    <label for="kode" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-200">Kode Barang</label>
                    <input type="text" name="kode" id="kode" required
                        class="w-full p-2.5 rounded-lg border border-gray-300 bg-gray-50 text-gray-900 dark:bg-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500" />
                </div>

                <div>
                    <label for="nama_part" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-200">Nama Part</label>
                    <input type="text" name="nama_part" id="nama_part" required
                        class="w-full p-2.5 rounded-lg border border-gray-300 bg-gray-50 text-gray-900 dark:bg-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500" />
                </div>

                <div>
                    <label for="kategori" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-200">Kategori</label>
                    <input type="text" name="kategori" id="kategori" placeholder="Contoh: CPU, GPU, RAM" required
                        class="w-full p-2.5 rounded-lg border border-gray-300 bg-gray-50 text-gray-900 dark:bg-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500" />
                </div>

                <div>
                    <label for="merek" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-200">Merek</label>
                    <input type="text" name="merek" id="merek" required
                        class="w-full p-2.5 rounded-lg border border-gray-300 bg-gray-50 text-gray-900 dark:bg-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500" />
                </div>

                <div>
                    <label for="spesifikasi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-200">Spesifikasi</label>
                    <textarea name="spesifikasi" id="spesifikasi" rows="3"
                        class="w-full p-2.5 rounded-lg border border-gray-300 bg-gray-50 text-gray-900 dark:bg-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="harga" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-200">Harga (Rp)</label>
                        <input type="number" name="harga" id="harga" required
                            class="w-full p-2.5 rounded-lg border border-gray-300 bg-gray-50 text-gray-900 dark:bg-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500" />
                    </div>

                    <div>
                        <label for="stok" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-200">Stok Awal</label>
                        <input type="number" name="stok" id="stok" required
                            class="w-full p-2.5 rounded-lg border border-gray-300 bg-gray-50 text-gray-900 dark:bg-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500" />
                    </div>
                </div>

                <button type="submit" name="simpan"
                    class="mt-4 w-full text-white bg-blue-700 hover:bg-blue-800 font-semibold rounded-lg text-sm px-5 py-2.5 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800">
                    Simpan Barang
                </button>
            </form>
        </div>
    </div>
            <!-- Footer -->
        <?php include 'includes/footbar.php'; ?>
</body>
</html>


