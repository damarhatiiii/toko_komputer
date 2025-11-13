<?php
session_start();
// contoh validasi login
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-900 text-white">
        <!-- Navbar -->
        <?php include 'includes\navbar.php'; ?>

        <!-- ===== Main Content ===== -->
            <!-- Header -->
        <main class="flex flex-col items-center justify-center text-center min-h-[calc(100vh-80px)] px-6">
            <h1 class="mb-6 text-4xl font-extrabold text-white">
                Halo, <?php echo $_SESSION['username']; ?> 👋
            </h1>
<!-- 
            <p class="mb-6 text-lg font-normal text-gray-500 max-w-2xl">
                Here at Flowbite we focus on markets where technology, innovation, and capital 
                can unlock long-term value and drive economic growth.
            </p> -->
            <!-- Content -->
            
                <!-- Card 1 -->


                <!-- Card 2 -->
                

                <!-- Card 3 -->
                
            </section>
        </main>
            <!-- Footer -->
            <?php include 'includes\footbar.php'; ?>
</body>
</html>
