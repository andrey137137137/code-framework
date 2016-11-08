<?php

/**
 * This is the model class for table "{{player}}".
 *
 * The followings are the available columns in table '{{player}}':
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $vehicle_id
 * @property integer $photo_id
 * @property integer $victories
 * @property integer $draws
 * @property integer $losses
 * @property integer $teem_score
 * @property integer $destroyed_enemies
 * @property integer $destroyed_confederates
 * @property integer $suicides
 * @property integer $score
 *
 * The followings are the available model relations:
 * @property BattlePlayer[] $battle_players
 * @property Photo $photo
 * @property Vehicle $vehicle
 */
class Player extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{player}}';
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
					'message' => Crud::getMessage('Имя игрока', 'unique'),
			),
			array('title, vehicle_id', 'required'),
			array('title', 'length', 'max' => 57),
			array('description', 'safe'),
			array('vehicle_id, photo_id, victories, draws, losses, teem_score, destroyed_enemies, destroyed_confederates, suicides, score', 'numerical', 'integerOnly' => true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, description, vehicle_id, photo_id, victories, draws, losses, teem_score, destroyed_enemies, destroyed_confederates, suicides, score', 'safe', 'on' => 'search'),
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
			'battle_players' => array(self::HAS_MANY, 'BattlePlayer', 'player_id'),
			'photo' => array(self::BELONGS_TO, 'Photo', 'photo_id'),
			'vehicle' => array(self::BELONGS_TO, 'Vehicle', 'vehicle_id'),
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
			'description' => 'Description',
			'vehicle_id' => 'Vehicle',
			'photo_id' => 'Photo',
			'victories' => 'Victories',
			'draws' => 'Draws',
			'losses' => 'Losses',
			'teem_score' => 'Teem Score',
			'destroyed_enemies' => 'Destroyed Enemies',
			'destroyed_confederates' => 'Destroyed Confederates',
			'suicides' => 'Suicides',
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
		$criteria->compare('description',$this->description,true);
		$criteria->compare('vehicle_id',$this->vehicle_id,true);
		$criteria->compare('photo_id',$this->photo_id,true);
		$criteria->compare('victories',$this->victories,true);
		$criteria->compare('draws',$this->draws,true);
		$criteria->compare('losses',$this->losses,true);
		$criteria->compare('teem_score',$this->teem_score);
		$criteria->compare('destroyed_enemies',$this->destroyed_enemies,true);
		$criteria->compare('destroyed_confederates',$this->destroyed_confederates,true);
		$criteria->compare('suicides',$this->suicides,true);
		$criteria->compare('score',$this->score);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Player the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
