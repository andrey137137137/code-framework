<?php
/* @var $this BattleEventController */
/* @var $data BattleEvent */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prev_event_id')); ?>:</b>
	<?php echo CHtml::encode($data->prev_event_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('next_event_id')); ?>:</b>
	<?php echo CHtml::encode($data->next_event_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('teem1_score')); ?>:</b>
	<?php echo CHtml::encode($data->teem1_score); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('teem2_score')); ?>:</b>
	<?php echo CHtml::encode($data->teem2_score); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('battle_player1_id')); ?>:</b>
	<?php echo CHtml::encode($data->battle_player1->player->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('battle_player2_id')); ?>:</b>
	<?php echo CHtml::encode($data->battle_player2->player->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('event_type')); ?>:</b>
	<?php echo CHtml::encode($data->event_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('event_direction')); ?>:</b>
	<?php echo CHtml::encode($data->event_direction); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('destruction_type_id')); ?>:</b>
	<?php echo CHtml::encode($data->destruction_type->title); ?>
	<br />

</div>