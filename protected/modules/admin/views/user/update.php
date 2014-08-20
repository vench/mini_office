<?php
$this->breadcrumbs=array(
	'Пользователи'=>array('index'),
	$model->getFullName()=>array('view','id'=>$model->id),
	'Изменить',
);

	$this->menu=array(
	array('label'=>'Список пользователей','url'=>array('index')),
	array('label'=>'Создать пользователя','url'=>array('create')),
	array('label'=>'Просмотр пользователя','url'=>array('view','id'=>$model->id)),
	array('label'=>'Управление пользователями','url'=>array('admin')),
	);
	?>

	<h1>Редактирование пользователя <?php echo $model->getFullName(); ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>

        
        
<h3>Смена пароля</h3>
<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'changePass-form', 
	'enableAjaxValidation'=>false,
        'htmlOptions' => array(
            'class' => 'form-vertical',
        ),
)); ?>
              
                    <?php echo $form->labelEx($changePass,'password'); ?>
                    <?php echo $form->passwordField($changePass,'password'); ?>
                    <?php echo $form->error($changePass,'password'); ?>
            
                    <?php echo $form->labelEx($changePass,'password2'); ?>
                    <?php echo $form->passwordField($changePass,'password2'); ?>
                    <?php echo $form->error($changePass,'password2'); ?>
        
    
    
	<div class="form-actions">
            	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Изменить',
		)); ?> 
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->