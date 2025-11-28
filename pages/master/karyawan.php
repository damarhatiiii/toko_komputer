<?php
session_start();
include '../../config/db.php';

// Pastikan user login dulu
if (!isset($_SESSION['username'])) {
    header('Location: ' . BASE_PATH . '/auth/login.php');
    exit;
}

// Ambil data karyawan dari database
$result = mysqli_query($conn, "SELECT * FROM karyawan");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Karyawan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</head>

<body class="bg-white min-h-screen flex flex-col">

    <!-- Navbar -->
    <?php include '../../includes/navbar.php'; ?>
    
    <div class="p-6 min-h-[calc(100vh-80px)] flex-grow">
        <div class="max-w-5xl mx-auto bg-white rounded-xl shadow-sm border border-gray-200 p-6">

            <div class="flex items-center justify-between border-b pb-3 mb-6">
                <h2 class="text-2xl font-bold text-gray-900">Data Karyawan</h2>

                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                <a href="tambah_karyawan.php" 
                    class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-lg text-sm">
                    + Tambah Karyawan
                </a>
                <?php endif; ?>
            </div>

            <?php if (isset($_GET['error']) && $_GET['error'] == 'akses_ditolak'): ?>
                <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                    Akses ditolak! Hanya admin yang dapat menambahkan atau menghapus karyawan.
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['msg']) && $_GET['msg'] == 'sukses'): ?>
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                    Karyawan berhasil ditambahkan! 
                    <?php if (isset($_GET['id'])): ?>
                        ID: <strong><?= htmlspecialchars($_GET['id']); ?></strong>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <div class="relative overflow-x-auto rounded-lg border border-gray-200">
                <table class="w-full text-sm text-left text-gray-700">
                    <thead class="text-xs uppercase bg-gray-100 text-gray-700">
                        <tr>
                            <th scope="col" class="px-6 py-3">No</th>
                            <th scope="col" class="px-6 py-3">Nama</th>
                            <th scope="col" class="px-6 py-3">Username</th>
                            <th scope="col" class="px-6 py-3">Role</th>
                            <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php 
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($result)): 
                        ?>
                        <tr class="bg-white border-b hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-medium text-gray-900"><?= $no++; ?></td>
                            <td class="px-6 py-4"><?= htmlspecialchars($row['nama']); ?></td>
                            <td class="px-6 py-4"><?= htmlspecialchars($row['username']); ?></td>
                            <td class="px-6 py-4 capitalize"><?= htmlspecialchars($row['role']); ?></td>
                            <td class="px-6 py-4 text-center">
                                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                                <a href="hapus_karyawan.php?id=<?= $row['id_karyawan']; ?>" 
                                    class="text-red-600 hover:underline"
                                    onclick="return confirm('Yakin ingin menghapus karyawan ini?')">Hapus</a>
                                <?php else: ?>
                                <span class="text-gray-400 text-sm">-</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <!-- Footer -->
    <?php include '../../includes/footbar.php'; ?>

</body>

</html>
