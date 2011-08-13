<?php
Yii::import('zii.widgets.CPortlet');

class UserMenu extends CPortlet{
	var $type='common';
	public function renderContent(){
		$this->render('userMenu');
	}
}
?>
