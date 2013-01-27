<?php
/* @var $this PictureController */
/* @var $model Picture */

$this->breadcrumbs=array(
	'Pictures'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Add tag',
);

$this->menu=array(
	array('label'=>'List Picture', 'url'=>array('index')),
	array('label'=>'Create Picture', 'url'=>array('create')),
	array('label'=>'View Picture', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Picture', 'url'=>array('admin')),
);
?>

<h1>Add tag to picture <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_tagform', array('model'=>$model, 'tagform'=>$tagform)); ?>
