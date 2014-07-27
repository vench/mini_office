<!DOCTYPE html>
<html lang="ru">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    
	<title><?= CHtml::encode($this->pageTitle.' | ' . Yii::app()->name); ?></title>
	
	<?php Yii::app()->getClientScript()->registerCssFile( Yii::app()->request->baseUrl.'/css/style.css'); ?>
	<?php Yii::app()->getClientScript()->registerCssFile( Yii::app()->request->baseUrl.'/css/chosen/chosen.css'); ?>
	
    <?php Yii::app()->getClientScript()->registerScriptFile( Yii::app()->request->baseUrl.'/js/main.js'); ?>
    <?php Yii::app()->getClientScript()->registerScriptFile( Yii::app()->request->baseUrl.'/js/chosen.jquery.min.js'); ?>
    <?php Yii::app()->clientScript->registerScript(
		'tab_choice', "$('.btTabs a:contains(\"".CHttpRequest::getParam("tab")."\")').tab('show');", 
	CClientScript::POS_READY); ?>   
    
</head>

<body>
<?php $this->renderPartial('//layouts/_main_menu', array()); ?>

	<div class="container pr100" id="page">
		
		
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
		<!-- Footer -->
		<?php $this->widget('application.widgets.Footer', array(
			'startYear' => 2013,
			'text' => 'Copyright &copy;, Все права защищены.',
		)); ?>
		<!-- .Footer -->
	</div>
	
	<div id="scroller">
		<div class="btn-group btn-group-vertical">
			<a class="btn" title="Вверх" id="up"><i class="icon-arrow-up"></i></a>
			<a class="btn" title="Вниз" id="down"><i class="icon-arrow-down"></i></a>
		</div>
	</div>
</body>
</html>	
