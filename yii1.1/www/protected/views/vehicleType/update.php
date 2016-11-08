<?php
/* @var $this VehicleTypeController */
/* @var $model VehicleType */

$this->breadcrumbs=array(
	'Vehicle Types'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List VehicleType', 'url'=>array('index')),
	array('label'=>'Create VehicleType', 'url'=>array('create')),
	array('label'=>'View VehicleType', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage VehicleType', 'url'=>array('admin')),
);
?>

<h1>Update VehicleType <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>