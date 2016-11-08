<?php
/* @var $this BattleEventController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Battle Events',
);

$this->menu=array(
	array('label'=>'Create BattleEvent', 'url'=>array('create')),
	array('label'=>'Manage BattleEvent', 'url'=>array('admin')),
);
?>

<h1>Battle Events</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
