<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$this->breadcrumbs=array(
	'Архив личных сообщений',
);
?>

<h1 class="">Архив личных сообщений</h1>

<div class="row-fluid">
        <div class="span6">
<?php
echo CHtml::beginForm(array('/message/arhive'), 'get', array(
    'class'=>'form-inline',
    'id'=>'switch-form',
));

echo CHtml::radioButtonList('from', $from, array(
    '0'=>'принятые',
    '1'=>'отправленные',
), array(
    'separator'=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',
));
echo CHtml::endForm();
 
?>

<script type="text/javascript">
$(function(){
    $('#switch-form input[type="radio"]').click(function(){
        this.form.submit();
    });
});
</script>

</div><div class="span6">
     <div class="btn-group right">
    <?php echo CHtml::link('Написать сообщение', array('createMessage'), array('class'=>'btn btn-large btn-primary'));?>
    <?php echo CHtml::link('Сообщения', array('index'), array('class'=>'btn btn-large btn-warning'));?>
 </div>    </div> 
</div>

<?php
$this->renderPartial('_list', array(
    'message'=>$message,
    'from'=>$from,
));
?>