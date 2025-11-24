<?php
// Define BASE_PATH once so relative links remain correct regardless of nesting level
if (!defined('BASE_PATH')) {
    $document_root = str_replace('\\', '/', realpath($_SERVER['DOCUMENT_ROOT']));
    $project_root = str_replace('\\', '/', realpath(dirname(__DIR__)));
    $relative_path = trim(str_replace($document_root, '', $project_root), '/');
    $base_path = $relative_path === '' ? '' : '/' . $relative_path;
    define('BASE_PATH', $base_path);
}

$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'toko_komputer';

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
