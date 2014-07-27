<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div>
   <h4><i class="icon-flag"></i> <?php echo $model->name; ?></h4>
   
   
    <?php  if(sizeof($model->users) > 0) {?>
   <ul class="noListStyle">
       <?php
       foreach($model->users as $user) { ?>
           <li><i class=" icon-user"></i> 
               <?php echo $user->getFullName();?>: <?php echo isset($user->post) ? $user->post->name : "";?></li>
        <?php }       ?>
   </ul>
    <?php }?>
    
    <?php if(sizeof($model->subdivisions) > 0) {?>
    <ul class="noListStyle">
    <?php    
        foreach($model->subdivisions as $subdivision) { ?>
        <li> 
            <?php
            $this->renderPartial('_structure', array(
                'model'=>$subdivision,
            ));
            ?> 
        </li> 
       <?php }?>
    </ul>
    <?php }?>
   
 </div>   
<hr/>