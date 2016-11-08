<?php
/* @var $this PlayerController */
/* @var $model Player */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->dropDownList($model,'id',Crud::items($model)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>57,'maxlength'=>57)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vehicle_id'); ?>
		<?php echo $form->dropDownList($model,'vehicle_id',Crud::items(Vehicle)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'photo_id'); ?>
		<?php echo $form->dropDownList($model,'photo_id',Crud::items(Photo)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'victories'); ?>
		<?php echo $form->textField($model,'victories',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'draws'); ?>
		<?php echo $form->textField($model,'draws',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'losses'); ?>
		<?php echo $form->textField($model,'losses',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'teem_score'); ?>
		<?php echo $form->textField($model,'teem_score'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'destroyed_enemies'); ?>
		<?php echo $form->textField($model,'destroyed_enemies',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'destroyed_confederates'); ?>
		<?php echo $form->textField($model,'destroyed_confederates',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'suicides'); ?>
		<?php echo $form->textField($model,'suicides',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'score'); ?>
		<?php echo $form->textField($model,'score'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->