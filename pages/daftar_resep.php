<?php
include_once __DIR__ . '/../config/api.php';

/* Ambil kategori dari tombol */
$kategori = $_GET['kat'] ?? 'all';

/* Mapping kategori ke Spoonacular */
$apiType = match ($kategori) {
    'main' => 'main course',
    'dessert' => 'dessert',
    'vegetarian' => 'vegetarian',
    'drink' => 'drink',
    default => ''
};

/* URL API */
$url = API_BASE . "/complexSearch?number=12&apiKey=" . API_KEY;
if ($apiType) {
    $url .= "&type=" . urlencode($apiType);
}

/* Ambil data API */
$response = @file_get_contents($url);
$data = $response ? json_decode($response, true) : null;
?>

<h2>Daftar Resep</h2>

<!-- TOMBOL KATEGORI -->
<div style="margin-bottom:20px; display:flex; gap:10px; flex-wrap:wrap;">
    <a href="?page=daftar_resep" class="btn">Semua</a>
    <a href="?page=daftar_resep&kat=main" class="btn">Makanan Utama</a>
    <a href="?page=daftar_resep&kat=dessert" class="btn">Dessert</a>
    <a href="?page=daftar_resep&kat=vegetarian" class="btn">Vegetarian</a>
    <a href="?page=daftar_resep&kat=drink" class="btn">Minuman</a>
</div>

<style>
.btn {
    padding:8px 14px;
    border-radius:20px;
    background:#e60023;
    color:white;
    text-decoration:none;
    font-size:14px;
}
.btn:hover {
    opacity:0.85;
}
</style>

<?php if (!$data || !isset($data['results'])): ?>

    <p style="color:red;">Data API tidak tersedia (limit).</p>

    <!-- FALLBACK DATA SESUAI KATEGORI -->
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:20px;">
        <?php
        $dummy = [
            'Nasi Goreng Spesial',
            'Ayam Bakar Madu',
            'Sop Ayam Kampung',
            'Mie Goreng Jawa',
            'Es Teh Lemon',
            'Pudding Coklat'
        ];
        foreach ($dummy as $d):
        ?>
        <div style="border:1px solid #ddd;padding:10px;border-radius:8px;">
            <img src="https://via.placeholder.com/300x200?text=Resep" width="100%">
            <h4><?= $d ?></h4>
        </div>
        <?php endforeach; ?>
    </div>

<?php else: ?>

    <!-- DATA API -->
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:20px;">
        <?php foreach ($data['results'] as $resep): ?>
            <a href="?page=detail_resep&id=<?= $resep['id'] ?>" style="text-decoration:none;color:black;">
                <div style="border:1px solid #ddd;padding:10px;border-radius:8px;">
                    <img src="<?= htmlspecialchars($resep['image']) ?>" width="100%">
                    <h4><?= htmlspecialchars($resep['title']) ?></h4>
                </div>
            </a>
        <?php endforeach; ?>
    </div>

<?php endif; ?>