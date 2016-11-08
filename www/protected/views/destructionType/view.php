<?php
/* @var $this DestructionTypeController */
/* @var $model DestructionType */

$this->breadcrumbs=array(
	'Destruction Types'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List DestructionType', 'url'=>array('index')),
	array('label'=>'Create DestructionType', 'url'=>array('create')),
	array('label'=>'Update DestructionType', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete DestructionType', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DestructionType', 'url'=>array('admin')),
);
?>

<h1>View DestructionType #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
	),
)); ?>
