<?php
/* @var $this ExperimentsController */

$this->breadcrumbs=array(
	'Experiments',
);
?>
<h1>Some experiments with the model</h1>

<h2>Pictures</h2>
<?php foreach($pictures as $picture): ?>
<p><span  style="color: red"><?php echo $picture?></span><br />
Category: <?php echo $picture->category ?><br />
Number of tags: <?php echo sizeof($picture->tags) ?><br />
  <?php foreach($picture->tags as $tag): ?>
  * <?php echo $tag->title ?><br />
  <?php endforeach ?>
People involved: <?php echo sizeof($picture->people) ?><br />
  <?php foreach($picture->people as $person): ?>
  * <?php echo $person->name ?><br />
  <?php endforeach ?>
<?php endforeach ?>
</p>

<h2>Categories</h2>
<?php foreach($categories as $category): ?>
<p><span  style="color: red"><?php echo $category?></span><br />
Number of pictures: <?php echo sizeof($category->pictures) ?><br />
  <?php foreach($category->pictures as $picture): ?>
  * <?php echo $picture ?><br />
  <?php endforeach ?>
<?php endforeach ?>
</p>
