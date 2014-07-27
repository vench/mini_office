<div class="view">

	 <h3><?php echo CHtml::link(CHtml::encode($data->name),array('view','id'=>$data->id)); ?></h3>
	 


	<b><?php echo CHtml::encode($data->getAttributeLabel('charcode')); ?>:</b>
	<?php echo CHtml::encode($data->charcode); ?>
	<br />

	 

	<b><?php echo CHtml::encode($data->getAttributeLabel('work_time')); ?>:</b>
	<?php echo ($data->work_time == 1) ? "Да" : "Нет"; ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('color')); ?>:</b>
	<span style="background: <?php echo $data->color;?>"><?php echo CHtml::encode($data->color); ?></span>
	<br />
        <hr/>

</div>