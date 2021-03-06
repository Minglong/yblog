<?php

/**
 * This is the model class for table "{{post}}".
 *
 * The followings are the available columns in table '{{post}}':
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $tags
 * @property integer $status
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $author_id
 */
class Post extends CActiveRecord
{
	const STATUS_DRAFT=1;
	const STATUS_PUBLISHED=2;
	const STATUS_ARCHIVED=3;
	const STATUS_NOCOMMENT=4;

	private $_oldTags;
	/**
	 * Returns the static model of the specified AR class.
	 * @return Post the static model class
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
		return '{{post}}';
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
			array('title', 'length','min'=>'3','max'=>128),
			array('status', 'in', 'range'=>array(1,2,3,4)),
			array('tags', 'match','pattern'=>'/^[\w\s,]+$/','message'=>'Tages can only contain word characters.'),
			array('tags','normalizeTags'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('title,status', 'safe', 'on'=>'search'),
		);
	}
	public function normalizeTags($attribute,$params){
		$this->tags=Tag::array2string(array_unique(Tag::string2array($this->tags)));
	}

	/**
	 * @return array relational rules.
	 */
	public function relations(){
		return array(
			'author'=>array(self::BELONGS_TO,'User','author_id'),
			'comments'=>array(self::HAS_MANY,'Comment','post_id'
				,'condition'=>'comments.status='.Comment::STATUS_APPROVED,
				'order'=>'comments.create_time DESC'),
			'commentCount'=>array(self::STAT,'Comment','post_id',
				'condition'=>'status='.Comment::STATUS_APPROVED),
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
			'tags' => 'Tags',
			'status' => 'Status',
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
			'author_id' => 'Author',
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
		$criteria->compare('tags',$this->tags,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('create_time',$this->create_time);
		$criteria->compare('update_time',$this->update_time);
		$criteria->compare('author_id',$this->author_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function getUrl($option='view'){
		return Yii::app()->createUrl('post/'.$option,array(
			'id'=>$this->id,
			'title'=>$this->title,
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
			return true;

		}else{
			return false;
		}
	}
	protected function afterSave(){
		parent::afterSave();
		Tag::model()->updateFrequency($this->_oldTags,$this->tags);
	}

	protected function afterFind(){
		parent::afterFind();
		$this->_oldTags=$this->tags;
	}

	protected function afterDelete(){
		parent::afterDelete();
		Comment::model()->deleteAll('post_id='.$this->id);
		Tag::model()->updateFrequency($this->tags,'');
	}

    	/**
	 * Adds a new comment to this post.
	 * This method will set status and post_id of the comment accordingly.
	 * @param Comment the comment to be added
	 * @return boolean whether the comment is saved successfully
	 */
	public function addComment($comment){
		if(Yii::app()->params['commentNeedApproval'])
			$comment->status=Comment::STATUS_PENDING;
		else
			$comment->status=Comment::STATUS_APPROVED;
		$comment->post_id=$this->id;
		return $comment->save();
	}

	public function getTagLinks(){
		$links=array();
		foreach(Tag::string2array($this->tags) as $tag){
			$links[]=CHtml::link(CHtml::encode($tag),array('post/index','tag'=>$tag));
		}
		return $links;
	}

	public function findRecentPosts($limit=10){
		return $this->findAll(
			array(
				'condition'=>'t.status>'.POST::STATUS_DRAFT,
				'order'=>'t.create_time DESC',
				'limit'=>$limit,
			));
	}


}
