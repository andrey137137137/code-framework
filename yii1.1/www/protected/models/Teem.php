<?php

/**
 * This is the model class for table "{{teem}}".
 *
 * The followings are the available columns in table '{{teem}}':
 * @property integer $id
 * @property string $title
 * @property integer $victories
 * @property integer $draws
 * @property integer $losses
 * @property integer $score
 *
 * The followings are the available model relations:
 * @property BattleEvent[] $battle_events_for_teem1
 * @property BattleEvent[] $battle_events_for_teem2
 * @property BattlePlayer[] $battle_players
 */
class Teem extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{teem}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title', 'unique',
					'message' => Crud::getMessage('Имя комманды', 'unique'),
			),
			array('title', 'required'),
			array('title', 'length', 'max' => 77),
			array('victories, draws, losses, score', 'numerical', 'integerOnly' => true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, victories, draws, losses, score', 'safe', 'on' => 'search'),
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
			'battle_events_for_teem1' => array(self::HAS_MANY, 'BattleEvent', 'teem2_id'),
			'battle_events_for_teem2' => array(self::HAS_MANY, 'BattleEvent', 'teem1_id'),
			'battle_players' => array(self::HAS_MANY, 'BattlePlayer', 'teem_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'victories' => 'Victories',
			'draws' => 'Draws',
			'losses' => 'Losses',
			'score' => 'Score',
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('victories',$this->victories,true);
		$criteria->compare('draws',$this->draws,true);
		$criteria->compare('losses',$this->losses,true);
		$criteria->compare('score',$this->score);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Teem the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
