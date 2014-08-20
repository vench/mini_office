<?php
$this->breadcrumbs=array(
	'События',
);

$this->menu=array(
array('label'=>'Создать событие','url'=>array('create')),
array('label'=>'Управление событиями','url'=>array('admin')),
);
?>

<h1>События</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
