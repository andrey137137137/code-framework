<?php
/* @var $this BattleController */
/* @var $model Battle */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'battle-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'genre_id'); ?>
		<?php echo $form->dropDownList($model,'genre_id',Crud::items(Genre)); ?>
		
		<?php echo $form->error($model,'genre_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'battle_date'); ?>
		<?php
			$curDate = new DateTime();
			$this->widget('zii.widgets.jui.CJuiDatePicker',array(
				'name'=>'publishDate',
				// additional javascript options for the date picker plugin
				'model'=>$model,
				'name'=>'battle_date',
				'language'=>'ru',
				'attribute' => 'battle_date',
				'value'=> (
							!empty($model->battle_date) ?
								$model->battle_date :
								$curDate->format('Y-m-d')
						),
				'options'=>array(
				//	'showAnim'=>'fold',
					'dateFormat'=>'yy-mm-dd',
				),
				'htmlOptions'=>array(
					'style'=>'height:20px;'
				),
			));
		?>
		<?php echo $form->error($model,'battle_date'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->