<?php
$this->breadcrumbs=array(
	'Должности'=>array('index'),
	'Создать',
);

$this->menu=array(
array('label'=>'Список должностей','url'=>array('index')),
array('label'=>'Управление должностями','url'=>array('admin')),
);
?>

<h1>Создать должность</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>