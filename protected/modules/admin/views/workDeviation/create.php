<?php
$this->breadcrumbs=array(
	'Причины отсутствия'=>array('index'),
	'Создать',
);

$this->menu=array(
array('label'=>'Список причин','url'=>array('index')),
array('label'=>'Управление причинами','url'=>array('admin')),
);
?>

<h1>Создать причину отсутствия</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>