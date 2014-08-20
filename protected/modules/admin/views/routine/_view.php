<div class="view">

		<h3>
	<?php echo CHtml::link(CHtml::encode($data->name),array('view','id'=>$data->id)); ?>
		</h3>

	<b><?php echo CHtml::encode($data->getAttributeLabel('for_all')); ?>:</b>
	<?php echo ($data->for_all == 1) ? 'Да' : 'нет'; ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('starttime')); ?>:</b>
	<?php echo CHtml::encode($data->starttime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('endtime')); ?>:</b>
	<?php echo CHtml::encode($data->endtime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	 

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

<hr/>
</div>
