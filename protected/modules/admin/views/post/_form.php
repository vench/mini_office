<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'post-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Поля с <span class="required">*</span> обязательные.</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->dropDownListRow($model,'parent_id', CHtml::listData(Post::model()->findAll(), 'id', 'name'), array('class'=>'span5', 'empty'=>'-------')); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>32)); ?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Создать' : 'Сохранить',
		)); ?>
</div>

<?php $this->endWidget(); ?>
