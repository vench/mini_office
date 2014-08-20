<?php
$this->breadcrumbs=array(
	'Причины отсутствия'=>array('index'),
	$model->name,
);

$this->menu=array(
array('label'=>'Список причин','url'=>array('index')),
array('label'=>'Создать прчину','url'=>array('create')),
array('label'=>'Редактировать причину','url'=>array('update','id'=>$model->id)),
array('label'=>'Удалить причину','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Управление причинами','url'=>array('admin')),
);
?>

<h1>Просмотр причины #<?php echo $model->name; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'charcode',
		'name',
		array(
                    'name'=>'work_time',
                    'value'=> $model->work_time == 1 ? 'Да' : 'Нет',
                ),
                array(
                    'name'=>'color',
                    'type'=>'raw',
                    'value'=>'<span style="background:'.$model->color.'">'.$model->color.'</span>',
                ), 
),
        )); ?> 
