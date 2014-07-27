<div class="view">

	 
	<h3><?php echo CHtml::link(CHtml::encode($data->name),array('view','id'=>$data->id)); ?></h3>
	 

	<b><?php echo CHtml::encode($data->getAttributeLabel('parent_id')); ?>:</b>
	<?php echo isset($data->parent) ? CHtml::encode($data->parent->name) : "нет"; ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />
        <hr/>

</div>