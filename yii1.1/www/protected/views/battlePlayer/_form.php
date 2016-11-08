<?php
/* @var $this BattlePlayerController */
/* @var $model BattlePlayer */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'battle-player-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'battle_id'); ?>
		<?php echo $form->dropDownList($model,'battle_id',Crud::items(Battle, 'battle_date', 'battle_date', 'DESC')); ?>
		<?php echo $form->error($model,'battle_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'teem_id'); ?>
		<?php echo $form->dropDownList($model,'teem_id',Crud::items(Teem)); ?>
		<?php echo $form->error($model,'teem_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'player_id'); ?>
		<?php echo $form->dropDownList($model,'player_id',Crud::items(Player, 'title', 'title')); ?>
		<?php echo $form->error($model,'player_id'); ?>
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
		<?php echo $form->labelEx($model,'score'); ?>
		<?php echo $form->textField($model,'score'); ?>
		<?php echo $form->error($model,'score'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropDownList($model,'status',$model::$status); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->