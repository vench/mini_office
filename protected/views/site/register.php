<?php
$this->pageTitle = 'Регистрация ' ;
$this->breadcrumbs = array('Регистрация ' );
?>

<h1>Регистрация</h1>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'event-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Поля с <span class="required">*</span> обязательные.</p>
<?php echo $form->errorSummary($model);  ?>

<fieldset>
<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>128)); ?>
<?php echo $form->textFieldRow($model,'patronymic',array('class'=>'span5','maxlength'=>128)); ?>
<?php echo $form->textFieldRow($model,'surname',array('class'=>'span5','maxlength'=>128)); ?>
<?php echo $form->textFieldRow($model,'phone',array('class'=>'span5','maxlength'=>64)); ?>
            <!-- -->
         <?php echo $form->labelEx($model,'dateborn'); ?>
         <?php 
                        $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                            'model'=>$model,
                            'attribute'=>'dateborn', 
                            'language'=>'ru',
                            'defaultOptions'=>array(
                                'showAnim'=>'fold',
                                'format'=>'dd.mm.yyyy',
                            ),
                            'htmlOptions'=>array(
                                'class'=>'span2'
                            ),
                        ));

          ?>
         <?php echo $form->error($model,'dateborn'); ?>
            
            <!-- -->
</fieldset>

<fieldset>
<?php echo $form->textFieldRow($model,'email',array('class'=>'span3','maxlength'=>64)); ?>
<?php echo $form->textFieldRow($model,'login',array('class'=>'span3','maxlength'=>64)); ?>
<?php echo $form->passwordFieldRow($model,'password',array('class'=>'span3','maxlength'=>64)); ?>
<?php echo $form->passwordFieldRow($model,'passwordComf',array('class'=>'span3','maxlength'=>64)); ?>
</fieldset>
<fieldset>
	<?php echo $form->dropDownListRow($model,'post_id',CHtml::listData(Post::model()->findAll(), 'id', 'name' ),array('class'=>'span5','empty'=>'-------')); ?>

	<?php echo $form->dropDownListRow($model,'subdivision_id',CHtml::listData(Subdivision::model()->findAll(), 'id', 'FullName' ),array('class'=>'span5','empty'=>'-------')); ?>
</fieldset>
<fieldset>
<?php if(CCaptcha::checkRequirements() && Yii::app()->user->isGuest){ ?>
    <?php echo CHtml::activeLabelEx($model, 'verifyCode');?>
    <?php $this->widget('CCaptcha'); ?> <br/>
    <?php echo CHtml::activeTextField($model, 'verifyCode', array(
        'class'=>'span4',
    ));?>
<?php } ?>
</fieldset>
<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Зарегистрироваться',
		)); ?>
</div>

<?php $this->endWidget(); ?>