<?php
$this->breadcrumbs=array(
	'Документы'=>array('index'),
	'Создать',
);

$this->menu=array(
array('label'=>'Список документов','url'=>array('index')),
array('label'=>'Управление документами','url'=>array('admin')),
);
?>

<h1>Создать документ</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>