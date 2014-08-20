<?php

$this->pageTitle = 'События на завтра';
$this->breadcrumbs = array('События на завтра' );
?>
                <h1>События на завтра</h1>
                <?php 
                $modelEvent = new Event('search'); 
                $this->widget('bootstrap.widgets.TbGridView',array(
                'id'=>'event-grid2',
                'dataProvider'=>$modelEvent->searchByDate(mktime(0,0,0) + 3600 * 24),                
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