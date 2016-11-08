<?php
/* @var $this BattleController */
/* @var $model Battle */

$this->breadcrumbs=array(
	'Battles'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Battle', 'url'=>array('index')),
	array('label'=>'Create Battle', 'url'=>array('create')),
	array('label'=>'Update Battle', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Battle', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Battle', 'url'=>array('admin')),
);
?>

<h1>View Battle #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'genre.title',
		'battle_date',
	),
)); ?>
