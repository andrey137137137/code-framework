<?php

/**
 * This is the model class for table "{{battle_player}}".
 *
 * The followings are the available columns in table '{{battle_player}}':
 * @property integer $id
 * @property integer $battle_id
 * @property integer $teem_id
 * @property integer $player_id
 * @property integer $destroyed_enemies
 * @property integer $destroyed_confederates
 * @property integer $score
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property BattleEvent[] $battle_events_for_player1
 * @property BattleEvent[] $battle_events_for_player2
 * @property Battle $battle
 * @property Teem $teem
 * @property Player $player
 */
class BattlePlayer extends CActiveRecord
{
	public static $status = array(
									'1' => 'Survived',
									'2' => 'Suicide',
									'3' => 'Killed'
								);
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{battle_player}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		//	array('name, email', 'safe'),
		//	array('name', 'CompositeUnique', 'keyColumns' => array('email')),
		//	array('id, name, description, create_time, create_user_id, update_time, update_user_id', 'safe', 'on'=>'search'),
			
			array('battle_id', 'CompositeUnique', 'keyColumns' => array('player_id')),
			array('battle_id, teem_id, player_id', 'required'),
			array('battle_id, teem_id, player_id, destroyed_enemies, destroyed_confederates, score, status', 'numerical', 'integerOnly' => true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, battle_id, teem_id, player_id, destroyed_enemies, destroyed_confederates, score, status', 'safe', 'on'=>'search'),
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
			'battle_events_for_player1' => array(self::HAS_MANY, 'BattleEvent', 'battle_player1_id'),
			'battle_events_for_player2' => array(self::HAS_MANY, 'BattleEvent', 'battle_player2_id'),
			'battle' => array(self::BELONGS_TO, 'Battle', 'battle_id'),
			'teem' => array(self::BELONGS_TO, 'Teem', 'teem_id'),
			'player' => array(self::BELONGS_TO, 'Player', 'player_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'battle_id' => 'Battle',
			'teem_id' => 'Teem',
			'player_id' => 'Player',
			'destroyed_enemies' => 'Destroyed Enemies',
			'destroyed_confederates' => 'Destroyed Confederates',
			'score' => 'Score',
			'status' => 'Status',
		);
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
	public function search($pagination = null)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		
		$criteria->compare('id',$this->id,true);
		$criteria->compare('battle_id',$this->battle_id/*,true*/);
		$criteria->compare('teem_id',$this->teem_id/*,true*/);
		$criteria->compare('player_id',$this->player_id,true);
		$criteria->compare('destroyed_enemies',$this->destroyed_enemies,true);
		$criteria->compare('destroyed_confederates',$this->destroyed_confederates,true);
		$criteria->compare('score',$this->score);
		$criteria->compare('status',$this->status,true);
		
		$criteria->order = 'score DESC,
							destroyed_enemies DESC,
							destroyed_confederates ASC,
							status ASC';
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>$pagination
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BattlePlayer the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
