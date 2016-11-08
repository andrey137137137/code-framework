<?php
/* @var $this BattlePlayerController */
/* @var $model BattlePlayer */

$this->breadcrumbs=array(
	'Battle Players'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List BattlePlayer', 'url'=>array('index')),
	array('label'=>'Create BattlePlayer', 'url'=>array('create')),
	array('label'=>'View BattlePlayer', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage BattlePlayer', 'url'=>array('admin')),
);
?>

<h1>Update BattlePlayer <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>