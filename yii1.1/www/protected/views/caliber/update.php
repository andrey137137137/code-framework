<?php
/* @var $this CaliberController */
/* @var $model Caliber */

$this->breadcrumbs=array(
	'Calibers'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Caliber', 'url'=>array('index')),
	array('label'=>'Create Caliber', 'url'=>array('create')),
	array('label'=>'View Caliber', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Caliber', 'url'=>array('admin')),
);
?>

<h1>Update Caliber <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>