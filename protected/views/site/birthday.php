<?php

 
$this->pageTitle = 'Наши именинники';
$this->breadcrumbs = array('Наши именинники' );
?>
 <h1>Наши именинники</h1>

<?php
                $userModel = new User('search');
                $this->widget('bootstrap.widgets.TbGridView',array(
                'id'=>'user-grid',
                'dataProvider'=>$userModel->searchByHB(),                
                'columns'=>array(   
array('name'=>'photo', 'value'=>'CHtml::image($data->getSrc("photo"), "нет фото", array("style"=>"width:120px"))', 'type'=>'raw', 'htmlOptions'=>array('style'=>'width:120px')),
                                array(
                                    'name'=>'dateborn',
                                    'value'=>'$data->dateborn'
                                ), 
                                array(
                                    'name'=>'name',
                                    'value'=>'$data->getFullName()'
                                ), 
                                array(
                                    'name'=>'subdivision_id',
                                    'value'=>'$data->getFullSubdivision()'
                                ),  
                ),
                )); ?>