<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'work-deviation-form',
	'enableAjaxValidation'=>false,
)); ?>
<p class="help-block">Поля с <span class="required">*</span> обязательные.</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'charcode',array('class'=>'span1','maxlength'=>2)); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>128)); ?>

	<?php echo $form->checkBoxRow($model,'work_time',array('class'=>'')); ?>
        <p>Если время является рабюочим (командировка)</p>
	<?php echo $form->colorpickerRow($model,'color',array('class'=>'span2','maxlength'=>8)); ?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ?  'Создать' : 'Сохранить',
		)); ?>
</div>

<?php $this->endWidget(); ?>
