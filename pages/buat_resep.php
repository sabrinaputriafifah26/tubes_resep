<?php
session_start();

/* Inisialisasi array resep */
if (!isset($_SESSION['resep_buatan'])) {
    $_SESSION['resep_buatan'] = [];
}

/* Jika form disubmit */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $judul  = $_POST['judul'] ?? '';
    $langkah = $_POST['langkah'] ?? '';

    /* Upload gambar */
    $gambar = null;
    if (!empty($_FILES['gambar']['name'])) {

        $folder = 'uploads/';
        if (!is_dir($folder)) {
            mkdir($folder);
        }

        $namaFile = time() . '_' . $_FILES['gambar']['name'];
        $path = $folder . $namaFile;

        move_uploaded_file($_FILES['gambar']['tmp_name'], $path);
        $gambar = $path;
    }

    /* Simpan ke session */
    $_SESSION['resep_buatan'][] = [
        'judul' => $judul,
        'langkah' => $langkah,
        'gambar' => $gambar
    ];

    echo "<p style='color:green;'>Resep berhasil disimpan!</p>";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Resep Masakan</title>
<style>
body {
    font-family: Arial, sans-serif;
    background: #f4f6f8;
    padding: 20px;
}

.container {
    max-width: 900px;
    margin: auto;
}

h2, h3 {
    text-align: center;
    color: #333;
}

.alert {
    background: #d4edda;
    color: #155724;
    padding: 10px;
    margin-bottom: 20px;
    border-radius: 5px;
}

.form-box {
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    margin-bottom: 30px;
}

input[type=text], textarea {
    width: 100%;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
}

button {
    background: #28a745;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
}

button:hover {
    background: #218838;
}

.resep-list {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
}

.card {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    overflow: hidden;
}

.card img {
    width: 100%;
    height: 180px;
    object-fit: cover;
}

.card-body {
    padding: 15px;
}

.card-body h4 {
    margin: 0 0 10px;
    color: #333;
}

.card-body p {
    font-size: 14px;
    color: #555;
}
</style>
</head>

<body>
<div class="container">

    <h2>Buat Resep</h2>

    <?php if (!empty($pesan)): ?>
        <div class="alert"><?= $pesan ?></div>
    <?php endif; ?>

    <div class="form-box">
        <form method="POST" enctype="multipart/form-data">
            <input type="text" name="judul" placeholder="Judul Resep" required><br><br>

            <textarea name="langkah" placeholder="Langkah memasak" rows="5" required></textarea><br><br>

            <input type="file" name="gambar" accept="image/*"><br><br>

            <button type="submit">Simpan Resep</button>
        </form>
    </div>

    <h3>Resep Buatan Anda</h3>

    <?php if (empty($_SESSION['resep_buatan'])): ?>
        <p style="text-align:center;">Belum ada resep buatan.</p>
    <?php else: ?>
        <div class="resep-list">
            <?php foreach ($_SESSION['resep_buatan'] as $r): ?>
                <div class="card">
                    <?php if ($r['gambar']): ?>
                        <img src="<?= $r['gambar'] ?>">
                    <?php endif; ?>

                    <div class="card-body">
                        <h4><?= htmlspecialchars($r['judul']) ?></h4>
                        <p><?= nl2br(htmlspecialchars($r['langkah'])) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

</div>
</body>
</html>