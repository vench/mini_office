<?php
$this->breadcrumbs=array(
	'Пользователи',
);

$this->menu=array(
array('label'=>'Создать пользователя','url'=>array('create')),
array('label'=>'Управление пльзователями','url'=>array('admin')),
);
?>

<h1>Пользователи</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
