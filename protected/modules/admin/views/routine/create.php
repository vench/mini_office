<?php
$this->breadcrumbs=array(
	'Распорядок дня'=>array('index'),
	'Создать',
);

$this->menu=array(
array('label'=>'Список пунктов','url'=>array('index')),
array('label'=>'Управление пунктами','url'=>array('admin')),
);
?>

<h1>Создать пункт</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>