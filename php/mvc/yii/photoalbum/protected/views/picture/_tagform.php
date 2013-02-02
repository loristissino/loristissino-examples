<h2>Basic example</h2>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tag-form',
	'enableClientValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($tagform); ?>

	<div class="row">
		<?php echo $form->hiddenField($tagform,'picture_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($tagform,'tag'); ?>
		<?php echo $form->textField($tagform,'tag'); ?>
		<?php echo $form->error($tagform,'tag'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<h2>AJAX powered example</h2>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tag-form',
	'enableClientValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($tagform); ?>

	<div class="row">
		<?php echo $form->hiddenField($tagform,'picture_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($tagform,'tag'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
      'id'=>'tag',
      'name'=>'PictureAddTagForm[tag]',
      'source'=>$this->createUrl('tag/suggest'),
      'htmlOptions'=>array(
          'size'=>'20'
      ),
    ))
    ?>
		<?php echo $form->error($tagform,'tag'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
