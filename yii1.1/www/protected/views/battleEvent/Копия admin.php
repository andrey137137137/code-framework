<?php
/* @var $this BattleEventController */
/* @var $model BattleEvent */

$this->breadcrumbs=array(
	'Battle Events'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List BattleEvent', 'url'=>array('index')),
	array('label'=>'Create BattleEvent', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#battle-event-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Battle Events</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'battle-event-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'prev_event_id',
		'next_event_id',
		'battle_player1.battle.battle_date',
		'battle_player1.teem.title',
		'battle_player1.player.title',
		'teem1_score',
		'teem2_score',
		'battle_player2.player.title',
		'battle_player2.teem.title',
		'event_type',
		'event_direction',
		'destruction_type.title',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
