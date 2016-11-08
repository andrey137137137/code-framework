<?php

/**
 * This is the model class for table "{{battle_event}}".
 *
 * The followings are the available columns in table '{{battle_event}}':
 * @property integer $id
 * @property integer $prev_event_id
 * @property integer $next_event_id
 * @property integer $teem1_score
 * @property integer $teem2_score
 * @property integer $battle_player1_id
 * @property integer $battle_player2_id
 * @property integer $event_type
 * @property integer $event_direction
 * @property integer $destruction_type_id
 *
 * The followings are the available model relations:
 * @property BattlePlayer $battle_player1
 * @property BattlePlayer $battle_player2
 * @property DestructionType $destruction_type
 */
class BattleEvent extends CActiveRecord
{
	public $cascadeSave = true;
	
	public $battleId;
	public $teem1Id;
	public $teem2Id;
	public $player1Id;
	public $player2Id;
	public $battlePlayer1Id;
	public $battlePlayer2Id;
	public $selectPrevEvent;
	public $selectEventType;
	public $selectDirectionEventType;
	
	public $old_prev_event_id;
	public $old_next_event_id;
	public $old_teem1_score;
	public $old_teem2_score;
	public $old_battle_player1_id;
	public $old_battle_player2_id;
	public $old_event_type;
	public $old_event_direction;
	public $old_destruction_type_id;
	
	public static $eventType = array(
									'1' => 'X>Y',
									'2' => 'X>X',
									'3' => 'X<',
								);
	
	public static $directionEventType = array(
									'-1' => '<--',
									'1' => '-->'
								);
	
	public static $events = array(
									'-3' => '<X--',
									'-2' => 'X---',
									'-1' => '<---',
									'1' => '--->',
									'2' => '---X',
									'3' => '--X>'
								);
	
	public static $separator = '|';
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{battle_event}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('battle_player1_id', 'CompositeUnique', 'keyColumns' => array('battle_player2_id')),
			array('battle_player1_id, battle_player2_id, event_type, event_direction, destruction_type_id', 'required'),
			array('prev_event_id, next_event_id, teem1_score, teem2_score, battle_player1_id, battle_player2_id, event_type, event_direction, destruction_type_id', 'numerical', 'integerOnly' => true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, prev_event_id, next_event_id, teem1_score, teem2_score, battle_player1_id, battle_player2_id, event_type, event_direction, destruction_type_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'battle_player1' => array(self::BELONGS_TO, 'BattlePlayer', 'battle_player1_id'),
			'battle_player2' => array(self::BELONGS_TO, 'BattlePlayer', 'battle_player2_id'),
			'destruction_type' => array(self::BELONGS_TO, 'DestructionType', 'destruction_type_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'prev_event_id' => 'Prev Event',
			'next_event_id' => 'Next Event',
			'teem1_score' => 'Teem1 Score',
			'teem2_score' => 'Teem2 Score',
			'battle_player1_id' => 'Battle Player1',
			'battle_player2_id' => 'Battle Player2',
			'event_type' => 'Event Type',
			'event_direction' => 'Event Direction',
			'destruction_type_id' => 'Destruction Type',
		);
	}

	/**
	 * This is invoked before the record is saved.
	 * @return boolean whether the record should be saved.
	 */
	protected function beforeSave()
	{
		if (!parent::beforeSave())
			return false;
		
		if ($this->isNewRecord)
			return true;
		
		if (!Crud::setScoresOfPlayers($this, false))
			return false;
		
		return true;
	}
	
