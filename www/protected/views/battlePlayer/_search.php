<?php
/* @var $this BattlePlayerController */
/* @var $model BattlePlayer */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->dropDownList($model,'id',Crud::items($model, 'id')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'battle_id'); ?>
		<?php echo $form->dropDownList($model,'battle_id',Crud::items(Battle, 'battle_date')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'teem_id'); ?>
		<?php echo $form->dropDownList($model,'teem_id',Crud::items(Teem)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'player_id'); ?>
		<?php echo $form->dropDownList($model,'player_id',Crud::items(Player)); ?>
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
		<?php echo $form->label($model,'score'); ?>
		<?php echo $form->textField($model,'score'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropDownList($model,'status',$model::$status); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->