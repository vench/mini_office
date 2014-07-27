<?php
/* @var $this VsChatController */
/* @var $model VsChat */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'vs-chat-_form-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	'clientOptions' => array(
                    'validateOnSubmit' => true,
                ),
)); ?>
 

  <?php /* echo $form->errorSummary($model); */ ?>

 	 
		<?php 
		if($model->user_to > 0) {
			echo $form->hiddenField($model,'user_to');
		} else {
			echo $form->dropDownListRow($model,'user_to',$users,array('class'=>'span5','empty'=>'-------',)); 
		}
		?>	 
	 
	 <?php   if($model->user_to > 0) {?>
	 <div style="height:100px; overflow:auto;" class="chatList"></div>
	 <?php }  ?>
	 
	 <?php /* if($model->user_to > 0) {?> <?php } */ ?>
 
 	<?php echo $form->redactorRow($model,'comment',array(
                'rows'=>6, 
                'cols'=>50, 
                'class'=>'', 
				'id'=>'comment_'. mt_rand(0, 255).'_'.mt_rand(0, 255),
				'options'=>array(
					'buttons' => array(
						'formatting', '|', 'bold', 'italic', 'deleted', '|', 'alignment', '|', 'unorderedlist', 'orderedlist',
					)
				)
		 ) ); ?>

 


	 
	<div class=""> <br>
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary', 
			'label'=>'Отправить',
			'htmlOptions'=>array(
				'class'=>'btn-small',
			)
		)); ?>
	<?php
	if($model->user_to > 0) {
		echo CHtml::link('Закрыть чат', array('rmChat', 'id'=>$model->user_to), array(
			'class'=>'btn btn-danger floatRight btn-small',
		)); 
	}	
	 ?>
</div>
	
<?php $this->endWidget(); ?>

</div><!-- form -->