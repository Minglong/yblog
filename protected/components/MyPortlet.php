<?php

Yii::import('zii.widgets.CPortlet');

class MyPortlet extends CPortlet{

	public $maxPosts=10;
	public $type='post';
	public $blocktitle='test';


	public function getDatas(){
		if($this->type==='post'){
			return Post::model()->findRecentPosts($this->maxPosts);
		}elseif($this->type==='block'){
			return Block::model()->getDatas($this->maxPosts,$this->blocktitle);
		}
	}

	protected function renderContent(){
		return $this->render('myportlet');
	}
}

?>
