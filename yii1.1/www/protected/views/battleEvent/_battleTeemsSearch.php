<?php
/* @var $this BattleEventController */
/* @var $model BattlePlayer */
/* @var $form CActiveForm */

?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id' => 'teem' . $number . '-search-form',
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
	
	<div class="row">
		<?php
			$searchPrefix = 'search_';
			$searchPostfix = '_id';
			
			$modelName = get_class($model);
			
			$id = 'teem_id';
			
			echo $form->label($model, $id);
			echo $form->dropDownList($model, $id, Crud::items(Teem),
				array(
					'id' => $searchPrefix . 'teem' . $number . $searchPostfix,
					'name' => $modelName . $number . '[' . $id . ']'
				)
			);
			
			echo '<br />';
			
			$id = 'battle_id';
			
			echo $form->label($model, $id);
			echo $form->textField($model, $id,
				array(
					'id' => $searchPrefix . 'battle' . $number . $searchPostfix,
					'name' => $modelName . $number . '[' . $id . ']'
				)
			);
		?>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>
	
<?php $this->endWidget(); ?>

</div><!-- search-form -->