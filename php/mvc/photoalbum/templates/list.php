<h2>Fotografie:</h2>
<?php if(sizeof($this->pictures)): ?>
  <ul>
  <?php foreach($this->pictures as $picture): ?>
  <li><?php echo $picture ?></li>
  <?php endforeach ?>
  </ul>
<?php else: ?>
  <p>Non ci sono fotografie, purtroppo.</p>
<?php endif ?>

<hr />

<h2>Categorie:</h2>
<ul>
<?php foreach($this->categories as $category): ?>
<li>
<?php echo link_to(
	$category->getName(),
	'?action=filterbycategory&amp;id='.$category->getId(),
	array('title'=>'Seleziona le foto della categoria ' . $category->getName())
	) ?>
</li>
<?php endforeach ?>
</ul>
