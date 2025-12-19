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

<h2>Buat Resep</h2>

<form method="POST" enctype="multipart/form-data">
    <input type="text" name="judul" placeholder="Judul Resep" required><br><br>

    <textarea name="langkah" placeholder="Langkah memasak" rows="5" required></textarea><br><br>

    <input type="file" name="gambar" accept="image/*"><br><br>

    <button type="submit">Simpan Resep</button>
</form>

<hr>

<h3>Resep Buatan Anda</h3>

<?php if (empty($_SESSION['resep_buatan'])): ?>
    <p>Belum ada resep buatan.</p>
<?php else: ?>
    <?php foreach ($_SESSION['resep_buatan'] as $r): ?>
        <div style="border:1px solid #ccc;padding:10px;margin-bottom:15px;">
            <h4><?= htmlspecialchars($r['judul']) ?></h4>

            <?php if ($r['gambar']): ?>
                <img src="<?= $r['gambar'] ?>" width="200"><br>
            <?php endif; ?>

            <p><?= nl2br(htmlspecialchars($r['langkah'])) ?></p>
        </div>
    <?php endforeach; ?>
<?php endif; ?>