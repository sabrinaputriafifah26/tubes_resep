<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Project Resep</title>

    <!-- CSS GLOBAL -->
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<?php include 'header.php'; ?>

<main>
<?php
    $page = $_GET['page'] ?? 'home';

    switch ($page) {
        case 'daftar_resep':
            include 'pages/daftar_resep.php';
            break;

        case 'kategori':
            include 'pages/kategori.php';
            break;

        case 'cari':
            include 'pages/cari.php';
            break;

        case 'buat_resep':
            include 'pages/buat_resep.php';
            break;

        case 'detail_resep':
            include 'pages/detail_resep.php';
            break;

        default:
            include 'pages/home.php';
    }
?>
</main>

<?php include 'footer.php'; ?>

</body>
</html>