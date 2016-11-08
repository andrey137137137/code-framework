<?php
/* @var $this BattleEventController */
/* @var $model BattleEvent */

$this->breadcrumbs=array(
	'Battle Events'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List BattleEvent', 'url'=>array('index')),
	array('label'=>'Create BattleEvent', 'url'=>array('create')),
	array('label'=>'Update BattleEvent', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete BattleEvent', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage BattleEvent', 'url'=>array('admin')),
);
?>

<h1>View BattleEvent #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'battle_id',
		'prev_event_id',
		'teem1_id',
		'teem1_score',
		'event_type',
		'player1_id',
		'player2_id',
		'destroyed_status_id',
		'teem2_id',
		'teem2_score',
		'next_event_id',
	),
)); ?>
