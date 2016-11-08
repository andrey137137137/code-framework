<?php
/* @var $this BattleController */
/* @var $model Battle */

$this->breadcrumbs=array(
	'Battles'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Battle', 'url'=>array('index')),
	array('label'=>'Create Battle', 'url'=>array('create')),
	array('label'=>'View Battle', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Battle', 'url'=>array('admin')),
);
?>

<h1>Update Battle <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>