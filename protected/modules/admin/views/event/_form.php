<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'event-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Поля с <span class="required">*</span> обязательные.</p>

<?php echo $form->errorSummary($model); ?>
 
        <?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>128)); ?>


	<?php echo $form->dropDownListRow($model,'place_id', CHtml::listData(Place::model()->findAll(), 'id', 'name'),array('class'=>'span5','empty'=>'-------',)); ?>

	<?php echo $form->dropDownListRow($model,'type_event_id', CHtml::listData(EventType::model()->findAll(), 'id', 'name'), array('class'=>'span5','empty'=>'-------',)); ?>


         <?php echo $form->labelEx($model,'dateevent'); ?>
         <?php 
                        $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                            'model'=>$model,
                            'attribute'=>'dateevent', 
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
         <?php echo $form->error($model,'dateevent'); ?>
   <?php echo $form->labelEx($model,'dateevent2'); ?>
         <?php 
                        $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                            'model'=>$model,
                            'attribute'=>'dateevent2', 
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
         <?php echo $form->error($model,'dateevent2'); ?>
 

	<?php echo $form->timepickerRow($model,'timestart',array(
            'class'=>'span5', 
            'options'=>array(
                'disableFocus' => true, // mandatory
                'showMeridian' => false // irrelevant
        ))); ?>

	<?php echo $form->timepickerRow($model,'timeend',array(
            'class'=>'span5', 
            'options'=>array(
                'disableFocus' => true, // mandatory
                'showMeridian' => false // irrelevant
        ))); ?>

	<?php echo $form->checkBoxRow($model,'cyclic',array('class'=>'')); ?>
<p>Будет повторяться каждую неделю с даты установки</p>
<?php echo $form->checkBoxRow($model,'show_all',array('class'=>'')); ?>


	
	<?php echo $form->redactorRow($model,'description',array(
                'rows'=>6, 
                'cols'=>50, 
                'class'=>'', 
               )); ?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Создать' : 'Сохранить',
		)); ?>
</div>

<?php $this->endWidget(); ?>
