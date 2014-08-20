<?php
$this->breadcrumbs=array(
	'Должности',
);

$this->menu=array(
array('label'=>'Создать должность','url'=>array('create')),
array('label'=>'Управление должностями','url'=>array('admin')),
);
?>

<h1>Должности</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
