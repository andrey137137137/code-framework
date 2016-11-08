<?php
/* @var $this PlayerController */
/* @var $model Player */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'player-form',
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
		<?php echo $form->textField($model,'title',array('size'=>57,'maxlength'=>57)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vehicle_id'); ?>
		<?php echo $form->dropDownList($model,'vehicle_id',Crud::items(Vehicle, 'title', 'title')); ?>
		<?php echo $form->error($model,'vehicle_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'photo_id'); ?>
		<?php echo $form->dropDownList($model,'photo_id',Crud::items(Photo)); ?>
		<?php echo $form->error($model,'photo_id'); ?>
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
		<?php echo $form->labelEx($model,'teem_score'); ?>
		<?php echo $form->textField($model,'teem_score'); ?>
		<?php echo $form->error($model,'teem_score'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'destroyed_enemies'); ?>
		<?php echo $form->textField($model,'destroyed_enemies',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'destroyed_enemies'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'destroyed_confederates'); ?>
		<?php echo $form->textField($model,'destroyed_confederates',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'destroyed_confederates'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'suicides'); ?>
		<?php echo $form->textField($model,'suicides',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'suicides'); ?>
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