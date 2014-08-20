<?php
$this->breadcrumbs=array(
	'Подразделения'=>array('index'),
	'Управление',
);

$this->menu=array(
array('label'=>'Список подразделений','url'=>array('index')),
array('label'=>'Создать подразделение','url'=>array('create')),
);
/*
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('subdivision-grid', {
data: $(this).serialize()
});
return false;
});
");*/
?>

<h1>Управление подразделениями</h1>



<?php /*echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
	<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
 * 
 */
$subdivisionList = CHtml::listData(Subdivision::model()->findAll(), 'id', 'name' );
?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'subdivision-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		array(
                    'name'=>'id',
                    'htmlOptions'=>array(
                        'class'=>'span2',
                    ),
                ),		 
                array('name'=>'parent_id', 'filter'=>$subdivisionList, 
                    'value'=>'isset($data->parent) ? $data->parent->name : "Нет"',
                ),
		'name',
array(
'class'=>'bootstrap.widgets.TbButtonColumn',
),
),
)); ?>
