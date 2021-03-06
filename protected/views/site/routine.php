<?php

 
$this->pageTitle = 'Распорядок дня';
$this->breadcrumbs = array('Распорядок дня' );
?>
 <h1>Распорядок дня</h1>
 <p><b>Общий распоряок дня</b> - формируется администратором системы.</p>
  <p><b>Личный распоряок дня</b> - формируется из событий, поручений в которых учавствует пользователь.</p>
  <div class="alert alert-info">
                         
                         <div class="row-fluid">
                             <div class="span6">
                       <h4>Общий распорядок дня</h4> 
                    <ul class="nav">
                        <?php foreach($routines as $routine) {?> 
                           <li>
                               <b><?php echo $routine->getTimeView()?></b> 
                                   : <?php echo $routine->name?> 
                                  <small> <?php echo $routine->description?> </small>
                           </li> 
                        <?php }?>
                         
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