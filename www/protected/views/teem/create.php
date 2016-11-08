<?php
/* @var $this TeemController */
/* @var $model Teem */

$this->breadcrumbs=array(
	'Teems'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Teem', 'url'=>array('index')),
	array('label'=>'Manage Teem', 'url'=>array('admin')),
);
?>

<h1>Create Teem</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>