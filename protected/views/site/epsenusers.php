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
     ?> <p> 

  <?php echo CHtml::image($model->user->getSrc("photo"), "нет фото", array("style"=>"width:120px; margin:0 10px 0 0;float:left;")); ?>
<?php
     echo $model->user->post->name.', '.$model->user->getFullName() .' -  c '.$model->datestartStr(). ' по '.$model->dateendStr();
     ?>
     </p> 

	<div style="clear:both;"></div>
<?php
 }
 ?>