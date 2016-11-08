<?php
/* @var $this DestructionTypeController */
/* @var $model DestructionType */

$this->breadcrumbs=array(
	'Destruction Types'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List DestructionType', 'url'=>array('index')),
	array('label'=>'Create DestructionType', 'url'=>array('create')),
	array('label'=>'View DestructionType', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage DestructionType', 'url'=>array('admin')),
);
?>

<h1>Update DestructionType <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>