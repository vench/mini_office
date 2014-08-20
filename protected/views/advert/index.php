<?php
$this->pageTitle = 'Объявления ';
$this->breadcrumbs = array('Объявления ' );
?>

<h1>Объявления</h1>
<?php

if($this->userCheckAccess('adverts')) {
    echo CHtml::link('Создать объявление', array('add'), array(
        'class'=>'btn btn-large',
    ));
} 
$this->widget('bootstrap.widgets.TbListView',array(
                    'id'=>'advert-grid',
                    'dataProvider'=>$advertModel->search(),                
                    'itemView'=>'_view',
                ));

?>
