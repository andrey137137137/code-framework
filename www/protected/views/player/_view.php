<?php
/* @var $this PlayerController */
/* @var $data Player */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vehicle_id')); ?>:</b>
	<?php echo CHtml::encode($data->vehicle_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('photo_id')); ?>:</b>
	<?php echo CHtml::encode($data->photo_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('victories')); ?>:</b>
	<?php echo CHtml::encode($data->victories); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('draws')); ?>:</b>
	<?php echo CHtml::encode($data->draws); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('losses')); ?>:</b>
	<?php echo CHtml::encode($data->losses); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('teem_score')); ?>:</b>
	<?php echo CHtml::encode($data->teem_score); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('destroyed_enemies')); ?>:</b>
	<?php echo CHtml::encode($data->destroyed_enemies); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('destroyed_confederates')); ?>:</b>
	<?php echo CHtml::encode($data->destroyed_confederates); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('suicides')); ?>:</b>
	<?php echo CHtml::encode($data->suicides); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('score')); ?>:</b>
	<?php echo CHtml::encode($data->score); ?>
	<br />

	*/ ?>

</div>