<?php
/* @var $this BattlePlayerController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Battle Players',
);

$this->menu=array(
	array('label'=>'Create BattlePlayer', 'url'=>array('create')),
	array('label'=>'Manage BattlePlayer', 'url'=>array('admin')),
);
?>

<h1>Battle Players</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
