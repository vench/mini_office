<div class="alert">
  <h3><?php echo $data->name; ?>: <?php echo $data->getStatusText();?></h3>
  <p>Крайний срок: <?php echo $data->deadline; ?>; Дата создания: <?php echo $data->datecreate; ?></p> 
  <p>Исполнитль: <?php echo $data->userTo->getFullName(); ?></p> 
  
  <?php if($from == 1) {?>
  <div>Сменить статус:  <?php 
  
	$list = $data->getMayStatusList(); 
	if(sizeof($list ) > 0) {
	?> <div class="btn-group"> <?php
	foreach($list as $key=>$value) {
		echo CHtml::link($value, array('changeStatus', 'id'=>$data->id, 'status'=>$key, ), array(
			'class'=>'btn btn-mini',
		));
	} 
	?> </div> <?php
	} else {  ?> 
	нельзя
	<?php }
 ?> </div>
  <?php } else {?> 
  <div>
  <?php 
  
  $list = $data->getMayStatusList(true); 
  	?> <div class="btn-group"> <?php
	foreach($list as $key=>$value) {
		echo CHtml::link($value, array('changeStatusFrom', 'id'=>$data->id, 'status'=>$key, ), array(
			'class'=>'btn btn-mini',
		));
	} 
	?> </div> <?php
  echo CHtml::link('Удалить', array('remove', 'id'=>$data->id), array('class'=>'btn btn-mini btn-danger', 'onclick'=>'return confirm("Подтвердите удаление!");'));?>
	</div>
  <?php } ?>
  
   <a href="#" class="messTextLink">Просмотреть описание</a>
   <div data-pk="<?php echo $data->id; ?>" class="hide messText"><hr><?php echo $data->description;?></div>
</div>
<hr/>