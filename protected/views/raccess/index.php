<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$this->breadcrumbs=array(
	'Права доступа ',
);
?>
<h1>Права доступа</h1>


<?php
$postsList = CHtml::listData(Post::model()->findAll(), 'id', 'name' );
$subdivisionList = CHtml::listData(Subdivision::model()->findAll(), 'id', 'name' ); 

$this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'user-grid',
'dataProvider'=>$user->search(),
'filter'=>$user,
'columns'=>array(
		array(
                    'name'=>'id',
                    'htmlOptions'=>array(
                        'class'=>'span2',
                    ),
                ),
		array('name'=>'post_id', 'filter'=>$postsList, 'value'=>'$data->post->name'),
		array('name'=>'subdivision_id', 'filter'=>$subdivisionList, 'value'=>'isset($data->subdivision) ? $data->subdivision->name : ""'), 
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
        'template'=>'{update} ',
        'updateButtonUrl'=>'Yii::app()->controller->createUrl("update",array("id"=>$data->primaryKey))',
    ),
),
)); 
?>