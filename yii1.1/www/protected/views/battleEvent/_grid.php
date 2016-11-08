<?php 

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'battle-player' . $number . '-grid',
	'dataProvider'=>$model->search(false),
	'filter'=>$model,
	'columns'=>array(
	//	'id',
	//	'battle.battle_date',
	//	'teem.title',
		'player.title',
		'destroyed_enemies',
		'destroyed_confederates',
		'score',
		'status',
	//	array(
	//		'class'=>'CButtonColumn',
	//	),
	),
));
