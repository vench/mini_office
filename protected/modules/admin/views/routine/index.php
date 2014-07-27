<?php
$this->breadcrumbs=array(
	'Распорядок дня',
);

$this->menu=array(
array('label'=>'Создать пункт','url'=>array('create')),
array('label'=>'Управление пункта','url'=>array('admin')),
);
?>

<h1>Распорядок дня</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
