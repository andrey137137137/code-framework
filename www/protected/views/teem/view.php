<?php
/* @var $this TeemController */
/* @var $model Teem */

$this->breadcrumbs=array(
	'Teems'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Teem', 'url'=>array('index')),
	array('label'=>'Create Teem', 'url'=>array('create')),
	array('label'=>'Update Teem', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Teem', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Teem', 'url'=>array('admin')),
);
?>

<h1>View Teem #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'victories',
		'draws',
		'losses',
		'score',
	),
)); ?>
