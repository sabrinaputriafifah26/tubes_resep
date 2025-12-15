<?php
include_once 'config/api.php';

$query = $_GET['q'] ?? '';
$results = [];

if ($query) {
    $url = API_BASE . "/complexSearch?query=$query&apiKey=" . API_KEY;
    $response = file_get_contents($url);
    $results = json_decode($response, true)['results'];
}
?>

<h2>Pencarian Resep</h2>

<form method="GET">
    <input type="hidden" name="page" value="cari">
    <input type="text" name="q" placeholder="Cari resep..." value="<?= htmlspecialchars($query); ?>">
    <button type="submit">Cari</button>
</form>

<br>

<?php foreach ($results as $resep): ?>
    <div>
        <img src="<?= $resep['image']; ?>" width="120">
        <strong><?= $resep['title']; ?></strong>
    </div>
<?php endforeach; ?>
