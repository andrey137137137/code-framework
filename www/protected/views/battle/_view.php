<?php
/* @var $this BattleController */
/* @var $data Battle */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('genre_id')); ?>:</b>
	<?php echo CHtml::encode($data->genre->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('battle_date')); ?>:</b>
	<?php echo CHtml::encode($data->battle_date); ?>
	<br />

</div>