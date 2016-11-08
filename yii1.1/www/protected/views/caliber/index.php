<?php
/* @var $this CaliberController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Calibers',
);

$this->menu=array(
	array('label'=>'Create Caliber', 'url'=>array('create')),
	array('label'=>'Manage Caliber', 'url'=>array('admin')),
);
?>

<h1>Calibers</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
