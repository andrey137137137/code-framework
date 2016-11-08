<?php

/**
 * This is the model class for table "{{destruction_type}}".
 *
 * The followings are the available columns in table '{{destruction_type}}':
 * @property integer $id
 * @property string $title
 *
 * The followings are the available model relations:
 * @property BattleEvent[] $battle_events
 */
class DestructionType extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{destruction_type}}';
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
					'message'=>Crud::getMessage('Тип разрушения', 'unique'),
			),
			array('title', 'required'),
			array('title', 'length', 'max'=>27),
			array('title', 'filter', 'filter'=>array('Crud', 'trim')),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title', 'safe', 'on'=>'search'),
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
			'battle_events' => array(self::HAS_MANY, 'BattleEvent', 'destruction_type_id'),
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

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
/*
	public function uniqueTitle($attribute, $params)
	{
		if(!$this->hasErrors())
		{
			$params['criteria'] = array(
											'condition'=>"title=:value", 
											'params'=>array(':value' => $this->title),
										);
			
			$validator = CValidator::createValidator('unique', $this, $attribute, $params);
			$validator->validate($this);
		}
	}
*/	
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DestructionType the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
