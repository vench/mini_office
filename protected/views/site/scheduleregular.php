<?php
$this->pageTitle = 'Расписание регулярных совещаний';
$this->breadcrumbs = array('Расписание регулярных совещаний' );
?>
<h1>Расписание регулярных совещаний</h1>




<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'event-grid',
'dataProvider'=>$model->search(), 
'columns'=>array( 
                'name', 
                array(
                  'name'=>'user_id',  
                  'value'=>'isset($data->user) ? $data->user->getFullName() : "Нет"',  
                    
                ),
                array(
                  'name'=>'place_id',  
                  'value'=>'isset($data->place) ? $data->place->name : "Нет"',  
                ), 	
                array(
                  'name'=>'dateevent',  
                  'value'=>'"от ".$data->dateevent." каждый ".Utill::getWeekDayStrByTime(strtotime($data->dateevent))',  
                ),
    
    
                array(
                  'name'=>'timestart',  
                  'value'=>'$data->timestartStr()',  
                ), 
                array(
                  'header'=>'Участники',  
                  'value'=>'Yii::app()->controller->renderPartial("_eventUserList", array("model"=>$data))',  
                ),/*                
array(
'class'=>'bootstrap.widgets.TbButtonColumn',
),*/
),
)); 


?>
