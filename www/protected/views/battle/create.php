<?php
/* @var $this BattleController */
/* @var $model Battle */

$this->breadcrumbs=array(
	'Battles'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Battle', 'url'=>array('index')),
	array('label'=>'Manage Battle', 'url'=>array('admin')),
);
?>

<h1>Create Battle</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>