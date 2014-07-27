<?php
$this->breadcrumbs=array(
	'Распорядок дня'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Изменение',
);

	$this->menu=array(
	array('label'=>'Список пунктов','url'=>array('index')),
	array('label'=>'Создать пункт','url'=>array('create')),
	array('label'=>'Просмотр пунктов','url'=>array('view','id'=>$model->id)),
	array('label'=>'Управление пунктами','url'=>array('admin')),
	);
	?>

	<h1>Изменение пункта <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>