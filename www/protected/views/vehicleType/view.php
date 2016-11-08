<?php
/* @var $this VehicleTypeController */
/* @var $model VehicleType */

$this->breadcrumbs=array(
	'Vehicle Types'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List VehicleType', 'url'=>array('index')),
	array('label'=>'Create VehicleType', 'url'=>array('create')),
	array('label'=>'Update VehicleType', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete VehicleType', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage VehicleType', 'url'=>array('admin')),
);
?>

<h1>View VehicleType #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'priority_id',
	),
)); ?>
