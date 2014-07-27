<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<ol> <?php
foreach($model->users as $user) { ?>
  <li> <?php  echo $user->getFullName(); ?> </li>
<?php }?>
</ol>
