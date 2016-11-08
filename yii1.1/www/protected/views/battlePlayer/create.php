<?php
/* @var $this BattlePlayerController */
/* @var $model BattlePlayer */

$this->breadcrumbs=array(
	'Battle Players'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List BattlePlayer', 'url'=>array('index')),
	array('label'=>'Manage BattlePlayer', 'url'=>array('admin')),
);
?>

<h1>Create BattlePlayer</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>