<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
 

		<?php echo $form->textFieldRow($model,'id',array('class'=>'span2')); ?>

		<?php echo $form->dropDownListRow($model,'user_id',$userList,array('class'=>'span5','empty'=>'-------')); ?>

		<?php echo $form->dropDownListRow($model,'place_id',$placeList,array('class'=>'span5','empty'=>'-------')); ?>

		<?php echo $form->dropDownListRow($model,'type_event_id',$typeList,array('class'=>'span5','empty'=>'-------')); ?>

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

		 
		 

		<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>128)); ?>

		<?php echo $form->textAreaRow($model,'description',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Поиск',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
