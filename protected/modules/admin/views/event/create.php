<?php
$this->breadcrumbs=array(
	'События'=>array('index'),
	'Создать',
);

$this->menu=array(
array('label'=>'Список события','url'=>array('index')),
array('label'=>'Управление событиями','url'=>array('admin')),
);
?>

<h1>Создать событие</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>