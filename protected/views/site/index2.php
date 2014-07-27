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
        'events'=> $this->createUrl('/SEvent/ajaxListEvent'),  
 
        // event handling
        // mouseover for example
       // 'eventMouseover'=>new CJavaScriptExpression("js_function_callback"),
    )
));

?>
		</div>