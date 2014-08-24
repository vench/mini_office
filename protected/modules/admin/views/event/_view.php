<div class="view">

		 
	<h3><?php echo CHtml::link(CHtml::encode($data->name),array('view','id'=>$data->id)); ?></h3>
 

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user->getFullName()); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('place_id')); ?>:</b>
	<?php echo isset($data->place) ? CHtml::encode($data->place->name) : "нет"; ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type_event_id')); ?>:</b>
	<?php echo isset($data->typeEvent) ?  CHtml::encode($data->typeEvent->name) : "нет"; ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dateevent')); ?>:</b>
	<?php echo CHtml::encode($data->dateeventInfo()); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('timestart')); ?>:</b>
	<?php echo CHtml::encode($data->timestartStr()); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('timeend')); ?>:</b>
	<?php echo CHtml::encode($data->timeendStr()); ?>
	<br />

 
        <hr/>
</div>