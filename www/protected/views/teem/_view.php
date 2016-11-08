<?php
/* @var $this TeemController */
/* @var $data Teem */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('victories')); ?>:</b>
	<?php echo CHtml::encode($data->victories); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('draws')); ?>:</b>
	<?php echo CHtml::encode($data->draws); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('losses')); ?>:</b>
	<?php echo CHtml::encode($data->losses); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('score')); ?>:</b>
	<?php echo CHtml::encode($data->score); ?>
	<br />


</div>