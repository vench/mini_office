<?php
$this->breadcrumbs=array(
	'Подразделения'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Редактировать',
);

	$this->menu=array(
	array('label'=>'Список подразделений','url'=>array('index')),
	array('label'=>'Создать подразделение','url'=>array('create')),
	array('label'=>'Просмотр подразделения','url'=>array('view','id'=>$model->id)),
	array('label'=>'Управление подразделениями','url'=>array('admin')),
	);
	?>

	<h1>Редактировать подразделение <?php echo $model->name; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>