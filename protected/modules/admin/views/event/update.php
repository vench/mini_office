<?php
$this->breadcrumbs=array(
	'События'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Редактирование',
);

	$this->menu=array(
	array('label'=>'Список событий','url'=>array('index')),
	array('label'=>'Создать событие','url'=>array('create')),
	array('label'=>'Просмотр события','url'=>array('view','id'=>$model->id)),
	array('label'=>'Управление событиями','url'=>array('admin')),
	);
	?>

	<h1>Редактирование события <?php echo $model->name; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>

        <h3>Участники</h3>
        
       

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'eventAddUser-form', 
	'enableAjaxValidation'=>false,
        'action'=>array('eventAddUser', 'id'=>$model->id),
        'method'=>'get',
        'htmlOptions' => array(
            'class' => '',
        ),
)); ?> <div class="input-group">
        <?php
        $data = CHtml::listData(User::model()->findAll(array(
            'condition'=>'t.id NOT IN (SELECT user_id FROM {{EventInvited}} WHERE event_id = :event_id)',
            'params'=>array(':event_id'=>$model->id),
			'with'=>array('subdivision'),
			'select'=>'subdivision_id,id,name,patronymic,surname',
        )), 'id', 'fullName', 'FullSubdivision');
        echo CHtml::dropDownList('add_user_id', NULL, $data, array('empty'=>'-------','class'=>'span5'))
        ?>
        <div class="input-group-btn">
            	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Добавить',
		)); ?> 
	</div></div>

<?php $this->endWidget(); ?>
        
        <?php if(sizeof($model->users) > 0) { ?>
         
        <?php
        
        foreach($model->users as $user){?>
            <div class="well well-small"><?php echo $user->getFullName(); ?> 
                <?php echo CHtml::link('Удалить', array('eventRemoveUser', 'id'=>$model->id, 'user_id'=>$user->id));?>
            </div>
        <?php }
        
        ?>
        
        <?php } ?>