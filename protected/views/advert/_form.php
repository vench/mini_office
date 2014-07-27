<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'advert-form',
	'enableAjaxValidation'=>false,
)); ?>
<p class="help-block">Поля с <span class="required">*</span> обязательные.</p>

<?php echo $form->errorSummary($model); ?>

         <?php echo $form->labelEx($model,'dateadv'); ?>
         <?php 
                        $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                            'model'=>$model,
                            'attribute'=>'dateadv', 
                            'language'=>'ru',
                            'defaultOptions'=>array(
                                'showAnim'=>'fold',
                                'format'=>'dd.mm.yyyy',
                            ),
                            'htmlOptions'=>array(
                                'class'=>'g-2'
                            ),
                        ));

          ?>
         <?php echo $form->error($model,'dateadv'); ?>

<?php echo $form->timepickerRow($model,'timeadv',array(
            'class'=>'span5', 
            'options'=>array(
                'disableFocus' => true, // mandatory
                'showMeridian' => false // irrelevant
        ))); ?>

<?php
echo $form->labelEx($model, 'advert');
$this->widget('bootstrap.widgets.TbHtml5Editor', array(
    'model'=>$model,
    'attribute'=>'advert',
    'lang'=>'ru',
    
));
?>

<?php echo $form->checkBoxRow($model,'important',array('class'=>'')); ?>
        <p>Будет выведен на главной странице</p>
        
        
<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ?  'Создать' : 'Сохранить',
		)); ?>
</div>

<?php $this->endWidget(); ?>