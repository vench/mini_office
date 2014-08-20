<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Поля с <span class="required">*</span> обязательные.</p>

<?php echo $form->errorSummary($model);  ?>


<?php echo $form->dropDownListRow($model,'deviation_id',CHtml::listData(WorkDeviation::model()->findAll(), 'id', 'name' ),array('class'=>'span5','empty'=>'-------')); ?>


<?php echo $form->labelEx($model,'datestart'); ?>
         <?php 
                        $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                            'model'=>$model,
                            'attribute'=>'datestart', 
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
         <?php echo $form->error($model,'datestart'); ?>


<?php echo $form->labelEx($model,'dateend'); ?>
         <?php 
                        $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                            'model'=>$model,
                            'attribute'=>'dateend', 
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
         <?php echo $form->error($model,'dateend'); ?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Создать' : 'Сохранить',
		)); ?>
</div>

<?php $this->endWidget(); ?>