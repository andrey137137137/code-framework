<?php

/**
 * This is the model class for tables.
 *
 * The followings are the available columns in table '{{status}}':
 * @property string $id
 * @property string $title
 *
 * The followings are the available model relations:
 * @property BattlePlayer[] $battlePlayers
 */
class Crud
{
	public static $messagePostfixes = array(
		'unique' => " \"{value}\" уже существует!\n
					Нельзя добавлять или изменять на дублирующее значение аттрибута \"{attribute}\""
	);
	
	private static $_model;
	private static $_isInc;
	private static $_eventType;
	private static $_eventDirection;
	private static $_selectedPlayer;
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Country the loaded model
	 * @throws CHttpException
	 */
	public static function getMessage($label, $messageType)
	{
		return $label . self::$messagePostfixes[$messageType];
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Country the loaded model
	 * @throws CHttpException
	 */
	public static function getModelName($controller)
	{
		$contrName = get_class($controller);
		$contrPos = strrpos($contrName, 'Controller');
		$modelName = substr($contrName, 0, $contrPos);
		
		return $modelName;
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Country the loaded model
	 * @throws CHttpException
	 */
	public static function loadModel($modelName, $id)
	{
		$model = $modelName::model()->findByPk($id);
		
		if ($model === null)
			throw new CHttpException(404,'The requested page does not exist.');
		
		return $model;
	}
	
	/**
	 * Performs the AJAX validation.
	 * @param Country $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		$modelName = get_class($model);
		$formName = lcfirst($modelName) . '-form';
		
		if (isset($_POST['ajax']) && $_POST['ajax'] === $formName)
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function trim($value)
	{
		return htmlspecialchars(trim($value));
	}
	
	/**
	 * Returns the items for the specified type.
	 * @param string item type (e.g. 'PostStatus').
	 * @return array item names indexed by item code. The items are order by their position values.
	 * An empty array is returned if the item type does not exist.
	 */
	/*
	public static function items($model, $tableCol = 'title')
	{
		//if(!isset(self::$_items[$tableCol]))
		return self::loadItems($model, $tableCol);
		//return self::$_items[$tableCol];
	}
	*/

	/**
	 * Returns the item name for the specified type and code.
	 * @param string the item type (e.g. 'PostStatus').
	 * @param integer the item code (corresponding to the 'code' column value)
	 * @return string the item name for the specified the code. False is returned if the item type or code does not exist.
	 */
	public static function item($modelName, $id, $tableCol = 'title')
	{
		//if(!isset(self::$_items[$tableCol]))
		return self::loadItems($modelName, $tableCol);
		//return isset(self::$_items[$tableCol][$id]) ? self::$_items[$tableCol][$id] : false;
	}

	/**
	 * Loads the lookup items for the specified type from the database.
	 * @param string the item type
	 */
	public static function items($modelName, $tableCol = 'title', $orderCol = 'id', $orderDirect = 'ASC')
	{
	//	self::$_items[$tableCol]=array();
		$items = array();
		
		$raws = $modelName::model()->findAll(
			array(
			//	'condition'=>'type=:type',
			//	'params'=>array(':type'=>$type),
				'order' => $orderCol . ' ' . $orderDirect,
			)
		);
		
		foreach($raws as $raw)
			$items[$raw->id] = $raw[$tableCol];
		//	self::$_items[$tableCol][$raw->id] = $raw->title;
		
		return $items;
	}
	
	public static function setScoresOfPlayers($battleEvent, $isInc)
	{
		self::$_model = $battleEvent;
		self::$_isInc = $isInc;
		
		self::$_eventType = self::$_isInc ? self::$_model->event_type
										: self::$_model->old_event_type;
		
		$battle_player1_id = self::$_isInc ? self::$_model->battle_player1_id
										: self::$_model->old_battle_player1_id;
		
		if (!self::setBattlePlayerScore($battle_player1_id, -1))
			return false;
		
		if (self::$_eventType == 3)
			return true;
		
		$battle_player2_id = self::$_isInc ? self::$_model->battle_player2_id
										  : self::$_model->old_battle_player2_id;
		
		if (!self::setBattlePlayerScore($battle_player2_id, 1))
			return false;
		
		return true;
	}
	
	public static function setBattlePlayerScore($id, $selectedPlayer)
	{
		$battlePlayer = BattlePlayer::model()->findByPk($id);
		
		self::$_selectedPlayer = $selectedPlayer;
		
		$destroyed_enemies = $battlePlayer->destroyed_enemies;
		$destroyed_confederates = $battlePlayer->destroyed_confederates;
		$status = $battlePlayer->status;
		
		$old_destroyed_enemies = $destroyed_enemies;
		$old_destroyed_confederates = $destroyed_confederates;
		
		self::$_eventDirection = self::$_isInc ? self::$_model->event_direction
											: self::$_model->old_event_direction;
		
		$params = array();
		
		if (self::$_eventType == 3)
		{
			if (self::$_isInc)
				$status = 3;
			else
				$status = 1;
		}
		else
		{
			if (self::$_eventType == 1)
			{
				$params = self::calculateBattlePlayerDestroyedVehicles($destroyed_enemies, $old_destroyed_enemies);
			}
			elseif (self::$_eventType == 2)
			{
				$params = self::calculateBattlePlayerDestroyedVehicles($destroyed_confederates, $old_destroyed_confederates);
			}
			
			if (self::$_eventDirection == self::$_selectedPlayer)
			{
				if (self::$_isInc)
					$status = 2;
				else
					$status = 1;
			}
		}
		
		$battlePlayer->destroyed_enemies = $destroyed_enemies;
		$battlePlayer->destroyed_confederates = $destroyed_confederates;
		$battlePlayer->score = $destroyed_enemies - $destroyed_confederates;
		$battlePlayer->status = $status;
		
		if (!$battlePlayer->save())
			return false;
		
		return self::setPlayerScore($battlePlayer->player_id, $params);
	}
	
	public static function setPlayerScore($id, $params)
	{
		$player = Player::model()->findByPk($id);
		
		switch (self::$_eventType)
		{		
			case 1: if ($params)
					{
						$player->destroyed_enemies += self::calculatePlayerDestroyedVehicles($params['newValue'], $params['oldValue']);
					}
					
					break;
					
			case 2: if ($params)
					{
						$player->destroyed_confederates += self::calculatePlayerDestroyedVehicles($params['newValue'], $params['oldValue']);
					}
					
					break;
					
			case 3: if (self::$_isInc)
						$player->suicides++;
					else
						$player->suicides--;
					
				//	if ($player->suicides < 0)
				//		$player->suicides = 0;
					
					break;
		}
		
		$player->score = $player->destroyed_enemies
						- $player->destroyed_confederates
						- $player->suicides;
		
		return $player->save();
	}
	
	public static function calculateBattlePlayerDestroyedVehicles(&$destroyedVehicles, $oldDestroyedVehicles)
	{
		if (self::$_eventDirection != self::$_selectedPlayer)
		{
			if (self::$_isInc)
				$destroyedVehicles++;
			else
				$destroyedVehicles--;
		}
		
		return array('oldValue' => $oldDestroyedVehicles, 'newValue' => $destroyedVehicles);
	}
	
	public static function calculatePlayerDestroyedVehicles($newValue, $oldValue)
	{
		if (self::$_eventDirection != self::$_selectedPlayer)
		{
			$difference = abs($newValue - $oldValue);
			
			if ($newValue < $oldValue)
				$difference *= -1;
			
			return $difference;
		}
		
		return 0;
	}
}
