<?php
$this->breadcrumbs=array(
	'Пользователи'=>array('index'),
	$model->name,
);

$this->menu=array(
array('label'=>'Список пользователей','url'=>array('index')),
array('label'=>'Создать пользователя','url'=>array('create')),
array('label'=>'Радактировать пользователя','url'=>array('update','id'=>$model->id)),
array('label'=>'Удалить пользователя','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Управление пользователями','url'=>array('admin')),
);
?>

<h1>Просмотр пользователя #<?php echo $model->getFullName(); ?></h1>


<div class="row-fluid">


<div class="span8">
<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
                array(
                   'name'=>'post_id',
                   'value'=>isset($model->post) ? $model->post->name : "",
                ),    
		array(
                   'name'=>'subdivision_id',
                   'value'=>$model->getFullSubdivision(),
                ), 
		array(
                   'name'=>'datecreate',
                   'value'=>($model->datecreateStr()),
                ), 
		'login',
                array(
                   'name'=>'email',
                   'type'=>'raw',
                   'value'=>CHtml::link(CHtml::encode($model->email), 'emailto:'.$model->email, array()),
                ),
 
		'name',
		'patronymic',
		'surname',
		'phone',
		'dateborn',
                'dateworkat',
                 
                array(
                   'name'=>'dateworkto',
                   'value'=>($model->actual == 1) ? 'работает' : $model->dateworkat,
                ),
                array(
                   'name'=>'actual',
                   'value'=>($model->actual == 1) ? 'Да' : 'Нет',
                ),
		array(
                   'name'=>'is_super_admin',
                   'value'=>($model->is_super_admin == 1) ? 'Да' : 'Нет',
                ), 
),
)); ?>

</div>
	<div class="span4">
<?php echo ($model->fileExists('photo')) ? CHtml::image($model->getSrc('photo'), 'photo', array('class'=>'')) : '' ; ?>
</div>

</div>