	/**
	 * This is invoked after the record is saved.
	 */
	protected function afterSave()
	{
		parent::afterSave();
		
		if (!Crud::setScoresOfPlayers($this, true))
			return false;
		
		return true;
	}
	
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('prev_event_id',$this->prev_event_id,true);
		$criteria->compare('next_event_id',$this->next_event_id,true);
		$criteria->compare('teem1_score',$this->teem1_score,true);
		$criteria->compare('teem2_score',$this->teem2_score,true);
		$criteria->compare('battle_player1_id',$this->battle_player1_id,true);
		$criteria->compare('battle_player2_id',$this->battle_player2_id,true);
		$criteria->compare('event_type',$this->event_type,true);
		$criteria->compare('event_direction',$this->event_direction);
		$criteria->compare('destruction_type_id',$this->destruction_type_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Loads the lookup items for the specified type from the database.
	 * @param string the item type
	 */
	public static function allBattleEventItems($battleId)
	{
		$items = array(/*'Нет ссылки'*/);
		
		/*
			SELECT		`ourwot_battle_event`.`id`,
						`ourwot_battle_event`.`prev_event_id`,
						`ourwot_battle_event`.`next_event_id`,
						`ourwot_battle_event`.`teem1_score`,
						`ourwot_battle_event`.`teem2_score`,
						`ourwot_battle_event`.`battle_player1_id`,
						`ourwot_battle_event`.`battle_player2_id`,
						`ourwot_battle_event`.`event_type`,
						`ourwot_battle_event`.`event_direction`,
						`ourwot_battle_event`.`destruction_type_id`,
						`ourwot_battle`.`battle_date`
			FROM		`ourwot_battle_event`
						INNER JOIN `ourwot_battle_player`
						ON `ourwot_battle_event`.`battle_player1_id` = `ourwot_battle_player`.`id`
						INNER JOIN `ourwot_battle`
						ON `ourwot_battle_player`.`battle_id` = `ourwot_battle`.`id`
			WHERE		`ourwot_battle`.`id` = $battleId
			ORDER BY	`ourwot_battle_event`.`id` DESC
		
		
		$rows = Yii::app()->db->createCommand()
				->select('
							{{battle_event}}.id,
							{{battle_event}}.next_event_id,
							{{battle_event}}.teem1_score,
							{{battle_event}}.teem2_score,
							{{battle_event}}.battle_player1_id,
							{{battle_event}}.battle_player2_id,
							{{battle_event}}.event_type,
							{{battle_event}}.event_direction,
							{{battle_event}}.destruction_type_id,
							{{battle}}.battle_date
						')
				->from('{{battle_event}}')
				->join('{{battle_player}}',
						'{{battle_event}}.battle_player1_id = {{battle_player}}.id')
				->join('{{battle}}',
						'{{battle_player}}.battle_id = {{battle}}.id')
				->where('{{battle}}.id = :battleId', array(':battleId' => $battleId))
				->order('{{battle_event}}.id DESC')
				->queryAll();
		
		foreach($rows as $row)
		{
			$items[
					$row['id']
					. self::$separator . $row['next_event_id']
					. self::$separator . $row['teem1_score']
					. self::$separator . $row['teem2_score']
					. self::$separator . $row['battle_player1_id']
					. self::$separator . $row['battle_player2_id']
					. self::$separator . $row['event_type']
					. self::$separator . $row['event_direction']
					. self::$separator . $row['destruction_type_id']
				]
					= $row['battle_date'] . ' ' .
					$row['teem1_score'] . ' : ' . $row['teem2_score'];
		}
		*/
		
		$id = 0;
		
		do
		{
			$row = Yii::app()->db->createCommand()
					->select('
								{{battle_event}}.id,
								{{battle_event}}.next_event_id,
								{{battle_event}}.teem1_score,
								{{battle_event}}.teem2_score,
								{{battle_event}}.battle_player1_id,
								{{battle_event}}.battle_player2_id,
								{{battle_event}}.event_type,
								{{battle_event}}.event_direction,
								{{battle_event}}.destruction_type_id,
								{{battle}}.battle_date
							')
					->from('{{battle_event}}')
					->join('{{battle_player}}',
							'{{battle_event}}.battle_player1_id = {{battle_player}}.id')
					->join('{{battle}}',
							'{{battle_player}}.battle_id = {{battle}}.id')
					->where('{{battle}}.id = :battleId and
							 {{battle_event}}.prev_event_id = :eventId',
							 array(':battleId' => $battleId, ':eventId' => $id))
					/*->order('{{battle_event}}.id DESC')*/
					->queryRow();
					
			//var_dump($row);
			
			if (!$row)
				break;
			
			$id = $row['id'];
			
			$items[
					$row['id']
					. self::$separator . $row['next_event_id']
					. self::$separator . $row['teem1_score']
					. self::$separator . $row['teem2_score']
					. self::$separator . $row['battle_player1_id']
					. self::$separator . $row['battle_player2_id']
					. self::$separator . $row['event_type']
					. self::$separator . $row['event_direction']
					. self::$separator . $row['destruction_type_id']
				]
					= $row['battle_date'] . ' ' .
					$row['teem1_score'] . ' : ' . $row['teem2_score'];
		}
		while($row);
		
		return array_reverse($items, true);
	}
	
	/**
	 * Loads the lookup items for the specified type from the database.
	 * @param string the item type
	 */
	public static function eventDirectionItems()
	{
		$items = array();
		
		foreach(self::$directionEventType as $k => $v)
		{
			$items[$k] = htmlspecialchars_decode($v);
		}
		
		return $items;
	}
	
	/**
	 * Loads the lookup items for the specified type from the database.
	 * @param string the item type
	 */
	public static function battleEventItems($battleId, $isNextEvent = false)
	{
		$items = array(/*'Нет ссылки'*/);
		
		/*
			SELECT		`ourwot_battle_event`.`id`,
						`ourwot_battle`.`battle_date`,
						`ourwot_battle_event`.`teem1_score`,
						`ourwot_battle_event`.`teem2_score`
			FROM		`ourwot_battle_event`
						INNER JOIN `ourwot_battle_player`
						ON `ourwot_battle_event`.`battle_player1_id` = `ourwot_battle_player`.`id`
						INNER JOIN `ourwot_battle`
						ON `ourwot_battle_player`.`battle_id` = `ourwot_battle`.`id`
			WHERE		`ourwot_battle`.`id` = $battleId
			ORDER BY	`ourwot_battle_event`.`id` DESC
		*/
		
		$rows = Yii::app()->db->createCommand()
				->select('
							{{battle_event}}.id,
							{{battle}}.battle_date,
							{{battle_event}}.teem1_score,
							{{battle_event}}.teem2_score
						')
				->from('{{battle_event}}')
				->join('{{battle_player}}',
						'{{battle_event}}.battle_player1_id = {{battle_player}}.id')
				->join('{{battle}}',
						'{{battle_player}}.battle_id = {{battle}}.id')
				->where('{{battle}}.id = :battleId', array(':battleId' => $battleId))
				->order('{{battle_event}}.id DESC')
				->queryAll();
		
		foreach($rows as $row)
		{
		//	var_dump($row['battle_id']);
			$items[$row['id']] = $row['battle_date'] . ' ' . $row['teem1_score'] . ' : ' . $row['teem2_score'];
		}
		
		return $items;
	}
	
	/**
	 * Loads the lookup items for the specified type from the database.
	 * @param string the item type
	 */
	public static function playerItems($battleId)
	{
		$items = array();
		
		/*
			SELECT		`ourwot_battle_player`.`id`,
						`ourwot_battle_player`.`battle_id`,
						`ourwot_battle_player`.`teem_id`,
						`ourwot_battle_player`.`player_id`,
						`ourwot_battle`.`battle_date`,
						`ourwot_player`.`title`
			FROM		`ourwot_battle_player`
						INNER JOIN `ourwot_battle`
						ON `ourwot_battle_player`.`battle_id` = `ourwot_battle`.`id`,
						`ourwot_battle_player`
						INNER JOIN `ourwot_player`
						ON `ourwot_battle_player`.`player_id` = `ourwot_player`.`id`	
			WHERE		`ourwot_battle`.`id` = $battleId
			ORDER BY	`ourwot_battle_player`.`battle_id` DESC, `ourwot_player`.`title`
		*/
		
		$rows = Yii::app()->db->createCommand()
				->select('
							{{battle_player}}.id,
							{{battle_player}}.battle_id,
							{{battle_player}}.teem_id,
							{{battle_player}}.player_id,
							{{battle}}.battle_date,
							{{player}}.title
						')
				->from('{{battle_player}}')
				->join('{{battle}}',
						'{{battle_player}}.battle_id = {{battle}}.id')
				->join('{{player}}',
						'{{battle_player}}.player_id = {{player}}.id')
				->where('{{battle}}.id = :battleId', array(':battleId' => $battleId))
		//		->where('{{battle_player}}.status = 1')
				->order('{{battle_player}}.battle_id DESC, {{player}}.title')
				->queryAll();
		
		foreach($rows as $row)
		{
			$items[
					$row['id'] 
					. self::$separator . $row['battle_id']
					. self::$separator . $row['teem_id']
					. self::$separator . $row['player_id']
				] = $row['battle_date'] . ':   ' . $row['title'];
		}
		
		return $items;
	}
	
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BattleEvent the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
