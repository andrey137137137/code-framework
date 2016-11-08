<?php
/* @var $this BattleEventController */
/* @var $model BattleEvent */

$this->breadcrumbs=array(
	'Battle Events'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List BattleEvent', 'url'=>array('index')),
	array('label'=>'Manage BattleEvent', 'url'=>array('admin')),
);
?>

<h1>Create BattleEvent</h1>

<div id="forms">
	
	<div id="battle-search-forms">
		
		<div class="left width-33-perc align-center">
			<?php $this->renderPartial('_battleTeemsSearch', array('model'=>$battlePlayer1, 'number' => '1'));?>
		</div>
		
		<div class="left width-33-perc align-center">
			<div class="wide form">
				<?php
					$aLabels = $battlePlayer1->attributeLabels();
					echo CHtml::label($aLabels['battle_id'], 'battle_id');
					echo CHtml::dropDownList('battle_id', $battlePlayer1->battle_id, Crud::items(Battle, 'battle_date'));
				?>
			</div>
		</div>
		
		<div class="left width-33-perc align-center">
			<?php $this->renderPartial('_battleTeemsSearch', array('model'=>$battlePlayer2, 'number' => '2'));?>
		</div>
		
		<div class="clear">
		</div>
		
	</div>
	
	<div id="battle-player1-grid-container" class="left width-33-perc align-center">
		<?php $this->renderPartial('_grid', array('model'=>$battlePlayer1, 'number' => 1));?>
	</div>
	
	<div class="left width-33-perc align-center">
		&nbsp;
	</div>
	
	<div id="battle-player2-grid-container" class="left width-33-perc align-center">
		<?php $this->renderPartial('_grid', array('model'=>$battlePlayer2, 'number' => 2));?>
	</div>
	
	<div class="clear">
	</div>
	
	<?php $this->renderPartial('_form', array('model' => $battleEvent, 'battleId' => $battlePlayer1->battle_id));?>
	
</div>

<?php
	
	//$this->renderPartial('_form', array('model'=>$model));

?>