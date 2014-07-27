<?php
$this->breadcrumbs=array(
	'Запросить встречу ',
);
?>
<h1>Запросить встречу </h1>

<div>
<?php echo CHtml::link('Создать заявку', array('/sEvent/requestappointmentAdd'), array(
	'class'=>'btn btn-large btn-primary',
));?>
</div>

<!-- -->

<div class="row-fluid">
	<div class="span6">
		<h3>Заявки на месяц</h3>
		 <?php  
$this->widget('ext.EFullCalendar.EFullCalendar', array( 
    'themeCssFile'=>'cupertino/theme.css',
    'lang'=>'ru',	 
    'htmlOptions'=>array(
        // you can scale it down as well, try 80%
        'style'=>'width:100%'
    ),
    
    'options'=>array(
		'firstDay'=>1,
        'header'=>array(
            'left'=>'prev,next',
            'center'=>'title',
            'right'=>'today'
        ),
        'lazyFetching'=>true,
		'ignoreTimezone'=>false,
        'events'=>$this->createUrl('/SEvent/ajaxListEvent', array('type_event_id'=>4)), // action URL for dynamic events, or 
    )
));
?>
	</div>
	<div class="span6">
		<h3>Заявки от меня</h3>
<?php
$events = new Event('search'); 
$this->widget('bootstrap.widgets.TbGridView',array(
                'id'=>'user-grid',
                'dataProvider'=>$events->searchMeeting(Yii::app()->user->getId(), true),                
                'columns'=>array(   
                                array(
									'header'=>'Время',
									'name'=>'timestart',
                                    'value'=>'$data->timestartStr()." - ".$data->timeendStr()', 
                                ), 
								array(
									'name'=>'dateevent',  
									 'value'=>'$data->dateeventInfo()', 
								),
								
								array(
									'name'=>'place_id',
									'value'=>'isset($data->place) ? $data->place->name : "Нет"',
								),
								/*array(
									'header'=>'Инициатор',
									'name'=>'user_id',
									'value'=>'isset($data->user) ? $data->user->getFullName() : "Нет"',
								),*/
								
								array(
									'header'=>'Получатель',
									'name'=>'user_id',
									'value'=>'$data->getUsersList()',
								),
								array(
									'name'=>'name', 
									'value'=>'CHtml::link($data->name, array("/sEvent/event", "id"=>$data->getPrimaryKey()))',
									'type'=>'raw',
								),
                                
                ),
));
?>


<h3>Заявки мне</h3>
<?php
$events = new Event('search'); 
$this->widget('bootstrap.widgets.TbGridView',array(
                'id'=>'user-grid',
                'dataProvider'=>$events->searchMeeting(Yii::app()->user->getId(), false),                
                'columns'=>array(   
                                array(
									'header'=>'Время',
									'name'=>'timestart',
                                    'value'=>'$data->timestartStr()." - ".$data->timeendStr()', 
                                ), 
								array(
									'name'=>'dateevent',  
									 'value'=>'$data->dateeventInfo()', 
								),
								
								array(
									'name'=>'place_id',
									'value'=>'isset($data->place) ? $data->place->name : "Нет"',
								),
								array(
									'header'=>'Инициатор',
									'name'=>'user_id',
									'value'=>'isset($data->user) ? $data->user->getFullName() : "Нет"',
								),
								
								/*array(
									'header'=>'Получатель',
									'name'=>'user_id',
									'value'=>'$data->getUsersList()',
								),*/
								array(
									'name'=>'name', 
									'value'=>'CHtml::link($data->name, array("/sEvent/event", "id"=>$data->getPrimaryKey()))',
									'type'=>'raw',
								),
                                
                ),
));
?>
</div>
</div>