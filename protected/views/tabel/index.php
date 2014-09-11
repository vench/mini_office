<?php
$this->pageTitle = 'Табель посещений';
$this->breadcrumbs = array('Табель посещений' );
?>
<h1>Табель посещений <small> позволяет просмаатривать где находиться сотрудник.</small></h1>


<?php 
$this->widget('application.widgets.TabelUsers', array(
    'time'=>$time,
    'models'=>$models,
));  

 