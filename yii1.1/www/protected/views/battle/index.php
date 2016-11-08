<?php
/* @var $this BattleController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Battles',
);

$this->menu=array(
	array('label'=>'Create Battle', 'url'=>array('create')),
	array('label'=>'Manage Battle', 'url'=>array('admin')),
);
?>

<h1>Battles</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
