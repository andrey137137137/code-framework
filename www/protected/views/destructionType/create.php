<?php
/* @var $this DestructionTypeController */
/* @var $model DestructionType */

$this->breadcrumbs=array(
	'Destruction Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List DestructionType', 'url'=>array('index')),
	array('label'=>'Manage DestructionType', 'url'=>array('admin')),
);
?>

<h1>Create DestructionType</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>