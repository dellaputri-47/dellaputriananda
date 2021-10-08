<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact No_Buku exists, for example update.php?No_Buku=1 will get the contact with the No_Buku of 1
if (isset($_GET['No_Buku'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $No_Buku = isset($_POST['No_Buku']) ? $_POST['No_Buku'] : NULL;
        $Nama_Buku = isset($_POST['Nama_Buku']) ? $_POST['Nama_Buku'] : '';
        $Nama_Pengarang = isset($_POST['Nama_Pengarang']) ? $_POST['Nama_Pengarang'] : '';
        $Jenis_Buku = isset($_POST['Jenis_Buku']) ? $_POST['Jenis_Buku'] : '';
        $Tahun_Terbit = isset($_POST['Tahun_Terbit']) ? $_POST['Tahun_Terbit'] : '';
        
        // Update the record
        $stmt = $pdo->prepare('UPDATE perpustakaan SET No_Buku = ?, Nama_Buku = ?, Nama_Pengarang = ?, Jenis_Buku = ?, Tahun_Terbit = ? WHERE No_Buku = ?');
        $stmt->execute([$No_Buku, $Nama_Buku, $Nama_Pengarang, $Jenis_Buku, $Tahun_Terbit, $_GET['No_Buku']]);
        $msg = 'Updated Successfully!';
    }
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT * FROM perpustakaan WHERE No_Buku = ?');
    $stmt->execute([$_GET['No_Buku']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('Contact doesn\'t exist with that No_Buku!');
    }
} else {
    exit('No No_Buku specified!');
}
?>



<?=template_header('Read')?>

<div class="content update">
	<h2>Update Contact #<?=$contact['No_Buku']?></h2>
    <form action="update.php?No_Buku=<?=$contact['No_Buku']?>" method="post">
        <label for="No_Buku">No_Buku</label>
        <label for="Nama_Buku">Nama_Buku</label>
        <input type="text" name="No_Buku" value="<?=$contact['No_Buku']?>" No_Buku="No_Buku">
        <input type="text" name="Nama_Buku" value="<?=$contact['Nama_Buku']?>" No_Buku="Nama_Buku">
        <label for="Nama_Pengarang">Nama_Pengarang</label>
        <label for="Jenis_Buku">Jenis_Buku</label>
        <input type="text" name="Nama_Pengarang" value="<?=$contact['Nama_Pengarang']?>" No_Buku="Nama_Pengarang">
        <input type="text" name="Jenis_Buku" value="<?=$contact['Jenis_Buku']?>" No_Buku="Jenis_Buku">
        <label for="Tahun_Terbit">Tahun_Terbit</label>
         <label></label>
        <input type="text" name="Tahun_Terbit" value="<?=$contact['Tahun_Terbit']?>" No_Buku="Tahun_Terbit">
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>