<?php
$this->breadcrumbs=array(
	'Подразделения'=>array('index'),
	$model->name,
);

$this->menu=array(
array('label'=>'Список подразделений','url'=>array('index')),
array('label'=>'Создать подразделение','url'=>array('create')),
array('label'=>'Редактировать подразделение','url'=>array('update','id'=>$model->id)),
array('label'=>'Удалить подразделение','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Управлять подразделениями','url'=>array('admin')),
);
?>

<h1>Просмотр подразделения #<?php echo $model->name; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id', 
                array(
                    'name'=>'parent_id',
                    'value'=> isset($model->parent) ? CHtml::encode($model->parent->name) : "нет",
                ),
		'name',
),
)); ?>
