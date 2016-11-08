<?php
/* @var $this BattleEventController */
/* @var $model BattleEvent */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'byPrevEvent'); ?>
		<?php //echo $form->dropDownList($model,'byPrevEvent',$model::allBattleEventItems()); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'battleId'); ?>
		<?php echo $form->dropDownList($model,'battleId',Crud::items(Battle, 'battle_date')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'prev_event_id'); ?>
		<?php echo $form->dropDownList($model,'prev_event_id',$model::battleEventItems()); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'teem1Id'); ?>
		<?php echo $form->dropDownList($model,'teem1Id',Crud::items(Teem)); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'teem1_score'); ?>
		<?php echo $form->textField($model,'teem1_score',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'player1Id'); ?>
		<?php echo $form->dropDownList($model,'player1Id',Crud::items(Player)); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'battle_player1_id'); ?>
		<?php echo $form->dropDownList($model,'battle_player1_id',$model::playerItems()); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'event_type'); ?>
		<?php echo $form->dropDownList($model,'event_type',$model::$events); ?>
		
		<?php //echo $form->labelEx($model,'destruction_type_id'); ?>
		<?php echo $form->dropDownList($model,'destruction_type_id',Crud::items(DestructionType)); ?>
	</div>

	<div class="row">
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'battle_player2_id'); ?>
		<?php echo $form->dropDownList($model,'battle_player2_id',$model::playerItems()); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'player2Id'); ?>
		<?php echo $form->dropDownList($model,'player2Id',Crud::items(Player)); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'teem2Id'); ?>
		<?php echo $form->dropDownList($model,'teem2Id',Crud::items(Teem)); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'teem2_score'); ?>
		<?php echo $form->textField($model,'teem2_score',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'next_event_id'); ?>
		<?php echo $form->dropDownList($model,'next_event_id',$model::battleEventItems()); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->