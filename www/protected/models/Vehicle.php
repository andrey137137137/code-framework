<?php

/**
 * This is the model class for table "{{vehicle}}".
 *
 * The followings are the available columns in table '{{vehicle}}':
 * @property integer $id
 * @property string $title
 * @property integer $level_id
 * @property integer $caliber_id
 * @property integer $vehicle_type_id
 * @property integer $country_id
 * @property integer $photo_id
 *
 * The followings are the available model relations:
 * @property Player[] $players
 * @property VehicleType $vehicle_type
 * @property Caliber $caliber
 * @property Country $country
 * @property Photo $photo
 * @property Level $level
 */
class Vehicle extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{vehicle}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title', 'CompositeUnique', 'keyColumns' => array('country_id')),
			array('title, level_id, caliber_id, vehicle_type_id, country_id', 'required'),
			array('title', 'length', 'max' => 57),
			array('level_id, caliber_id, vehicle_type_id, country_id, photo_id', 'numerical', 'integerOnly' => true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, level_id, caliber_id, vehicle_type_id, country_id, photo_id', 'safe', 'on' => 'search'),
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
			'players' => array(self::HAS_MANY, 'Player', 'vehicle_id'),
			'vehicle_type' => array(self::BELONGS_TO, 'VehicleType', 'vehicle_type_id'),
			'caliber' => array(self::BELONGS_TO, 'Caliber', 'caliber_id'),
			'country' => array(self::BELONGS_TO, 'Country', 'country_id'),
			'photo' => array(self::BELONGS_TO, 'Photo', 'photo_id'),
			'level' => array(self::BELONGS_TO, 'Level', 'level_id'),
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
			'level_id' => 'Level',
			'caliber_id' => 'Caliber',
			'vehicle_type_id' => 'Vehicle Type',
			'country_id' => 'Country',
			'photo_id' => 'Photo',
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
		$criteria->compare('level_id',$this->level_id,true);
		$criteria->compare('caliber_id',$this->caliber_id,true);
		$criteria->compare('vehicle_type_id',$this->vehicle_type_id,true);
		$criteria->compare('country_id',$this->country_id,true);
		$criteria->compare('photo_id',$this->photo_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Vehicle the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
