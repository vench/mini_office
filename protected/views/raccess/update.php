<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$this->breadcrumbs=array(
	'Права доступа'=>array('/raccess'),
        'Управление правами пользователя'
);
?>
<h1>Управление правами пользователя <small><?php echo $user->getFullName()?></small></h1>

<?php
$auth=Yii::app()->authManager;
$tasks = $auth->getAuthItems(0);
$taskAdd = array();
$taskIsset = array();
foreach($tasks as $task) {
    if($task->isAssigned($user->getPrimaryKey())) {
       $taskIsset[$task->getName()] = $task->getDescription();
    } else {
       $taskAdd[$task->getName()] = $task->getDescription(); 
    }    
}

echo CHtml::beginForm(array('addRole'), 'get', array(
    'class'=>'form-inline',
));
echo CHtml::hiddenField('id', $user->getPrimaryKey());
echo CHtml::dropDownList('name', NULL, $taskAdd, array(
    'class'=>'span4',
    'empty'=>'--Действие--',
)); 
?>
<?php
echo CHtml::button('Добавить', array(
    'type'=>'submit',
    'class'=>'btn btn-primary',
));
echo CHtml::endForm();
?>

<?php
if(sizeof($taskIsset) > 0) {?>
<ol>
<?php    
foreach($taskIsset as $name=>$descript) { ?>
<li><?php echo $descript; ?> 
    <?php echo CHtml::link('<i class="icon-remove"></i>', array(
        'removeRole', 'id'=>$user->getPrimaryKey(), 'name'=>$name), array(
            'title'=>'Удалить',
        )); ?> 
    </li>
<?php }?>
</ol> 
<?php    
}
?>
