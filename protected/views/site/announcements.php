<?php

$this->pageTitle = 'Важные объявления';
$this->breadcrumbs = array('Важные объявления' );
?>
<h1>Важные объявления</h1>
<div class="alert alert-info">
		
                <?php
                $advertModel = new Advert('search');
                $advertModel->important = 1;
                $this->widget('bootstrap.widgets.TbListView',array(
                    'id'=>'advert-grid',
                    'dataProvider'=>$advertModel->search(),                
                    'itemView'=>'/advert/_view',
                ));
                ?>
            </div> 