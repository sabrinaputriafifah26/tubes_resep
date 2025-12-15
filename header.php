<?php
// header file - required php tag for PHPUnit
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Project Resep</title>

<style>
body {
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
}

/* NAVBAR */
.navbar {
    background: linear-gradient(90deg, #e60023, #ff4d4d);
    padding: 14px 40px;
    display: flex;
    align-items: center;
    gap: 25px;
}

/* LOGO */
.logo {
    font-size: 22px;
    font-weight: bold;
    color: #fff;
    white-space: nowrap;
}

/* SEARCH */
.search-box {
    flex: 1;
    position: relative;
    margin-right: 30px;
}

.search-box input {
    width: 100%;
    padding: 10px 15px;
    border-radius: 25px;
    border: none;
    outline: none;
}

/* MENU */
.menu {
    display: flex;
    gap: 20px;
}

.menu a {
    color: #fff;
    text-decoration: none;
    font-weight: 600;
    font-size: 15px;
}

.menu a:hover {
    text-decoration: underline;
}
</style>

</head>
<body>

<nav class="navbar">
    <div class="logo">Project Resep</div>

    <form class="search-box" method="GET" action="index.php">
        <input type="hidden" name="page" value="cari">
        <input type="text" name="q" placeholder="Cari resep favoritmu di sini">
    </form>

    <div class="menu">
        <a href="index.php?page=daftar_resep">Daftar Resep</a>
        <a href="index.php?page=kategori">Kategori</a>
        <a href="index.php?page=buat_resep">Buat Resep</a>
    </div>
</nav>
