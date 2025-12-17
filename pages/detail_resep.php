<?php
include_once __DIR__ . '/../config/api.php';

$id = $_GET['id'] ?? null;
$data = null;

/* Jika ada ID, ambil detail resep */
if ($id) {
    $url = API_BASE . "/$id/information?apiKey=" . API_KEY;
    $response = @file_get_contents($url);

    if ($response !== false) {
        $data = json_decode($response, true);
    }
}
?>

<?php if (!$data): ?>

    <h2>Detail Resep</h2>
    <p style="color:red;">Detail resep tidak dapat dimuat (API limit).</p>

    <!-- FALLBACK DETAIL -->
    <img src="https://via.placeholder.com/600x400?text=Resep" width="100%" style="max-width:600px">
    <h3>Nasi Goreng Spesial</h3>

    <h4>Bahan-bahan:</h4>
    <ul>
        <li>Nasi putih</li>
        <li>Telur</li>
        <li>Bawang merah</li>
        <li>Kecap manis</li>
    </ul>

    <h4>Langkah Memasak:</h4>
    <ol>
        <li>Tumis bawang hingga harum</li>
        <li>Masukkan telur dan nasi</li>
        <li>Tambahkan kecap dan bumbu</li>
        <li>Aduk hingga matang</li>
    </ol>

<?php else: ?>

    <h2><?= htmlspecialchars($data['title']) ?></h2>

    <img src="<?= htmlspecialchars($data['image']) ?>" 
         style="max-width:600px;width:100%;border-radius:10px;">

    <p><?= strip_tags($data['summary']) ?></p>

    <h4>Bahan-bahan:</h4>
    <ul>
        <?php foreach ($data['extendedIngredients'] as $bahan): ?>
            <li><?= htmlspecialchars($bahan['original']) ?></li>
        <?php endforeach; ?>
    </ul>

    <h4>Langkah Memasak:</h4>
    <ol>
        <?php
        if (!empty($data['analyzedInstructions'][0]['steps'])):
            foreach ($data['analyzedInstructions'][0]['steps'] as $step):
        ?>
            <li><?= htmlspecialchars($step['step']) ?></li>
        <?php
            endforeach;
        else:
        ?>
            <li>Langkah memasak tidak tersedia.</li>
        <?php endif; ?>
    </ol>

<?php endif; ?>

<br>
<a href="?page=daftar_resep">← Kembali ke Daftar Resep</a>
