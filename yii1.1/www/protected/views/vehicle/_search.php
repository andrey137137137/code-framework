<?php
/* @var $this VehicleController */
/* @var $model Vehicle */
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
		<?php echo $form->label($model,'level_id'); ?>
		<?php echo $form->dropDownList($model,'level_id',Crud::items(Level)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'caliber_id'); ?>
		<?php echo $form->dropDownList($model,'caliber_id',Crud::items(Caliber)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vehicle_type_id'); ?>
		<?php echo $form->dropDownList($model,'vehicle_type_id',Crud::items(VehicleType)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'country_id'); ?>
		<?php echo $form->dropDownList($model,'country_id',Crud::items(Country)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'photo_id'); ?>
		<?php echo $form->dropDownList($model,'photo_id',Crud::items(Photo)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->