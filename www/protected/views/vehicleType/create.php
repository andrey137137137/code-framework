<?php
/* @var $this VehicleTypeController */
/* @var $model VehicleType */

$this->breadcrumbs=array(
	'Vehicle Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List VehicleType', 'url'=>array('index')),
	array('label'=>'Manage VehicleType', 'url'=>array('admin')),
);
?>

<h1>Create VehicleType</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>