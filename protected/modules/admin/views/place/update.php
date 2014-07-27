<?php
$this->breadcrumbs=array(
	'Места/здания'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Редактирование',
);

	$this->menu=array(
	array('label'=>'Список мест/зданий','url'=>array('index')),
	array('label'=>'Создать место/здание','url'=>array('create')),
	array('label'=>'Просмотр места здания','url'=>array('view','id'=>$model->id)),
	array('label'=>'Управление местми зданиями','url'=>array('admin')),
	);
	?>

	<h1>Редактирование места/здания <?php echo $model->name; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>