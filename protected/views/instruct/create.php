 <?php 
 $this->breadcrumbs=array(
	'Поручения'=>array('/instruct'),
	'Создать поручение',
);
?>

<h1>Создать поручение</h1> 

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'place-form',
	'enableAjaxValidation'=>false,
)); ?>


<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>128)); ?>

<?php 
$data = User::getListTree(); 
echo $form->dropDownListRow($model,'user_to_id', $data, array('class'=>'span5', 'empty'=>'--исполнитель--')); ?>

            <!-- -->
         <?php echo $form->labelEx($model,'deadline'); ?>
         <?php 
                        $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                            'model'=>$model,
                            'attribute'=>'deadline', 
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
         <?php echo $form->error($model,'deadline'); ?>
            
            <!-- -->

<?php
echo $form->labelEx($model, 'description');
$this->widget('bootstrap.widgets.TbHtml5Editor', array(
    'model'=>$model,
    'attribute'=>'description',
    'lang'=>'ru',
    
));
echo $form->error($model, 'description');
?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Создать',
		)); ?>
</div>

<?php $this->endWidget(); ?>