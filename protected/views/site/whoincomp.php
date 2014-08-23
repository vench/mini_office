<?php
$this->pageTitle = 'Кто есть в компании';
$this->breadcrumbs = array('Кто есть в компании' );
?>
<h1>Кто есть в компании</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'user-grid',
'dataProvider'=>$model->search(), 
'columns'=>array( 
		array('name'=>'photo', 'value'=>'CHtml::image($data->getSrc("photo"), "нет фото", array("style"=>"width:120px"))', 'type'=>'raw', 'htmlOptions'=>array('style'=>'width:120px')),
		
		
		array('name'=>'post_id',  'value'=>'$data->getFullSubdivision().": ".$data->post->name'),		 
		array('name'=>'name', 'value'=>'$data->getFullName()'), 
                array('name'=>'dateworkat',),
                array('name'=>'email', 'value'=>'CHtml::link($data->email, "mailto:".$data->email)', 'type'=>'raw'),
		'phone', 
		 
		/*
		
		'name',
		'patronymic',
		'surname',
		'phone',
		'dateborn',
		
		'is_super_admin',
		*/
 
),
)); ?>