<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

echo '<ul class="nav">';
            foreach($models as $model) {
                echo '<li>';
                echo CHtml::link($model->userFrom->getFullName(), array('selectChat', 'to'=>$model->user_from), array());
                echo '</li>';             
           }
           echo '</ul>';
?>

