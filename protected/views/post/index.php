<?php
$this->breadcrumbs=array(
	'Posts',
);

//$this->menu=array(
	//array('label'=>'Create Post', 'url'=>array('create')),
	//array('label'=>'Manage Post', 'url'=>array('admin')),
//);
?>
<?php if(isset($_GET['tag'])&&!empty($_GET['tag'])): ?>
	<h1><?php echo Yii::t('main','Posts Tagged with'); ?> <i><?php echo CHtml::encode($_GET['tag']); ?></i></h1>

<?php endif; ?>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'template'=>"{items}\n{pager}",
)); ?>
<?php
	//$this->widget('CLinkPager',array(
		//'dataProvider'=>$dataProvider,
	//));
?>
