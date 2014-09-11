<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$N = date('t', $time); 
?>
<table class="table table-bordered table-striped table-condensed table-hover">
    
 
 
    
 <div class="row-fluid">
     <div class="span8">
         <h3><?php echo Utill::getMonthStr(date('m', $time)); ?> <?php echo date('Y', $time);?></h3>
     </div>
     <div class="span4">
         <div class="btn-group">
<?php echo CHtml::link('назад', array($this->actionTabel, 'time'=>$this->getTimeBack()), array('class'=>'btn btn-mini'));?> 
<?php echo CHtml::link('сегодня', array($this->actionTabel), array('class'=>'btn btn-mini'));?>       
<?php echo CHtml::link('вперед', array($this->actionTabel, 'time'=>$this->getTimeNext()), array('class'=>'btn btn-mini'));?>
      </div> 
      </div> 
 </div>        
<thead>
    <tr>
        <th>ФИО</th>
        <?php 
    for($i = 1; $i <= $N; $i ++) {
        $t = mktime(0, 0, 0, date('m', $time), $i, date('Y', $time));
        ?><th <?php if(date('w', $t) == 0 || date('w', $t) == 6) :?> style="background:#f2dede;" <?php endif; ?>>
        <?=$i?><br><small><?=   Utill::getWeekDayStr(date('w', $t))?></small></th><?php
    }
    ?></tr>  
 </thead>   
<tbody>
<?php
$subdivision = NULL;
foreach($models as $model) {
    
    if(is_null($subdivision) || $subdivision->id != $model->subdivision->id) {
        $subdivision = $model->subdivision;
        ?> 
        <tr><td colspan="<?php echo ($N+1);?>">Подразделение: <?php echo is_null($subdivision) ? "нет" : $subdivision->getFullName();?></td></tr>    
        <?php
    }
    
    ?><tr><td><?php //echo sizeof($model->userWorkDeviations);
    
    if(Yii::app()->user->checkAccess('tabel')) {
         echo CHtml::link($model->getFullName(), array($this->actionTabelUser, 'time'=>$time, 'uid'=>$model->id));
    } else {
         echo CHtml::link($model->getFullName(), '#');
    }
   
    
    
   for($i = 1; $i <= $N; $i ++) {
         
        $deviation = $model->getUserWorkDeviationByDate(mktime(0,0,0, date('m', $time), $i, date('Y', $time)));
      
        ?></td>
        <td <?php if(!is_null($deviation)) :?> title="<?php echo $deviation->deviation->name?>" style="background: <?php echo $deviation->deviation->getSoftColor();?>" <?php endif; ?>>
            <?php if(!is_null($deviation)) : echo $deviation->deviation->charcode; endif; ?>
        <?php
    }
    
    
    ?> </td></tr><?php
}

?>
    </tbody>
</table>