<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
 
$this->pageTitle = 'Добавить объявление ';
$this->breadcrumbs = array(
    'Объявления'=>array('index'),
    'Добавить объявление  ' );
?>

<h1>Добавить объявление </h1>
<?php
$this->renderPartial('_form', array(
   'model'=>$advertModel, 
));
?>