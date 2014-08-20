<?php

 
$this->pageTitle = 'Распорядок дня';
$this->breadcrumbs = array('Распорядок дня' );
?>
 <h1>Распорядок дня</h1>
  <div class="alert alert-info">
                         
                         <div class="row-fluid">
                             <div class="span6">
                       <h4>Общий распорядок дня</h4> 
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