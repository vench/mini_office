<?php
$this->pageTitle = 'Бланки документов ' ;
$this->breadcrumbs = array('Бланки документов ' );
?>

<h1>Бланки документов</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$model->search(),
'itemView'=>'_view',
)); ?>