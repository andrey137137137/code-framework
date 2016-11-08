<?php
/* @var $this BattleController */
/* @var $model Battle */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->dropDownList($model,'id',Crud::items($model, 'battle_date')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'genre_id'); ?>
		<?php echo $form->dropDownList($model,'genre_id',Crud::items(Genre)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'battle_date'); ?>
		<?php echo $form->textField($model,'battle_date'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->