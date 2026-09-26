<?php
$page_title = "SIMPUS-Mini | Debug Session";
include 'includes/header.php';
?>

<section>
    <h2>Debug Data Session</h2>
    <p>Halaman ini menampilkan seluruh data yang tersimpan di dalam array <code>$_SESSION</code> secara langsung.</p>
    <pre style="background-color: #2c1810; color: #f8f5f2; padding: 1rem; border-radius: 6px; overflow-x: auto;"><?php print_r($_SESSION); ?></pre>
</section>

<?php include 'includes/footer.php'; ?>