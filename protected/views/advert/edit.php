<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$this->pageTitle = 'Редактировать объявление ';
$this->breadcrumbs = array(
    'Объявления'=>array('index'),
    'Редактировать объявление  ' );
?>

<h1>Редактировать объявление </h1>
<?php
$this->renderPartial('_form', array(
   'model'=>$advertModel, 
));
?>
