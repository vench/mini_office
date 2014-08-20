
<?php

$currentUserId = Yii::app()->user->getId();
?>

<ul>
<?php foreach($models as $model){?>
	<li class="<?php echo ($model->user_from == $currentUserId)  ? 'me' : ''?>">
		<p>
			<span class="date"><?php echo date('d.m.Y H:i', $model->expire); ?></span>
		 
			<span class="name"><?php echo $model->userFrom->getFullname(); ?></span>
		</p>
		
		<p>
			<?php echo $model->comment; ?> 
		</p>
	</li>
	
<?php } ?>
</ul>