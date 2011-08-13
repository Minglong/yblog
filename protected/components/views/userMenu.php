<ul>
<?php if($this->type==='common'): ?>
	<li><?php echo CHtml::link(Yii::t('main','Create New Post'),array('post/create')); ?></li>
	<li><?php echo CHtml::link(Yii::t('main','Manage Posts'),array('post/admin')); ?></li>
	<li><?php echo CHtml::link(Yii::t('main','Approve Comments'),array('comment/index')).' ('.Comment::model()->pendingCommentCount.' )'; ?></li>
	<li><?php echo CHtml::link(Yii::t('main','Logout'),array('site/Logout')); ?></li>
<?php elseif($this->type==='admin'): ?>
	<li><?php echo CHtml::link(Yii::t('main','Create New Block'),array('block/create')); ?></li>
	<li><?php echo CHtml::link(Yii::t('main','Manage block'),array('block/admin')); ?></li>
<?php endif; ?>
</ul>

