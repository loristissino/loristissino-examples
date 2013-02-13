<?php
/* @var $this PictureController */
/* @var $model Picture */

$this->breadcrumbs=array(
	'Pictures'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Picture', 'url'=>array('index')),
	array('label'=>'Create Picture', 'url'=>array('create')),
	array('label'=>'Update Picture', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Picture', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Picture', 'url'=>array('admin')),
);
?>

<h1>Picture «<?php echo $model->description ?>»</h1>

<p>
<?php echo CHtml::image(
  CHtml::normalizeUrl(array('picture/serve', 'id'=>$model->id)),
  CHtml::encode($model->description),
  array('width'=>$model->width, 'height'=>$model->height)
  )
?>
</p>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'height',
		'width',
		'type',
    array( // related category displayed as a link
           // see http://www.yiiframework.com/doc/api/1.2/CDetailView
      'label'=>'category',
      'type'=>'raw',
      'value'=>CHtml::link(
        CHtml::encode($model->category),
        array('category/view','id'=>$model->category->id)
        ),
      ),
	),
)); ?>

<hr />

<h2>Tags</h2>

<p>
<?php foreach($model->tags as $tag): ?>
  <?php echo $tag->title ?><br />
<?php endforeach ?>
</p>

<p><?php echo CHtml::link(
        'Add a tag',
        array('picture/addtag','id'=>$model->id)
        )
?>
</p>

<p><?php echo CHtml::link(
    'Fix picture',
    $url=CHtml::normalizeUrl(array('picture/fix','id'=>$model->id)),
    array(
      'submit' => $url,
      'title' => 'Check real size and type and fix data base entries',
      'csrf'=>true,
    )
  )
?></p>

