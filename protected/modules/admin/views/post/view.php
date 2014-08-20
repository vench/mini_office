<?php
$this->breadcrumbs=array(
	'Должности'=>array('index'),
	$model->name,
);

$this->menu=array(
array('label'=>'Список должностей','url'=>array('index')),
array('label'=>'Создать должность','url'=>array('create')),
array('label'=>'Редактировать должность','url'=>array('update','id'=>$model->id)),
array('label'=>'Удалить должнось','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Управление должностями','url'=>array('admin')),
);
?>

<h1>Просмотр должности #<?php echo $model->name; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		array(
                    'name'=>'parent_id',
                    'value'=>isset($model->parent) ? $model->parent->name : "нет",
                ),
		'name',
),
)); ?>
