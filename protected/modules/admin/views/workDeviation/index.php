<?php
$this->breadcrumbs=array(
	'Причины отсутствия',
);

$this->menu=array(
array('label'=>'Создать причину','url'=>array('create')),
array('label'=>'Управление причинами','url'=>array('admin')),
);
?>

<h1>Причины отсутствия</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
