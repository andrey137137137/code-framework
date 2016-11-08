<?php
/* @var $this VehicleTypeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Vehicle Types',
);

$this->menu=array(
	array('label'=>'Create VehicleType', 'url'=>array('create')),
	array('label'=>'Manage VehicleType', 'url'=>array('admin')),
);
?>

<h1>Vehicle Types</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
