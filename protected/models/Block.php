<?php

/**
 * This is the model class for table "{{block}}".
 *
 * The followings are the available columns in table '{{block}}':
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property interger $sort
 * @property integer $status
 * @property string $dscription
 * @property string $create_time
 * @property string $update_time
 */
class Block extends CActiveRecord
{
	const STATUS_DRAFT=1;
	const STATUS_PUBLISHED=2;
	const STATUS_DISABLE=3;
	/**
	 * Returns the static model of the specified AR class.
	 * @return Block the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{block}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, content, status', 'required'),
			array('title', 'length', 'max'=>60),
			array('status', 'in', 'range'=>array(1,2,3)),
			array('sort', 'in', 'range'=>range(0,50)),
			array('dscription', 'length', 'max'=>255),
			array('create_time, update_time', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('title, content, status, dscription, create_time, update_time', 'safe', 'on'=>'search'),
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
			'content' => 'Content',
			'sort' => 'Sort',
			'status' => 'Status',
			'dscription' => 'Dscription',
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('dscription',$this->dscription,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	protected function beforeSave(){
		if(parent::beforeSave()){
			if($this->isNewRecord){
				$this->create_time=$this->update_time=time();
				$this->author_id=Yii::app()->user->id;
			}else{
				$this->update_time=time();
			}
			$this->sort=$this->sort?$this->sort:0;
			return true;

		}else{
			return false;
		}
	}
	public function getDatas($limit=10,$title=null){
		$findtitle=$title?' and t.title="'.$title.'"':'';
		return $this->findAll(
			array(
				'condition'=>'t.status='.self::STATUS_PUBLISHED.$findtitle,
				'order'=>'t.create_time DESC',
				'limit'=>$limit,
			));
	}
}
