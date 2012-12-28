<?php if(sizeof($this->pictures)): ?>
  <p>Ecco le miniature:</p>
  <?php foreach($this->pictures as $picture): ?>
  <p><a href="?action=show&amp;file=<?php echo $picture ?>"><img src="?action=serve&amp;file=<?php echo $picture ?>" width="<?php echo $picture->getReducedWidth() ?>" height="<?php echo $picture->getReducedHeight() ?>" /></a><br /><span class="picture_caption"><?php echo $picture ?></span></p>
  <?php endforeach ?>
<?php else: ?>
  <p>Non ci sono miniature da mostrare.</p>
<?php endif ?>
