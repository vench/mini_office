<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$this->pageTitle = 'Табель';
$this->breadcrumbs = array(
    'Табель посещений'=>array('/tabel'),
    'Табель пользователя'=>array('/tabel/user', 'time'=>time(), 'uid'=>$model->id),
    'Установка отклонения'
 );
?>

<h1>Установка отклонения <small><?php echo $model->getFullName();?></small></h1> 

<?php $this->renderPartial('_form', array(
    'model'=>$userWorkDeviations
));?>