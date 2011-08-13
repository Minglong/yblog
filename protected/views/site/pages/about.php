<?php
$this->pageTitle=Yii::app()->name . ' - About';
//$this->breadcrumbs=array(
	//'About',
//);
?>
<h1>About</h1>
<?php
	$this->widget('MyPortlet',array(
		'maxPosts'=>1,
		'type'=>'block',
		'blocktitle'=>'aboutus',
	));
?>
