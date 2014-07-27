<?php
$this->breadcrumbs=array(
	'Документы'=>array('index'),
	'Управление',
);

$this->menu=array(
array('label'=>'Список документов','url'=>array('index')),
array('label'=>'Создание документов','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('documents-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1>Управление документами</h1>
<?php /*
<p>
	Вы можете использовать операторы сравнения (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>
		&lt;&gt;</b> )
</p>

<?php echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
	<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
*/?>
<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'documents-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		array('name'=>'id'),
		array('name'=>'user_id', 'value'=>'$data->user->getFullName()',),
		array('name'=>'type', 'value'=>'$data->getTypeStr()',),
		array('name'=>'description'),
		array('name'=>'url', 'value'=>'($data->isFileExists()) ? CHtml::link($data->url, $data->getDownloadLink(), array("target"=>"_blank")) : ""', 'type'=>'raw',),
array(
'class'=>'bootstrap.widgets.TbButtonColumn',
),
),
)); ?>
