<?php
$this->breadcrumbs=array(
	'Должности'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Редактирование',
);

	$this->menu=array(
	array('label'=>'Список должностей','url'=>array('index')),
	array('label'=>'Создать должность','url'=>array('create')),
	array('label'=>'Просмотр должности','url'=>array('view','id'=>$model->id)),
	array('label'=>'Управление должностями','url'=>array('admin')),
	);
	?>

	<h1>Редактирование длжности <?php echo $model->name; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>