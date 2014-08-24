<?php
$this->breadcrumbs=array(
	'События'=>array('index'),
	$model->name,
);

$this->menu=array(
array('label'=>'Список событий ','url'=>array('index')),
array('label'=>'Создать событие','url'=>array('create')),
array('label'=>'Редактировать событие','url'=>array('update','id'=>$model->id)),
array('label'=>'Удалить событие','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Управление событием','url'=>array('admin')),
);
?>

<h1>Просмотр события #<?php echo $model->name; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id', 
                array(
                    'name'=>'user_id',
                    'value'=>isset($model->user) ? $model->user->getFullName() : "Нет",
                ),
                array(
                    'name'=>'place_id',
                    'value'=>isset($model->place) ? $model->place->name : "Нет",
                ),
                array(
                    'name'=>'type_event_id',
                    'value'=>isset($model->typeEvent) ? $model->typeEvent->name : "Нет",
                ), 
		'dateevent',
		'timestart',
		'timeend',
               
		'name',
		array('name'=>'description', 'type'=>'raw'),
),
)); ?>

<?php if(sizeof($model->users) > 0) { ?>
         <h4>Участники</h4>
         <div class="well well-small">
        <?php
        $in = array();
        foreach($model->users as $user){?>
            <?php $in[] = $user->getFullName(); ?>    
        <?php }  
        echo join(', ', $in);
        ?>
         </div>
<?php } ?>