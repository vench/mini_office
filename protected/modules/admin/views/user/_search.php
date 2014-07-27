<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
));  ?>
 

		<?php echo $form->dropDownListRow($model,'post_id', $postsList, array('class'=>'span5', 'empty'=>'-------',)); ?>

		<?php echo $form->dropDownListRow($model,'subdivision_id',$subdivisionList,array('class'=>'span5', 'empty'=>'-------',)); ?>

	 

		<?php echo $form->textFieldRow($model,'login',array('class'=>'span5','maxlength'=>64)); ?>

		<?php echo $form->textFieldRow($model,'email',array('class'=>'span5','maxlength'=>64)); ?>

		<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>100)); ?>

		<?php echo $form->textFieldRow($model,'patronymic',array('class'=>'span5','maxlength'=>100)); ?>

		<?php echo $form->textFieldRow($model,'surname',array('class'=>'span5','maxlength'=>100)); ?>

		<?php echo $form->textFieldRow($model,'phone',array('class'=>'span5','maxlength'=>64)); ?>

 

		<?php echo $form->dropDownListRow($model,'actual', Utill::getYesNo(), array('class'=>'span5', 'empty'=>'-------',)); ?>

		<?php echo $form->dropDownListRow($model,'is_super_admin', Utill::getYesNo(), array('class'=>'span5', 'empty'=>'-------',)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Поиск',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
