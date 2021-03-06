<?php
/* @var $this CaliberController */
/* @var $model Caliber */

$this->breadcrumbs=array(
	'Calibers'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Caliber', 'url'=>array('index')),
	array('label'=>'Create Caliber', 'url'=>array('create')),
	array('label'=>'Update Caliber', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Caliber', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Caliber', 'url'=>array('admin')),
);
?>

<h1>View Caliber #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'diametr',
	),
)); ?>
