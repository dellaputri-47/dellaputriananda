<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check that the contact No_Buku exists
if (isset($_GET['No_Buku'])) {
    // Select the record that is going to be deleted
    $stmt = $pdo->prepare('SELECT * FROM perpustakaan WHERE No_Buku = ?');
    $stmt->execute([$_GET['No_Buku']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('Contact doesn\'t exist with that No_Buku!');
    }
    // Make sure the user confirms beore deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // User clicked the "Yes" button, delete record
            $stmt = $pdo->prepare('DELETE FROM perpustakaan WHERE No_Buku = ?');
            $stmt->execute([$_GET['No_Buku']]);
            $msg = 'You have deleted the contact!';
        } else {
            // User clicked the "No" button, redirect them back to the read page
            header('Location: read.php');
            exit;
        }
    }
} else {
    exit('No No_Buku specified!');
}
?>


<?=template_header('Delete')?>

<div class="content delete">
	<h2>Delete Contact #<?=$contact['No_Buku']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
	<p>Are you sure you want to delete contact #<?=$contact['No_Buku']?>?</p>
    <div class="yesno">
        <a href="delete.php?No_Buku=<?=$contact['No_Buku']?>&confirm=yes">Yes</a>
        <a href="delete.php?No_Buku=<?=$contact['No_Buku']?>&confirm=no">No</a>
    </div>
    <?php endif; ?>
</div>

<?=template_footer()?>