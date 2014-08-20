<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'documents-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

<p class="help-block">Поля с <span class="required">*</span> обязательные для заполнения.</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->dropDownListRow($model,'type', Documents::getTypes(), array('class'=>'span5')); ?>

 

	<?php echo $form->textFieldRow($model,'description',array('class'=>'span5','maxlength'=>128)); ?>

	
	<?php echo $form->checkBoxRow($model,'typedata',array()); ?>
	
	
	
	<?php echo $form->fileFieldRow($model,'url',array()); ?>
	<?php echo $form->hiddenField($model,'url'); ?>
	<?php echo $form->textAreaRow($model,'url',array('cols'=>60, 'rows'=>2, 'id'=>'Documents_url_text',)); ?>
	
	<br/>

	<?php if($model->isFileExists()) {
		echo CHtml::link($model->url, $model->getDownloadLink(), array('target'=>'_blank'));
	}?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Создать' : 'Сохранить',
		)); ?>
</div>

<?php $this->endWidget(); ?>

<script type="text/javascript">
$(function(){
	$('#Documents_typedata').change(function(){
		if(this.checked) {
			$('#Documents_url').prop('disabled', true);
			$('#Documents_url_text').prop('disabled', false);
		} else {
			$('#Documents_url').prop('disabled', false);
			$('#Documents_url_text').prop('disabled', true);
		}
	}).trigger('change');
});
</script>
