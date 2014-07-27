<?php
$this->pageTitle = 'Структура предприятия ' ;
$this->breadcrumbs = array('Структура предприятия ' );
?>

<h1>Структура предприятия</h1>


<?php
foreach($models as $model) {
    $this->renderPartial('_structure', array(
        'model'=>$model,
    ));
}

?>