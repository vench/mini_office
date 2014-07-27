<?php
$this->breadcrumbs=array(
	'Места/здания'=>array('index'),
	'Создать место/здание',
);

$this->menu=array(
array('label'=>'Список мест/зданий','url'=>array('index')),
array('label'=>'Управление местами/зданиями','url'=>array('admin')),
);
?>

<h1>Создать место/здание</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>