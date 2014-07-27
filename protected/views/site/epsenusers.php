<?php
$this->pageTitle = 'Отсутствуют';
$this->breadcrumbs = array('Отсутствуют' );
?>
<h1>Отсутствуют сегодня</h1>

 <?php
 $deviation_id = NULL;
 foreach($models as $model) {
     if($deviation_id != $model->deviation_id) {
         ?> <h4><?php echo $model->deviation->name; ?></h4> <?php
         $deviation_id = $model->deviation_id;
     }
     ?> <p> <?php
     echo $model->user->post->name.', '.$model->user->getFullName() .' -  c '.$model->datestartStr(). ' по '.$model->dateendStr();
     ?>
     </p> <?php
 }
 ?>