<?php
/* @var $this CategoryController */
/* @var $model Category */

$this->breadcrumbs=array(
	'Categories'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Category', 'url'=>array('index')),
	array('label'=>'Create Category', 'url'=>array('create')),
	array('label'=>'Update Category', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Category', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Category', 'url'=>array('admin')),
);
?>

<h1>Category «<?php echo $model ?>»</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>

<?php if(sizeof($pictures)): ?>
<h2>Pictures</h2>
<?php foreach($pictures as $picture): ?>
  <p><?php echo $picture ?> - <?php echo CHtml::link('View',array('picture/view', 'id'=>$picture->id)); ?></p>
<?php endforeach ?>
<?php endif ?>
