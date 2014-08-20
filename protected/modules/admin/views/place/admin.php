<?php
$this->breadcrumbs=array(
	'Места/здания'=>array('index'),
	'Управление',
);

$this->menu=array(
array('label'=>'Список мест/зданий','url'=>array('index')),
array('label'=>'Создать место/здание','url'=>array('create')),
);

 
?>

<h1>Управление местами/зданиями</h1>

 

<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'place-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'id',
		'name',
array(
'class'=>'bootstrap.widgets.TbButtonColumn',
),
),
)); ?>
