<?php

/**
 * This is the model class for table "{{battle}}".
 *
 * The followings are the available columns in table '{{battle}}':
 * @property integer $id
 * @property integer $genre_id
 * @property string $battle_date
 *
 * The followings are the available model relations:
 * @property Genre $genre
 * @property BattlePlayer[] $battle_players
 */
class Battle extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{battle}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('battle_date', 'unique',
					'message'=>Crud::getMessage('Дата боя', 'unique'),
			),
			array('genre_id, battle_date', 'required'),
			array('genre_id', 'numerical', 'integerOnly' => true),
			array('battle_date', 'date', 'format' => 'yyyy-MM-dd'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, genre_id, battle_date', 'safe', 'on'=>'search'),
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
			'genre' => array(self::BELONGS_TO, 'Genre', 'genre_id'),
			'battle_players' => array(self::HAS_MANY, 'BattlePlayer', 'battle_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'genre_id' => 'Genre',
			'battle_date' => 'Battle Date',
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
		$criteria->compare('genre_id',$this->genre_id,true);
		$criteria->compare('battle_date',$this->battle_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Battle the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
