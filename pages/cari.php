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

<?php if (!$query): ?>
    <p style="color:#666;">Silakan masukkan kata kunci untuk mencari resep 🍳</p>
<?php endif; ?>

<form method="GET">
    <input type="hidden" name="page" value="cari">
    <input type="text" name="q" placeholder="Cari resep..." value="<?= htmlspecialchars($query); ?>">
    <button type="submit">Cari</button>
</form>

<br>

<!-- HASIL RESEP -->
<div class="hasil">
<?php foreach ($results as $resep): ?>
    <a href="index.php?page=detail_resep&id=<?= $resep['id']; ?>" class="card-link">
        <div class="card">
            <img src="<?= $resep['image']; ?>">
            <strong><?= $resep['title']; ?></strong>
        </div>
    </a>
<?php endforeach; ?>
</div>

<?php if ($query && empty($results)): ?>
    <p style="color:red;">Resep tidak ditemukan. Coba kata kunci lain.</p>
<?php endif; ?>

<!-- CSS TAMBAHAN (TIDAK MENGUBAH LOGIC) -->
<style>
form {
    display: flex;
    gap: 10px;
    max-width: 600px;
    margin-bottom: 25px;
}

form input[type="text"] {
    flex: 1;
    padding: 10px 14px;
    border-radius: 8px;
    border: 1px solid #ccc;
}

form button {
    background: #e60023;
    color: white;
    border: none;
    padding: 10px 18px;
    border-radius: 8px;
    cursor: pointer;
}

form button:hover {
    opacity: 0.9;
}

.hasil {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(180px,1fr));
    gap: 20px;
}

.card {
    border: 1px solid #eee;
    border-radius: 12px;
    padding: 10px;
    text-align: center;
    transition: 0.2s;
    background: #fff;
}

.card:hover {
    transform: translateY(-4px);
    box-shadow: 0 6px 16px rgba(0,0,0,.1);
}
.card img {
    width: 100%;
    border-radius: 8px;
}.card-link {
    text-decoration: none;
    color: inherit;
}

.card-link:hover strong {
    color: #e60023;
}

</style>

<!-- JS TAMBAHAN (AMAN UNTUK TEST) -->
<script>
const keyword = "<?= htmlspecialchars($query) ?>";
if (keyword) {
    document.querySelectorAll(".card strong").forEach(el => {
        el.innerHTML = el.innerText.replace(
            new RegExp(keyword, "gi"),
            match => `<mark>${match}</mark>`
        );
    });
}

const form = document.querySelector("form");
if (form) {
    form.addEventListener("submit", () => {
        const btn = form.querySelector("button");
        btn.innerText = "Mencari...";
        btn.disabled = true;
    });
}
</script>
<!-- ===============================
SMART SEARCH EXPERIENCE (ADVANCED UX)
=============================== -->

<style>
.empty-state {
    text-align: center;
    padding: 40px 20px;
    color: #777;
    animation: fadeIn 0.4s ease;
}

.empty-state img {
    width: 140px;
    opacity: 0.85;
    margin-bottom: 15px;
}

.empty-state h3 {
    margin-bottom: 6px;
    font-weight: 600;
}

.empty-state p {
    font-size: 14px;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(6px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>

<div id="emptyState" class="empty-state" style="display:none;">
    <img src="https://cdn-icons-png.flaticon.com/512/1046/1046784.png" alt="search">
    <h3>Mulai cari resep favoritmu</h3>
    <p>Ketik bahan atau nama masakan untuk menemukan inspirasi masak 🍽️</p>
</div>

<script>
// Auto focus ke input saat halaman dibuka
const searchInput = document.querySelector('input[name="q"]');
if (searchInput) {
    searchInput.focus();
}

// Empty state pintar
const hasilContainer = document.querySelector(".hasil");
const emptyState = document.getElementById("emptyState");

window.addEventListener("load", () => {
    const hasQuery = searchInput && searchInput.value.trim() !== "";
    const hasResult = hasilContainer && hasilContainer.children.length > 0;

    if (!hasQuery && emptyState) {
        emptyState.style.display = "block";
    }

    if (hasQuery && !hasResult && emptyState) {
        emptyState.querySelector("h3").innerText = "Resep tidak ditemukan";
        emptyState.querySelector("p").innerText =
            "Coba gunakan kata kunci lain atau bahan yang berbeda.";
        emptyState.style.display = "block";
    }
});

// Highlight keyword lebih pintar
if (searchInput && searchInput.value) {
    const keyword = searchInput.value.replace(/[.*+?^${}()|[\]\\]/g, "\\$&");
    const regex = new RegExp(`(${keyword})`, "gi");

    document.querySelectorAll(".card strong").forEach(el => {
        el.innerHTML = el.textContent.replace(regex, "<mark>$1</mark>");
    });
}
</script>
