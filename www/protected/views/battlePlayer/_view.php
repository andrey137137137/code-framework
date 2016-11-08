<?php
/* @var $this BattlePlayerController */
/* @var $data BattlePlayer */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('battle_id')); ?>:</b>
	<?php echo CHtml::encode($data->battle->battle_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('teem_id')); ?>:</b>
	<?php echo CHtml::encode($data->teem->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('player_id')); ?>:</b>
	<?php echo CHtml::encode($data->player->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('destroyed_enemies')); ?>:</b>
	<?php echo CHtml::encode($data->destroyed_enemies); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('destroyed_confederates')); ?>:</b>
	<?php echo CHtml::encode($data->destroyed_confederates); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('score')); ?>:</b>
	<?php echo CHtml::encode($data->score); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

</div>