<?php
$this->pageTitle = 'Документы ' ;
$this->breadcrumbs = array('Документы ' );
?>

<h1>Документы</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$model->search(),
'itemView'=>'_view', 
)); ?>