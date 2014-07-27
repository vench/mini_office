<?php
$this->breadcrumbs=array( 
	'Список пользователей'=>array('index'),
	'Управление пользователями',
);

$this->menu=array(
array('label'=>'Список пользователей','url'=>array('index')),
array('label'=>'Создать пользователя','url'=>array('create')),
);

$postsList = CHtml::listData(Post::model()->findAll(), 'id', 'name' );
$subdivisionList = CHtml::listData(Subdivision::model()->findAll(), 'id', 'name' ); 

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('user-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1>Управление пользователями</h1>

 

<?php echo CHtml::link('Расширеный поиск','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
	<?php $this->renderPartial('_search',array(
	'model'=>$model,
        'postsList'=>$postsList,
        'subdivisionList'=>$subdivisionList,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'user-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		array(
                    'name'=>'id',
                    'htmlOptions'=>array(
                        'class'=>'span2',
                    ),
                ),
		array('name'=>'post_id', 'filter'=>$postsList, 'value'=>'$data->post->name'),
		array('name'=>'subdivision_id', 'filter'=>$subdivisionList, 'value'=>'$data->getFullSubdivision()'),  
		 array('name'=>'name', 'value'=>'$data->getFullName()'), 
		'login', 
		array('name'=>'actual', 'filter'=>Utill::getYesNo(), 'value'=>'$data->actual ? "Да" : "Нет"'), 
		'email',
		/*
		
		'name',
		'patronymic',
		'surname',
		'phone',
		'dateborn',
		
		'is_super_admin',
		*/
array(
'class'=>'bootstrap.widgets.TbButtonColumn',
),
),
)); ?>
