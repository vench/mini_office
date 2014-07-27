<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	'Панель администратора',
);
?>
<h1>Панель администратора</h1>

<div class="btn-group btn-group-justified">
    <div class="btn-group">
<?php echo CHtml::link('Управление пользователями', array('/admin/user/admin'), array('class'=>'btn btn-default'));?>
 </div>
<div class="btn-group">
<?php echo CHtml::link('Управление должностями', array('/admin/post/admin'), array('class'=>'btn btn-default'));?>
 </div>
<div class="btn-group">

<?php echo CHtml::link('Управление подразделениями', array('/admin/subdivision/admin'), array('class'=>'btn btn-default'));?>
</div>
<div class="btn-group">

<?php echo CHtml::link('Управление событиями', array('/admin/event/admin'), array('class'=>'btn btn-default'));?>
</div>
<div class="btn-group">

<?php echo CHtml::link('Места/здания ', array('/admin/place/admin'), array('class'=>'btn btn-default'));?>
</div>

</div>


