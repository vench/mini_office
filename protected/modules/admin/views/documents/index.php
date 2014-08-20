<?php
$this->breadcrumbs=array(
	'Документы',
);

$this->menu=array(
array('label'=>'Создать документ','url'=>array('create')),
array('label'=>'Управление документами','url'=>array('admin')),
);
?>

<h1>Документы</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
