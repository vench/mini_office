<?php
$this->beginContent('//layouts/main');


 
?>

<div class="row-fluid">

<div class="span3"> 
    <div class="menu">        
 	 
		<h4>Общее:</h4>
			 <ul class="nav">
                                <li> <?php echo CHtml::link('Календарь событий', array('/site/index')); ?></li>
                                        
                                <li> <?php echo CHtml::link('События сегодня', array('/site/eventNow')); ?></li>
                                <li> <?php echo CHtml::link('События завтра', array('/site/eventTomorow')); ?></li>
                                  
                                <li> <?php echo CHtml::link('Выжные объявления', array('/site/announcements')); ?></li>
                                  
                                <li> <?php echo CHtml::link('Распорядок дня', array('/site/routine')); ?></li>
                                  
                                
                        
			 </ul>
		<h4>Персонал:</h4>
                
                <ul class="nav">
                <li> <?php echo CHtml::link('Новые сотрудники', array('cmpnewusers')); ?></li>
               <li> <?php echo CHtml::link('Кто есть в компании', array('whoincomp')); ?></li>
               <li> <?php echo CHtml::link('Отсутствуют', array('epsenusers')); ?></li>
               <li> <?php echo CHtml::link('Работа в компании', array('cmpwork')); ?></li>
               <li> <?php echo CHtml::link('Наши именинники', array('index')); ?></li>
                                  
               
                    
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
                <?php echo CHtml::link('Бронирование переговорной', array('/site/negotiating')); ?>
                    </li>
					<li>
                <?php echo CHtml::link('Поручения', array('/instruct')); ?>
                    </li>
					<li>
                <?php echo CHtml::link('Доска объявлений', array('/advert')); ?>
                    </li>
					<?/*?>
					<li>
                <?php echo CHtml::link('Техническая поддержка'); ?>
                    </li> <?*/?>
                </ul> 
		<h4>Документы:</h4>
		<ul class="nav">
		<li>
                <?php echo CHtml::link('Бланки документов', array('/docs/blanks')); ?>
                    </li>
		 <li>
                <?php echo CHtml::link('Структура предприятия', array('structure')); ?>
                    </li>
					<?/*?>
					<li>
                <?php echo CHtml::link('процедуры и регламенты', array('')); ?>
                    </li>
					<li>
                <?php echo CHtml::link('База знаний', array('')); ?>
                    </li>
					<?*/?>
		</ul> 	

                <?php if(!Yii::app()->user->isGuest) {?>
                
		<h4>Быстрый чат:</h4>
		<?php
		$this->widget('VsChat.widgets.VsChat', array(
		
		));
		?>
                
                <?php } ?>
			
 
    </div>
</div>
    <div class="span9">
 
<?php    echo $content; ?>    
     </div>
 </div>   
<?php    
$this->endContent();
?>