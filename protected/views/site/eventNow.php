<?php

$this->pageTitle = 'События сегодня';
$this->breadcrumbs = array('События сегодня' );
?>
<h1>События сегодня</h1>
                <?php 
                $modelEvent = new Event('search'); 
                $this->widget('bootstrap.widgets.TbGridView',array(
                'id'=>'event-grid1',
                'dataProvider'=>$modelEvent->searchByDate(),                
                'columns'=>array(   
                                array(
                                    'name'=>'place_id',
                                    'value'=>'isset($data->place) ? $data->place->name : ""'
                                ), 
                                array(
                                    'name'=>'type_event_id',
                                    'value'=>'isset($data->typeEvent) ? $data->typeEvent->name : ""'
                                ), 
                                array(
                                    'header'=>'Время',
                                    'value'=>'$data->timestartStr() ."-".$data->timeendStr() '
                                ), 
                                array(
                                    'name'=>'name',
                                    'type'=>'raw',
                                    'value'=>'CHtml::link($data->name, array("sEvent/event", "id"=>$data->id)) '
                                ),  
                ),
                )); ?>