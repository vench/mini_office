<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div>
    <p>
    <?php echo $data->dateadv; ?> <?php echo $data->timeadvStr(); ?> 
        </p>
        <p>
          <?php echo $data->advert; ?>  
            
        </p>
        <p>
           исп. <?php echo $data->user->getFullName(); ?><?php echo isset($data->user->post) ? ', '.$data->user->post->name : ""; ?> 
        </p>
  
        <?php if($this->userCheckAccess('adverts') && $data->user_id == Yii::app()->user->getId()) {?>
         <p>
             <?php echo CHtml::link('Изменить', array('/advert/edit', 'id'=>$data->id), array()); ?>
             <?php echo CHtml::link('Удалить', array('/advert/remove', 'id'=>$data->id), array(
                 'onclick'=>'return confirm("Удалить объявление?");',
             )); ?> 
         </p>
         <?php } ?>
</div>
<hr/>