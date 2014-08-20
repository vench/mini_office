<?php
$this->breadcrumbs=array(
	'Распорядок дня'=>array('index'),
	'Управление',
);

$this->menu=array(
array('label'=>'Список пунктов','url'=>array('index')),
array('label'=>'Создание пункт','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('routine-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1>Управление распорядком дня</h1>

 

<?php /* echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
	<?php $this->renderPartial('_search',array(
	'model'=>$model,
));?>
</div><!-- search-form --> <? */?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'routine-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		array('name'=>'id'),
		array('name'=>'for_all', 'value'=>'$data->for_all == 1 ? "Да" : "Нет"',),
		array('name'=>'starttime'),
		array('name'=>'endtime'),
		 
		array('name'=>'user_id', 'value'=>'$data->user->getFullName()'),
		array('name'=>'name'),
		/*
		array('name'=>'description'),
		*/
array(
'class'=>'bootstrap.widgets.TbButtonColumn',
),
),
)); ?>
