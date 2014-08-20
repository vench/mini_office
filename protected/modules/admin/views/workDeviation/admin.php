<?php
$this->breadcrumbs=array(
	'Причины отсутствия'=>array('index'),
	'Управление',
);

$this->menu=array(
array('label'=>'Список причин','url'=>array('index')),
array('label'=>'Создать причину','url'=>array('create')),
);

 
?>

<h1>Управление причинами отсутствия</h1>
 
 

<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'work-deviation-grid',
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
                    'name'=>'charcode',
                    'htmlOptions'=>array(
                        'class'=>'span2',
                    ),
                ),
		'name', 
                array(
                    'name'=>'work_time',
                    'filter'=>FALSE,
                    'value'=>'$data->work_time == 1 ? "Да" : "Нет"',
                ), 
		array(
                    'name'=>'color',
                    'filter'=>FALSE,
                ),    
array(
'class'=>'bootstrap.widgets.TbButtonColumn',
),
),
)); ?>
