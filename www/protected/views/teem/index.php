<?php
/* @var $this TeemController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Teems',
);

$this->menu=array(
	array('label'=>'Create Teem', 'url'=>array('create')),
	array('label'=>'Manage Teem', 'url'=>array('admin')),
);
?>

<h1>Teems</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
