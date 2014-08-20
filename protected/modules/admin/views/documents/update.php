<?php
$this->breadcrumbs=array(
	'Документы'=>array('index'),
	'документ'=>array('view','id'=>$model->id),
	'Изменение документа',
);

	$this->menu=array(
	array('label'=>'Список документов','url'=>array('index')),
	array('label'=>'Создать документ','url'=>array('create')),
	array('label'=>'Просмотр документов','url'=>array('view','id'=>$model->id)),
	array('label'=>'Управление документа','url'=>array('admin')),
	);
	?>

	<h1>Изменение документа <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>