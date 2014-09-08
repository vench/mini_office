
<div class="row">
	<div class="span12">
        <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id' => 'login-form',
            'action'=>array('/site/login'),
            'htmlOptions' => array('class' => 'well login-form'),
            'enableClientValidation' => true,
        )); ?>
        
        <?php echo $form->textFieldRow($model, 'username', array('class' => 'span3')); ?>
        <?php echo $form->passwordFieldRow($model, 'password', array('class' => 'span3')); ?>
        <?php echo $form->checkboxRow($model, 'rememberMe'); ?>
		<div class="">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit', 
			'label' => 'Вход', 
			'htmlOptions'=>array(
				'class'=>'btn-large'
			))); 
		?>
        </div> 
		<p>
			<?php echo CHtml::link('Регистрация', array('/site/register'));?>
		</p>	
        <?php $this->endWidget(); ?>
		
		
    </div>
</div>