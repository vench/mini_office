<?php
$this->breadcrumbs=array(
	'Места/здания'=>array('index'),
	$model->name,
);

$this->menu=array(
array('label'=>'Список мест/зданий','url'=>array('index')),
array('label'=>'Создать место/здание','url'=>array('create')),
array('label'=>'Редактировать место/здание','url'=>array('update','id'=>$model->id)),
array('label'=>'Удалить место/здание','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Управление местами зданиями','url'=>array('admin')),
);
?>

<h1>Место/здание #<?php echo $model->name; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'name',
),
)); ?>
