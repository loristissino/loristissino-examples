<?php include('_content.php') ?>
<hr />
<div>
<form action="?action=delete&id=<?php echo $post['id'] ?>" method="post">
<p>Confermi la cancellazione dell'articolo con id <?php echo  $post['id'] ?>?</p>
<input type="submit" value="Conferma" />
</form>
</div>
<?php include('_linktohome.php') ?>
