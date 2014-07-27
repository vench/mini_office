<?php
$this->pageTitle = 'Домашняя страница';

?>



<div class="row-fluid">
	<div class="span6">
		<div>
		<h3>Календарь: <span class="right" id="stime"></span></h3>
                
                
                
                <script type="text/javascript">
            $(function(){                
                var $stime = $('#stime'),
                    time = new Date(<?php echo (time() * 1000)?>),
                    step = 1000,
                    sp = '<span>:</span>',
                    fnSetTime =  function(){ 
                       sp = (time.getSeconds() % 2 == 0) ? '<span style="visibility:hidden">:</span>' : '<span>:</span>'; 
                       $stime.html(time.getHours()+sp+ ((time.getMinutes() > 9 ? "" : "0")) + time.getMinutes()); 
                       time.setTime(time.getTime() + step);
                    },
                    idTimer = setInterval(fnSetTime, step);
                    fnSetTime();
            })    
            </script>
                
<?php
 
    
$this->widget('ext.EFullCalendar.EFullCalendar', array(
    // polish version available, uncomment to use it
   
    // you can create your own translation by copying locale/pl.php
    // and customizing it
 
    // remove to use without theme
    // this is relative path to:
    // themes/<path>
    'themeCssFile'=>'cupertino/theme.css',
    'lang'=>'ru',	
 
    // raw html tags
    'htmlOptions'=>array(
        // you can scale it down as well, try 80%
        'style'=>'width:100%'
    ),
    // FullCalendar's options.
    // Documentation available at
    // http://arshaw.com/fullcalendar/docs/
    'options'=>array(
		'firstDay'=>1,
        'header'=>array(
            'left'=>'prev,next',
            'center'=>'title',
            'right'=>'today'
        ),
        'lazyFetching'=>true,
		'ignoreTimezone'=>false,
        'events'=> 
        $this->createUrl('/SEvent/ajaxListEvent'), // action URL for dynamic events, or
       // 'events'=>$items ,// pass array of events directly
 
        // event handling
        // mouseover for example
       // 'eventMouseover'=>new CJavaScriptExpression("js_function_callback"),
    )
));

?>
		</div>
		<div class="">
                
                     <div class="alert alert-info">
                         
                         <div class="row-fluid">
                             <div class="span6">
                        <h4>Распорядок дня</h4>
                    <ul class="nav">
                        <li><b>9:10</b> - Развоз от м. Академическая</li>
                        <li><b>9:30</b> - Начало рабочего дня</li>
                        <li><b>12:00 - 16:00</b> - Обед 30 минут</li>
                        <li><b>18:00</b> - Конец рабочего дня</li>
                        <li><b>18:10</b> - Развоз до м. Академическая</li>
                    </ul>
                            </div>
                             <div class="span6">                                  
                                <?php if(!Yii::app()->user->isGuest) {?>
                                <h4>Личный распорядок дня</h4> 
                                <ul class="nav">
                                <?php
                                $data = Yii::app()->user->getTaskList();
                                foreach($data as $item) { 
                                   list($time, $name, $id) = $item; 
                                    ?>
                                    <li><b><?php echo $time;?></b> - <span><?php echo CHtml::link($name, array('/sEvent/event', 'id'=>$id));?></span></li>
                                    
                                <?php } ?>
                                     </ul>
                                <?php }?>
                             </div>    
                         </div>
                         </div>
                </div>
	</div>
	<div class="span6">
		<h3>События сегодня</h3>
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
                <h3>События на завтра</h3>
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
	</div>
</div>

<div class="row-fluid">
	<div class="span2">
		<h4>Персонал:</h4>
                
                <ul class="nav">
                <li> <?php echo CHtml::link('Новые сотрудники', array('cmpnewusers')); ?></li>
               <li> <?php echo CHtml::link('Кто есть в компании', array('whoincomp')); ?></li>
               <li> <?php echo CHtml::link('Отсутствуют', array('epsenusers')); ?></li>
               <li> <?php echo CHtml::link('Работа в компании', array('cmpwork')); ?></li>
                    
                </ul>    
		<h4>Функционал:</h4>
                <ul class="nav">
                    <li>
                <?php echo CHtml::link('Расписание регулярных совещаний', array('scheduleregular')); ?>
                    </li>
               
					<li>
                <?php echo CHtml::link('Запросить встречу', array('requestappointment')); ?>
                    </li>
					<li>
                <?php echo CHtml::link('Бронирование переговорной', array('negotiating')); ?>
                    </li>
					<li>
                <?php echo CHtml::link('Поручения', array('/instruct')); ?>
                    </li>
					<li>
                <?php echo CHtml::link('Доска объявлений', array('/advert')); ?>
                    </li>
					
					<li>
                <?php echo CHtml::link('Техническая поддержка'); ?>
                    </li>
                </ul> 
		<h4>Документы:</h4>
		<ul class="nav">
		<li>
                <?php echo CHtml::link('Бланки документов', array('/docs/blanks')); ?>
                    </li>
		 <li>
                <?php echo CHtml::link('Структура предприятия', array('structure')); ?>
                    </li>
					<li>
                <?php echo CHtml::link('процедуры и регламенты', array('')); ?>
                    </li>
					<li>
                <?php echo CHtml::link('База знаний', array('')); ?>
                    </li>
		</ul> 			
	</div>
	<div class="span5">
            <div class="alert alert-info">
		<h4>Важные объявления</h4>
                <?php
                $advertModel = new Advert('search');
                $advertModel->important = 1;
                $this->widget('bootstrap.widgets.TbListView',array(
                    'id'=>'advert-grid',
                    'dataProvider'=>$advertModel->search(),                
                    'itemView'=>'/advert/_view',
                ));
                ?>
            </div>    
	</div>
	<div class="span5">
		<div>
		<h4>Наши именинники</h4>
                <?php
                $userModel = new User('search');
                $this->widget('bootstrap.widgets.TbGridView',array(
                'id'=>'user-grid',
                'dataProvider'=>$userModel->searchByHB(),                
                'columns'=>array(   
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
		</div>
		<div>
		<h4>Техпотдержка</h4>
                <?php
    echo CHtml::link('Запрос в техподдержку', '#', array(
        'class'=>'btn btn-large btn-primary',
    ));
    ?>
		</div>
	</div>
</div>
