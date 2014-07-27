<div>
	
	 
 
	<?php echo $data->description;?>: 
	<?php echo  ($data->isFileExists()) ? CHtml::link($data->url, $data->getDownloadLink(), array('target'=>'_blank', 'title'=>'скачать файл',)) : 'файл отсутствует!'; ?>
	<br/>
	<small><b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user->getFullName()); ?></small>
<hr/>
</div>