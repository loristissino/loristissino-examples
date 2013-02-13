<?php
/* @var $this PictureController */
/* @var $model Picture */

$this->breadcrumbs=array(
	'Pictures'=>array('index'),
	$model->id=>array('view', 'id'=>$model->id),
  'Fix',
);

?>

<h1>Fixing picture «<?php echo $model->description ?>»</h1>

<?php $form=$this->beginWidget('CActiveForm'); ?>
    <div class="row submit">
        <?php echo CHtml::submitButton('Fix'); ?>
    </div>
<?php $this->endWidget(); ?>

