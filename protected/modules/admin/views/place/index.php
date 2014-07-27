<?php
$this->breadcrumbs=array(
	'Места/здания',
);

$this->menu=array(
array('label'=>'Создаьб место/здание','url'=>array('create')),
array('label'=>'Управление местами/зданиями','url'=>array('admin')),
);
?>

<h1>Места/здания</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
