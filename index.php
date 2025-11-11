<?php
$no_redirect = true;
include 'config/db.php';
session_start();

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM karyawan WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    
    // Simpan semua data penting ke session
    $_SESSION['id_karyawan'] = $row['id_karyawan'];
    $_SESSION['username'] = $row['username'];
    $_SESSION['nama'] = $row['nama'];
    $_SESSION['role'] = $row['role']; // ⬅️ tambahkan ini

    header('Location: dashboard.php');
    exit;
}
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Toko Komputer</title>
    <link href="./output.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/output.css">
</head>
<body>
    <div class="flex min-h-full flex-col justify-center px-12 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <h2 class="mt-15 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Login Karyawan</h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
    <form action="" method="POST" class="space-y-6">
    <div>
        <label for="username" class="block text-sm/6 font-medium text-gray-900">Username</label>
        <div class="mt-2">
        <input name="username" type="text" required autocomplete="username"
            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
        </div>
    </div>

    <div>
        <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
        <div class="mt-2">
        <input name="password" type="password" required autocomplete="current-password"
            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
        </div>
    </div>

    <div>
        <button name="login" type="submit"
        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
        Sign in
        </button>
    </div>
    </form>
    </div>
    </div>
<?php if (!empty($error)) echo "<p style='color:red'>$error</p>"; ?>
</body>
</html>

