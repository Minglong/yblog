<?php $this->pageTitle=Yii::t('main','{appname}',array('{appname}'=>Yii::app()->name)); ?>

<?php
	$this->widget('MyPortlet',array(
		'maxPosts'=>1,
		'type'=>'block',
	));
?>
