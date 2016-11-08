<?php

/**
 * Creates a new model.
 * If creation is successful, the browser will be redirected to the 'view' page.
 */
class CreateTransactionAction extends CAction
{
	public $view = 'create';
	public $redirView = 'view';
	
	public function run($battleId = false, $selectElemId = false)
    {
		$controller = $this->controller;
		
		$model = $controller->model;
		
		if(Yii::app()->request->getIsAjaxRequest() && $battleId && $selectElemId)
		{
			switch ($selectElemId)
			{
				case 'selectPrevEvent':	$items = $model::allBattleEventItems($battleId);
										break;
				case 'prev_event_id':
				case 'next_event_id':	$items = $model::battleEventItems($battleId);
										break;
				case 'battlePlayer1Id':
				case 'battlePlayer2Id':	$items = $model::playerItems($battleId);
										break;
			}
			
			echo $selectElemId . '<br />' . CHtml::activeDropDownList($model, $selectElemId, $items, array('data-id' => $selectElemId));
			
			Yii::app()->end();
		}
		else
		{
			$modelName = $controller->modelName;
			$prevItem = 'prev' . $modelName;
			
		//	$battlePlayer = new BattlePlayer('search');
			$battlePlayer1 = new BattlePlayer('search');
			$battlePlayer2 = new BattlePlayer('search');
		//	$battleEvent = new BattleEvent();
			
		//	$battlePlayer->unsetAttributes();  // clear any default values
			$battlePlayer1->unsetAttributes();  // clear any default values
			$battlePlayer2->unsetAttributes();  // clear any default values
			
			if (isset($_GET['BattlePlayer1']))
				$battlePlayer1->attributes = $_GET['BattlePlayer1'];
			
			if (isset($_GET['BattlePlayer2']))
				$battlePlayer2->attributes = $_GET['BattlePlayer2'];
			
			if (!isset($_GET['BattlePlayer1']) && !isset($_GET['BattlePlayer2']))
			{
				if (!$battleId)
				{
					if (isset($_GET[$prevItem]['battleId']))
						$battleId = $_GET[$prevItem]['battleId'];
					else
					{
						$battleId = Yii::app()->db->createCommand()
												->select('max({{battle}}.id)')
												->from('{{battle}}')
												->queryScalar();
					}
				}
				
				$teemIds = Yii::app()->db->createCommand()
										->selectDistinct('{{battle_player}}.teem_id')
										->from('{{battle_player}}')
										->queryAll();
				
				if ($battleId)
				{
					$i = 0;
					
					foreach ($teemIds as $teemId)
					{
						if (!$i)
							$battlePlayer1->teem_id = $teemId;
						elseif ($i == 1)
							$battlePlayer2->teem_id = $teemId;
						else
							break;
						
						$i++;
					}
					
					$battlePlayer1->battle_id = $battleId;
					$battlePlayer2->battle_id = $battleId;
				}
			}
			
			// Uncomment the following line if AJAX validation is needed
			// $this->performAjaxValidation($model);
			
			if (isset($_POST[$modelName]))
			{
				$model->attributes=$_POST[$modelName];
				
				$transaction = $model->getDbConnection()->beginTransaction();
				
				try
				{
					$model->save();
					$transaction->commit();
					
					$controller->redirect(array($this->redirView, $prevItem => $_POST[$modelName]));
				}
				catch (Exception $e)
				{
					$transaction->rollback();
				}
			}
			
			if (isset($_GET[$prevItem]))
				$model->attributes = $_GET[$prevItem];
			
			$controller->render($this->view, array(
			//	'battlePlayer' => $battlePlayer,
				'battlePlayer1' => $battlePlayer1,
				'battlePlayer2' => $battlePlayer2,
				'battleEvent' => $model,
			//	'model'=>$model,
			));
		}
    }
}
