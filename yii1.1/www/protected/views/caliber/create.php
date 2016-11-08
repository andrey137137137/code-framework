<?php
/* @var $this CaliberController */
/* @var $model Caliber */

$this->breadcrumbs=array(
	'Calibers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Caliber', 'url'=>array('index')),
	array('label'=>'Manage Caliber', 'url'=>array('admin')),
);
?>

<h1>Create Caliber</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>