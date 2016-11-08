<?php
/* @var $this TeemController */
/* @var $model Teem */

$this->breadcrumbs=array(
	'Teems'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Teem', 'url'=>array('index')),
	array('label'=>'Create Teem', 'url'=>array('create')),
	array('label'=>'View Teem', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Teem', 'url'=>array('admin')),
);
?>

<h1>Update Teem <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>