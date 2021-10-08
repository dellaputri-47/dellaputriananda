<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $No_Buku = isset($_POST['No_Buku']) && !empty($_POST['No_Buku']) && $_POST['No_Buku'] != '' ? $_POST['No_Buku'] : NULL;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $Nama_Buku = isset($_POST['Nama_Buku']) ? $_POST['Nama_Buku'] : '';
    $Nama_Pengarang = isset($_POST['Nama_Pengarang']) ? $_POST['Nama_Pengarang'] : '';
    $Jenis_Buku = isset($_POST['Jenis_Buku']) ? $_POST['Jenis_Buku'] : '';
    $Tahun_Terbit = isset($_POST['Tahun_Terbit']) ? $_POST['Tahun_Terbit'] : '';

    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO perpustakaan VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([$No_Buku, $Nama_Buku, $Nama_Pengarang, $Jenis_Buku, $Tahun_Terbit]);
    // Output message
    $msg = 'Created Successfully!';
}
?>


<?=template_header('Create')?>

<div class="content update">
	<h2>Create Data Books</h2>
    <form action="create.php" method="post">
        <label for="No_Buku">No_Buku</label>
        <label for="Nama_Buku">Nama_Buku</label>
        <input type="text" name="No_Buku" No_Buku="No_Buku">
        <input type="text" name="Nama_Buku" No_Buku="Nama_Buku">

        <label for="Nama_Pengarang">Nama_Pengarang</label>
        <label for="Jenis_Buku">Jenis_Buku</label>
        <input type="text" name="Nama_Pengarang" No_Buku="Nama_Pengarang">
        <input type="text" name="Jenis_Buku" No_Buku="Jenis_Buku">

        <label for="Tahun_Terbit">Tahun_Terbit</label>
        <label></label>
        <input type="text" name="Tahun_Terbit" No_Buku="Tahun_Terbit">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>