<div class="post">
	<div class="title">
		<?php echo CHtml::link(CHtml::encode($data->title),$data->url); ?>
	</div>
	<div class="author">
		<?php echo CHtml::link(Yii::t('main','edit'),$data->getUrl('update')); ?>	posted by <?php echo $data->author->username.' on '.date('F j,Y',$data->create_time); ?>
	</div>
	<div class="content">
		<?php 
			$this->beginWidget('CMarkdown',array('purifyOutput'=>true));
			echo highlight_string($data->content);
			echo htmlspecialchars($data->content);
			echo $data->content;
			echo 'abc';
			$this->endWidget();
			$this->beginWidget('CTextHighlighter',array('showLineNumbers'=>true,'language'=>'php'));
			echo $data->content;
			$this->endWidget();
		?>
	</div>
	<div class='nav'>
	<b><?php echo Yii::t('main','Tags')?>:</b>
		<?php echo implode(',',$data->tagLinks); ?>
		<br />
			<?php echo CHtml::link(Yii::t('main','Permalink'),$data->url); ?> |
			<?php echo CHtml::link(Yii::t('main',"Comments ({commentcount})",array('{commentcount}'=>$data->commentCount)),$data->url.'#comments'); ?> |
			Last updated on <?php echo date('F j,Y',$data->update_time); ?>
	</div>
	
</div>
