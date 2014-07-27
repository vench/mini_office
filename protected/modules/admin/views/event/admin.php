<?php
$this->breadcrumbs=array(
	'События'=>array('index'),
	'Управление',
);

$this->menu=array(
array('label'=>'Список событий','url'=>array('index')),
array('label'=>'Создать событие','url'=>array('create')),
);

$userList = CHtml::listData(User::model()->findAll(array('select'=>'id,name,patronymic,surname',)), 'id', 'fullName');
$placeList = CHtml::listData(Place::model()->findAll(array('select'=>'id,name',)), 'id', 'name');
$typeList = CHtml::listData(EventType::model()->findAll(array('select'=>'id,name',)), 'id', 'name');
        
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('event-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1>Управление событиями</h1>

 

<?php echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
	<?php $this->renderPartial('_search',array(
	'model'=>$model,
        'userList'=>$userList,
        'placeList'=>$placeList,
        'typeList'=>$typeList,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'event-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		array(
                    'name'=>'id',
                    'htmlOptions'=>array(
                        'class'=>'span2',
                    ),
                ), 
                array(
                  'name'=>'user_id',  
                  'value'=>'isset($data->user) ? $data->user->getFullName() : "Нет"',  
                  'filter'=>$userList,  
                ),
                array(
                  'name'=>'place_id',  
                  'value'=>'isset($data->place) ? $data->place->name : "Нет"',  
                    'filter'=>$placeList,  
                ),
                array(
                  'name'=>'type_event_id',  
                  'value'=>'isset($data->typeEvent) ? $data->typeEvent->name : "Нет"',
                     'filter'=>$typeList, 
                ), 
		'dateevent',		 
                array(
                  'name'=>'timestart',  
                  'value'=>'$data->timestartStr()',  
                ),
                'name', 
array(
'class'=>'bootstrap.widgets.TbButtonColumn',
),
),
)); ?>
