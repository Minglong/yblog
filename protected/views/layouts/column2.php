<?php $this->beginContent('//layouts/main'); ?>
<div class="container">
	<div class="span-19">
		<div id="content">
			<?php echo $content; ?>
		</div><!-- content -->
	</div>
	<div class="span-5 last">
		<div id="sidebar">
		<?php
			if(!Yii::app()->user->isGuest){
				$this->widget('UserMenu',array(
					'title'=>Yii::t('main','Hello,{username}',array('{username}'=>CHtml::encode(Yii::app()->user->name))),
			));
			}
		?>
		<?php
			$this->widget('TagCloud',array(
				'maxTags'=>Yii::app()->params['tagCloudCount'],
				'title'=>Yii::t('main','Tags'),
			));
		?>
		<?php
			$this->widget('RecentComments',array(
				'maxComments'=>Yii::app()->params['recentCommentCount'],
				'title'=>Yii::t('main','Recent Comment'),
			));
		?>
		<?php
			if(!Yii::app()->user->isGuest){
				$this->widget('UserMenu',array(
					'title'=>Yii::t('main','Hello,{username}',array('{username}'=>CHtml::encode(Yii::app()->user->name))),
					'type'=>'admin',
			));
			}
		?>
		</div><!-- sidebar -->
	</div>
</div>
<?php $this->endContent(); ?>
