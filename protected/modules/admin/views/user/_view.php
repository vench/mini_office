<div class="view">

		 
	<h3><?php echo CHtml::link(CHtml::encode($data->getFullName()),array('view','id'=>$data->id)); ?></h3>
	 

	<b><?php echo CHtml::encode($data->getAttributeLabel('post_id')); ?>:</b>
	<?php echo CHtml::encode(isset($data->post) ? $data->post->name : "Нет"); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subdivision_id')); ?>:</b>
	<?php echo CHtml::encode($data->getFullSubdivision()); ?> 
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('datecreate')); ?>:</b>
	<?php echo CHtml::encode($data->datecreateStr()); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('login')); ?>:</b>
	<?php echo CHtml::encode($data->login); ?>
	<br />

	

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->email), 'emailto:'.$data->email, array());  ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('patronymic')); ?>:</b>
	<?php echo CHtml::encode($data->patronymic); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('surname')); ?>:</b>
	<?php echo CHtml::encode($data->surname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phone')); ?>:</b>
	<?php echo CHtml::encode($data->phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dateborn')); ?>:</b>
	<?php echo CHtml::encode($data->dateborn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('actual')); ?>:</b>
	<?php echo CHtml::encode($data->actual); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_super_admin')); ?>:</b>
	<?php echo CHtml::encode($data->is_super_admin); ?>
	<br />

	*/ ?>
        <hr/>
</div>