<?php
$this->breadcrumbs=array(
	'Распорядок дня'=>array('index'),
	$model->name,
);

$this->menu=array(
array('label'=>'Список пунктов','url'=>array('index')),
array('label'=>'Создание пункта','url'=>array('create')),
array('label'=>'Изменение пункта','url'=>array('update','id'=>$model->id)),
array('label'=>'Удалить пункт','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Управление пунктами','url'=>array('admin')),
);
?>

<h1>Просмотр пункта #<?php echo $model->name; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		 array('name'=>'for_all', 'value'=>$model->for_all == 1 ? 'Да' : 'Нет' ),
		'starttime',
		'endtime',
		array('name'=>'user_id', 'value'=>$model->user->getFullname() ),
		'name',
		'description',
),
)); ?>
