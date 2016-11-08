<?php
/* @var $this TeemController */
/* @var $model Teem */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'teem-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>77)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'victories'); ?>
		<?php echo $form->textField($model,'victories',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'victories'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'draws'); ?>
		<?php echo $form->textField($model,'draws',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'draws'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'losses'); ?>
		<?php echo $form->textField($model,'losses',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'losses'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'score'); ?>
		<?php echo $form->textField($model,'score'); ?>
		<?php echo $form->error($model,'score'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->