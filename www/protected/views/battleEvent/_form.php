<?php
/* @var $this BattleEventController */
/* @var $model BattleEvent */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id' => 'battle-event-form',
	//'action' => CHtml::normalizeUrl(array('battleEvent/create')),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation' => false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<div class="row">
		<?php echo $form->labelEx($model,'cascadeSave'); ?>
		<?php //echo $form->dropDownList($model,'cascadeSave',$model::$cascadeSave); ?>
		<?php echo $form->error($model,'cascadeSave'); ?>
	</div>
	
	<div class="left width-33-perc align-center">
		
		<div class="row">
			<?php echo $form->labelEx($model,'prev_event_id'); ?>
			<?php echo $form->dropDownList($model,'prev_event_id',$model::battleEventItems($battleId)); ?>
			<?php echo $form->error($model,'prev_event_id'); ?>
		</div>
		
		<div class="row">
			<?php echo $form->labelEx($model,'teem1Id'); ?>
			<?php echo $form->dropDownList($model,'teem1Id',Crud::items(Teem)); ?>
			<?php echo $form->error($model,'teem1Id'); ?>
		</div>
		
		<div class="row">
			<?php echo $form->labelEx($model,'battle_player1_id'); ?>
			<?php echo $form->dropDownList($model,'battlePlayer1Id',$model::playerItems($battleId)); ?>
			<?php echo $form->error($model,'battle_player1_id'); ?>
		</div>
		
		<div class="row">
			<?php echo $form->labelEx($model,'player1Id'); ?>
			<?php echo $form->dropDownList($model,'player1Id',Crud::items(Player)); ?>
			<?php echo $form->error($model,'player1Id'); ?>
		</div>
		
		<div class="row">
			<?php echo $form->textField($model,'battle_player1_id'); ?>
			<?php //echo $form->hiddenField($model,'battle_player1_id'); ?>
		</div>
		
		<?php if (!$model->isNewRecord){ ?>
			<div class="row">
				<?php echo $form->labelEx($model,'old_battle_player1_id'); ?>
				<?php echo $form->textField($model,'old_battle_player1_id'); ?>
				<?php echo $form->error($model,'old_battle_player1_id'); ?>
			</div>
		<?php }?>
		
	</div>
	
	<div class="left width-33-perc align-center">
		&nbsp;
		
		<div id="form-center" class="left width-33-perc align-center">
			
			<?php if ($model->isNewRecord){ ?>
				<div class="row">
					<?php echo $form->labelEx($model,'selectPrevEvent'); ?>
					<?php echo $form->dropDownList($model,'selectPrevEvent',$model::allBattleEventItems($battleId)); ?>
					<?php echo $form->error($model,'selectPrevEvent'); ?>
				</div>
			<?php }?>
			
			<div class="row">
				<?php echo $form->labelEx($model,'battleId'); ?>
				<?php echo $form->dropDownList($model,'battleId',Crud::items(Battle, 'battle_date')); ?>
				<?php echo $form->error($model,'battleId'); ?>
			</div>
			
			<div class="row">
				<?php echo $form->labelEx($model,'event_direction'); ?>
				<?php //echo $form->labelEx($model,'teem1_score'); ?>
				<?php echo $form->textField($model,'teem1_score',array('size'=>10,'maxlength'=>10)); ?>
				<?php echo $form->error($model,'teem1_score'); ?>
				
				&nbsp;&nbsp;&nbsp;
				
				<?php echo $form->dropDownList($model,'event_direction',$model::eventDirectionItems()); ?>
				<?php echo $form->error($model,'event_direction'); ?>
				
				&nbsp;&nbsp;&nbsp;
				
				<?php //echo $form->labelEx($model,'teem2_score'); ?>
				<?php echo $form->textField($model,'teem2_score',array('size'=>10,'maxlength'=>10)); ?>
				<?php echo $form->error($model,'teem2_score'); ?>
			</div>
			
			<div class="row">
				<?php echo $form->labelEx($model,'event_type'); ?>
				<?php echo $form->dropDownList($model,'event_type',$model::$eventType); ?>
				<?php echo $form->error($model,'event_type'); ?>
			</div>
			
			<div class="row">
				<?php echo $form->labelEx($model,'destruction_type_id'); ?>
				<?php echo $form->dropDownList($model,'destruction_type_id',Crud::items(DestructionType)); ?>
				<?php echo $form->error($model,'destruction_type_id'); ?>
			</div>
			
			<?php if (!$model->isNewRecord){ ?>
				<div class="row">
					<?php echo $form->labelEx($model,'old_event_direction'); ?>
					<?php echo $form->textField($model,'old_event_direction'); ?>
					<?php echo $form->error($model,'old_event_direction'); ?>
				</div>
				
				<div class="row">
					<?php echo $form->labelEx($model,'old_event_type'); ?>
					<?php echo $form->textField($model,'old_event_type'); ?>
					<?php echo $form->error($model,'old_event_type'); ?>
				</div>
				
				<div class="row">
					<?php echo $form->labelEx($model,'old_destruction_type_id'); ?>
					<?php echo $form->textField($model,'old_destruction_type_id'); ?>
					<?php echo $form->error($model,'old_destruction_type_id'); ?>
				</div>
			<?php }?>
			
			<div class="row buttons">
				
				<div class="left width-33-perc align-center">
					<?php if ($model->isNewRecord){
						echo CHtml::button('<', array('id' => 'prevButton', 'class' => 'width-50-perc align-center'));
					}else{
						echo '&nbsp';
					}?>
				</div>
				
				<div class="left width-33-perc align-center">
				<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'width-100-perc align-center')); ?>
				</div>
				
				<div class="left width-33-perc align-center">
					<?php if ($model->isNewRecord){
						echo CHtml::button('>', array('id' => 'nextButton', 'class' => 'width-50-perc align-center'));
					}else{
						echo '&nbsp';
					}?>
				</div>
				
			</div>
			
		</div>
		
	</div>
	
	<div class="left width-33-perc align-center">
		
		<div class="row">
			<?php echo $form->labelEx($model,'next_event_id'); ?>
			<?php echo $form->dropDownList($model,'next_event_id',$model::battleEventItems($battleId)); ?>
			<?php echo $form->error($model,'next_event_id'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model,'teem2Id'); ?>
			<?php echo $form->dropDownList($model,'teem2Id',Crud::items(Teem)); ?>
			<?php echo $form->error($model,'teem2Id'); ?>
		</div>
		
		<div class="row">
			<?php echo $form->labelEx($model,'battle_player2_id'); ?>
			<?php echo $form->dropDownList($model,'battlePlayer2Id',$model::playerItems($battleId)); ?>
			<?php echo $form->error($model,'battle_player2_id'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model,'player2Id'); ?>
			<?php echo $form->dropDownList($model,'player2Id',Crud::items(Player)); ?>
			<?php echo $form->error($model,'player2Id'); ?>
		</div>
		
		<div class="row">
			<?php echo $form->textField($model,'battle_player2_id'); ?>
			<?php //echo $form->hiddenField($model,'battle_player2_id'); ?>
		</div>
		
		<?php if (!$model->isNewRecord){ ?>
			<div class="row">
				<?php echo $form->labelEx($model,'old_battle_player2_id'); ?>
				<?php echo $form->textField($model,'old_battle_player2_id'); ?>
				<?php echo $form->error($model,'old_battle_player2_id'); ?>
			</div>
		<?php }?>
		
	</div>
	
	<div class="clear">
	</div>
	
<?php $this->endWidget(); ?>

</div><!-- form -->