<?php
/* @var $this DestructionTypeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Destruction Types',
);

$this->menu=array(
	array('label'=>'Create DestructionType', 'url'=>array('create')),
	array('label'=>'Manage DestructionType', 'url'=>array('admin')),
);
?>

<h1>Destruction Types</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
