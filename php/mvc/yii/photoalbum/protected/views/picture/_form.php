<?php
/* @var $this PictureController */
/* @var $model Picture */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'picture-form',
	'enableAjaxValidation'=>false,
  'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>
  
	<div class="row">
		<?php echo $form->labelEx($model,'uploadedfile'); ?>
		<?php echo $form->fileField($model,'uploadedfile',array('size'=>50)); ?>
		<?php echo $form->error($model,'uploadedfile'); ?>
	</div>

  <?php
  // See http://stackoverflow.com/questions/9146309/does-yiis-giis-crud-generator-take-into-account-models-relations
  /* original generated code
  
	<div class="row">
		<?php echo $form->labelEx($model,'category_id'); ?>
		<?php echo $form->textField($model,'category_id',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'category_id'); ?>
	</div>
  */
  
  ?>
  <div class="row">
     <?php echo $form->labelEx($model, 'category_id'); ?>
     <?php echo $form->dropDownList($model,'category_id', CHtml::listData(Category::model()->findAll(),
        'id', //this is the attribute name for list option values 
        'name' // this is the attribute name for list option texts 
         )
      ); ?>
     <?php echo $form->error($model,'venue'); ?>
  </div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
