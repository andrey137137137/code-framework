<?php
/* @var $this BattlePlayerController */
/* @var $model BattlePlayer */

$this->breadcrumbs=array(
	'Battle Players'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List BattlePlayer', 'url'=>array('index')),
	array('label'=>'Create BattlePlayer', 'url'=>array('create')),
	array('label'=>'Update BattlePlayer', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete BattlePlayer', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage BattlePlayer', 'url'=>array('admin')),
);
?>

<h1>View BattlePlayer #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'battle.battle_date',
		'teem.title',
		'player.title',
		'destroyed_enemies',
		'destroyed_confederates',
		'score',
		'status',
	),
)); ?>
