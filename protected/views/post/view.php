<?php
$this->breadcrumbs=array(
	$model->title,
);

$this->pageTitle=$model->title;
?>
<?php 
$this->renderPartial('_view',array(
	'data'=>$model,
)); ?>

<div id='comments' >
	<?php if($model->commentCount>=1): ?>
		<h3>
			<?php echo $model->commentCount>1?$model->commentCount.' comments':'One Comment'; ?>
		</h3>
		<?php $this->renderPartial('_comments',array(
			'post'=>$model,
			'comments'=>$model->comments,
		)); ?>
	<?php endif; ?> 
<h3><?php echo  ($model->status!=POST::STATUS_NOCOMMENT)?Yii::t('post','Leave a comment'):Yii::t('post','comment is disable'); ?></h3>
	<?php if(Yii::app()->user->hasFlash('commentSubmitted')): ?>
		<div class='flash-success'>
			<?php echo Yii::app()->user->getFlash('commentSubmitted'); ?>
		</div>
	<?php else: ?> 
		<?php if($model->status!=POST::STATUS_NOCOMMENT): ?>
			<?php $this->renderPartial('/comment/_form',array(
				'model'=>$comment,
			)); ?>
		<?php endif; ?> 
	<?php endif; ?> 
</div>
