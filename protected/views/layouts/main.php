<!DOCTYPE html>
<html lang="ru">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    
	<title><?= CHtml::encode($this->pageTitle.' | ' . Yii::app()->name); ?></title>
	
 	<?php Yii::app()->getClientScript()->registerCssFile( Yii::app()->request->baseUrl.'/themes/main/css/style.css'); ?>
    
	 
</head>

<body>
<?php if(!Yii::app()->user->isGuest) {?>
<div class="container-fluid">    
	<div class="row-fluid wrapp">
		<div class="span6"> 
                     <div class="well well-small">
			Вы вощли как: <b><?php echo Yii::app()->user->getModel()->getFullName();?></b><br/>
                        <?php echo isset(Yii::app()->user->getModel()->post) ? Yii::app()->user->getModel()->post->name : ""; ?>
                        </div> 
		</div>
		<div class="span6">
                    <ul class="nav nav-pills nav-stacked">
                    <li class="active">
                        <?php 
                        $cNew = Yii::app()->user->getCountNewMess();
                        echo CHtml::link('Сообщения'.($cNew > 0 ? '<span class="badge pull-right">'.$cNew.'</span>' : '' ), array('/message')); ?>
			 
                        
                     </li>
                     </ul>
		</div>
	</div>    
</div>
<?php } ?>  

<div class="wrapp">  
<?php $this->renderPartial('//layouts/_main_menu', array()); ?>
</div>
<div class="container-fluid wrapp" id="page">
    
		<!-- Breadcrumbs -->	
		<?php if(isset($this->breadcrumbs) && is_array($this->breadcrumbs)) { ?>	
			<div class="row">
				<div class="span12">
					<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
						'links' =>$this->breadcrumbs,
					)); ?>
				</div>
			</div>
		<?php } ?>	
		<!-- .Breadcrumbs -->
		<!-- Content -->	
    	<?= $content; ?>
	<!-- .Content -->
   
    <hr />
<footer>
	 
	2013 - <?=date('Y')?>. Copyright ©, Все права защищены.	

</footer>
	 
</div>

 
	
 
</body>

</html>
