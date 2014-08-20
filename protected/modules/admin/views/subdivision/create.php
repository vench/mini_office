<?php
$this->breadcrumbs=array(
	'Подразделения'=>array('index'),
	'Создать',
);

$this->menu=array(
array('label'=>'Список подразделений','url'=>array('index')),
array('label'=>'Управление подразделениями','url'=>array('admin')),
);
?>

<h1>Создать подразделение</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>