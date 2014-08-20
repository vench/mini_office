<?php
$this->pageTitle = 'Новые сотрудники';
$this->breadcrumbs = array('Новые сотрудники ' );
?>
<h1>Новые сотрудники</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'user-grid',
'dataProvider'=>$model->search(), 
'columns'=>array( 
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