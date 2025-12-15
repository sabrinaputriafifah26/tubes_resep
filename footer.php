<?php
// footer file - required php tag for PHPUnit
?>

<div id="footer-wrapper">
    <!-- FOOTER -->
    <footer style="
        margin-top:40px;
        background:#f8f8f8;
        padding:20px;
        text-align:center;
        font-size:14px;
        color:#555;
        border-top:1px solid #ddd;
    ">
        <p>
            <strong>Project Resep</strong> © <?php echo date('Y'); ?><br>
            Dibuat untuk Tugas Besar Pemrograman Web<br>
            Data Resep menggunakan <em>Spoonacular API</em>
        </p>
    </footer>
</div>

<!-- BACK TO TOP BUTTON -->
<button id="toTop" style="
    position:fixed;
    bottom:25px;
    right:25px;
    padding:10px 14px;
    border:none;
    border-radius:50%;
    background:#e60023;
    color:white;
    font-size:16px;
    cursor:pointer;
    display:none;
">
↑
</button>

<script>
const btn = document.getElementById("toTop");
window.onscroll = function() {
    btn.style.display =
        (document.documentElement.scrollTop > 200)
        ? "block"
        : "none";
};

btn.onclick = function() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
};
</script>

</body>
</html>
