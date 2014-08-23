<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

<p class="help-block">Поля с <span class="required">*</span> обязательные.</p>

<?php echo $form->errorSummary($model);  ?>

	<?php echo $form->dropDownListRow($model,'post_id',CHtml::listData(Post::model()->findAll(), 'id', 'name' ),array('class'=>'span5','empty'=>'-------')); ?>

	<?php echo $form->dropDownListRow($model,'subdivision_id',CHtml::listData(Subdivision::model()->findAll(), 'id', 'FullName' ),array('class'=>'span5','empty'=>'-------')); ?>

	 

	<?php echo $form->textFieldRow($model,'login',array('class'=>'span3','maxlength'=>64)); ?>

	<?php 
        
        if($model->isNewRecord){
            echo $form->passwordFieldRow($model,'password',array('class'=>'span3','maxlength'=>64));  
            echo $form->passwordFieldRow($model,'passwordComf',array('class'=>'span3','maxlength'=>64)); 
        }
        ?>

        


	<?php echo $form->textFieldRow($model,'email',array('class'=>'span5','maxlength'=>64)); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'patronymic',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'surname',array('class'=>'span5','maxlength'=>100)); ?>

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
                                'class'=>'g-2'
                            ),
                        ));

          ?>
         <?php echo $form->error($model,'dateborn'); ?>
            
            <!-- -->
         <?php echo $form->labelEx($model,'dateworkat'); ?>
         <?php 
                        $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                            'model'=>$model,
                            'attribute'=>'dateworkat', 
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
         <?php echo $form->error($model,'dateworkat'); ?>
            
            <!-- -->
         <?php echo $form->labelEx($model,'dateworkto'); ?>
         <?php 
                        $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                            'model'=>$model,
                            'attribute'=>'dateworkto', 
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
         <?php echo $form->error($model,'dateworkto'); ?>
                
            
            	<?php echo $form->fileFieldRow($model,'photo',array('class'=>'')); ?>
	<?php echo $form->hiddenField($model,'photo');  ?>
             <?php echo $form->error($model,'photo'); ?>
	<?php echo ($model->fileExists('photo')) ? CHtml::image($model->getSrc('photo'), 'photo', array()) : '' ; ?>

	<?php echo $form->checkBoxRow($model,'actual',array('class'=>'')); ?>

	<?php echo $form->checkBoxRow($model,'is_super_admin',array('class'=>'')); ?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Создать' : 'Сохранить',
		)); ?>
</div>

<?php $this->endWidget(); ?>
