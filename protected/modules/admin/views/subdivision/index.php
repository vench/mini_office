<?php
$this->breadcrumbs=array(
	'Подразделения',
);

$this->menu=array(
array('label'=>'Создать Подразделение','url'=>array('create')),
array('label'=>'Управление подразделениями','url'=>array('admin')),
);
?>

<h1>Подразделения</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
