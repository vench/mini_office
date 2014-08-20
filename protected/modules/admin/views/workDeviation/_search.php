<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

		<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'charcode',array('class'=>'span5','maxlength'=>2)); ?>

		<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>128)); ?>

		<?php echo $form->textFieldRow($model,'work_time',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'color',array('class'=>'span5','maxlength'=>8)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
