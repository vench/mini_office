<?php
$this->breadcrumbs=array(
	'Причины отсутствия'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Обновить причину отсутствия',
);

	$this->menu=array(
	array('label'=>'Список причин','url'=>array('index')),
	array('label'=>'Создать причину','url'=>array('create')),
	array('label'=>'Просмотреть причину','url'=>array('view','id'=>$model->id)),
	array('label'=>'Управление причинами','url'=>array('admin')),
	);
	?>

	<h1>Обновить причину отсутствия <?php echo $model->name; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>