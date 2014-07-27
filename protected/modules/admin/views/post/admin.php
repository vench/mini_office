<?php
$this->breadcrumbs=array(
	'Должности'=>array('index'),
	'Управление',
);

$this->menu=array(
array('label'=>'Список должностей','url'=>array('index')),
array('label'=>'Создать должность','url'=>array('create')),
);

/*
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('post-grid', {
data: $(this).serialize()
});
return false;
});
");
*/
$listPosts = CHtml::listData(Post::model()->findAll(), 'id', 'name');
?>

<h1>Управление должностями</h1>

 

<?php

/*echo CHtml::link('Расширеный поиск','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
	<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
 * 
 */?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'post-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		array(
                    'name'=>'id',
                    'htmlOptions'=>array(
                        'class'=>'span2',
                    ),
                ),
		array('name'=>'parent_id', 'filter'=>$listPosts, 'value'=>'isset($data->parent) ? $data->parent->name : "нет"',),
		'name',
array(
'class'=>'bootstrap.widgets.TbButtonColumn',
),
),
)); ?>
