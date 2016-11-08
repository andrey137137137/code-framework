<?php
/* @var $this BattleEventController */
/* @var $model BattleEvent */

$this->breadcrumbs=array(
	'Battle Events'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List BattleEvent', 'url'=>array('index')),
	array('label'=>'Create BattleEvent', 'url'=>array('create')),
	array('label'=>'View BattleEvent', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage BattleEvent', 'url'=>array('admin')),
);
?>

<h1>Update BattleEvent <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>