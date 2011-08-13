<ul>
	<?php foreach($this->getRecentComments() as $comment): ?>
		<li>
			<?php echo $comment->authorLink; ?>
			<?php echo Yii::t('main','on');echo CHtml::link(CHtml::encode($comment->post->title),$comment->getUrl()); ?>
		</li>
	<?php endforeach;?>
<ul>
