<?php
$this->breadcrumbs=array(
	'Документы'=>array('index'),
	'Документ',
);

$this->menu=array(
array('label'=>'Список документов','url'=>array('index')),
array('label'=>'Создание документов','url'=>array('create')),
array('label'=>'Изменение документа','url'=>array('update','id'=>$model->id)),
array('label'=>'Удалить документ','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Управление документами','url'=>array('admin')),
);
?>

<h1>Просмотр документа #<?php echo $model->description; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
	 
		array('name'=>'type', 'value'=>$model->getTypeStr(),),  
		array('name'=>'user_id', 'value'=>$model->user->getFullName(),),
		'description',
		array('name'=>'url', 'value'=>($model->isFileExists()) ? CHtml::link($model->url, $model->getDownloadLink(), array('target'=>'_blank')) : '', 'type'=>'raw'),
),
)); ?>
