<?php
$this->pageTitle = 'Вход';
$this->breadcrumbs = array('Вход ' );
?>

<div class="row">
	<div class="span12">
        <div class="alert alert-info">
            <span>Для входа в систему необходимо ввести логин и пароль.</span>
        </div>
    </div>
</div>

<div class="row">
	<div class="span12">
		<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id' => 'login-form',
            'htmlOptions' => array('class' => 'well login-form'),
            'enableClientValidation' => true,
        )); ?>
        
        <?= $form->textFieldRow($model, 'username', array('class' => 'span3')); ?>
        <?= $form->passwordFieldRow($model, 'password', array('class' => 'span3')); ?>
        <?= $form->checkboxRow($model, 'rememberMe'); ?>
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
