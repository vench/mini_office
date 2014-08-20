<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$this->breadcrumbs=array(
	'Личные сообщения'=>array('index'),
        'Написать сообщение'
);
?>
<h1>Написать сообщение</h1>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'message-form',
	'enableAjaxValidation'=>false,
)); ?>


<?php echo $form->errorSummary($message); ?>


<?php
echo $form->labelEx($message, 'user_to_id'); 

?>
<div id="user_to_id_show" class="alert alert-info ">
    <?php if(sizeof($usersTo) > 0) {?>
    <?php foreach($usersTo as $id=>$userName) {?>
    <p><?php echo CHtml::hiddenField('to[]', $id); ?>
        <span><?php echo $userName;?></span>
        <a href="javascript:;" class="removeItemTo"><i class="icon-remove"></i></a>
    </p>  
    <?php }?>
<script type="text/javascript">
    $('a.removeItemTo').click(function(){
        $(this).parent().remove();
        return false;
    });
</script>
    <?php }?>
</div>  


<?php  
 
$this->widget('zii.widgets.jui.CJuiAutoComplete',array(
    'name'=>'toLabels[]', 
    'source'=>$this->getUserList(),//$this->createUrl('ajaxUserList'),  
    'options'=>array(
        'minLength'=>'0',
        'showAnim'=>'fold', 
        'select'=>'js:function( event, ui ) {
            var sho = $("#user_to_id_show"),
                $p = $("<p/>"),
                $in = $("<input type=\"hidden\" name=\"to[]\" />"),
                $s = $("<span/>"),
                $a = $("<a href=\"javascript:;\"><i class=\"icon-remove\"></i></a>")
            $in.val(ui.item.id);
            $s.html(ui.item.value);
            $p.append($in,$s," ", $a);  
            sho.append($p);  
            $a.click(function(){
                $(this).parent().remove();
                return false;
            });
            this.value = "";
            return false;
        }',
    ),
    'htmlOptions'=>array(
        'class'=>'span6',
         'placeholder'=>'Выберите пользователя и нажмите “Ввод/Enter” ',
    ),
));
?>

<?php

echo $form->textFieldRow($message, 'subject', array('class'=>'span6'));
?>

<?php
echo $form->labelEx($message, 'text');
$this->widget('bootstrap.widgets.TbHtml5Editor', array(
    'model'=>$message,
    'attribute'=>'text',
    'lang'=>'ru',
    
));
?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Отправить',
		)); ?>
</div>

<?php $this->endWidget(); ?>