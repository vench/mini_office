<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'routine-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Поля с <span class="required">*</span> обязательные для заполнения.</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->checkBoxRow($model,'for_all',array('class'=>'')); ?>

	<?php echo $form->timepickerRow($model,'starttime',array(
		'class'=>'span5',
		'options'=>array(
			'language'=> 'ru',
			'showSeconds'=>false,
			'showMeridian'=>false,
		),
	)); ?>

	<?php echo $form->timepickerRow($model,'endtime',array(
		'class'=>'span5',
		'options'=>array(
			'language'=> 'ru',
			'showSeconds'=>false,
			'showMeridian'=>false,
		),
	)); ?>

	<?php echo $form->dropDownListRow($model, 'user_id', User::getListTree(), array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>128)); ?>

	<?php echo $form->textAreaRow($model,'description',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Создать' : 'Сохранить',
		)); ?>
</div>

<?php $this->endWidget(); ?>
