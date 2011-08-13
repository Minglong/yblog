<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'block-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>


	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>60)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php $this->widget('application.extensions.ckeditor3.CKEditor', array(
		'model'=>$model,
		'attribute'=>'content',
		'language'=>'zh-cn',
		'editorTemplate'=>'full',
		)); ?>
		<?php echo $form->error($model,'content'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sort'); ?>
		<?php echo $form->textField($model,'sort',array('size'=>15,'max-length'=>'10')); ?>
		<?php echo $form->error($model,'sort'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropDownList($model,'status',Lookup::items('BlockStatus')); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dscription'); ?>
		<?php echo $form->textField($model,'dscription',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'dscription'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
