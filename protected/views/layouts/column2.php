<?php
$this->beginContent('//layouts/main');


array_unshift($this->menu, array(
                'label' => 'Меню',
                'itemOptions' => array('class' => 'nav-header')
));
?>

<div class="row-fluid">

<div class="span2"> 
    <div class="menu">        
        <?php
        //nav nav-pills nav-stacked
        $this->widget('bootstrap.widgets.TbMenu', array(
            'items'=> $this->menu,   
            'type'=>'list', 
        ));   
        
        ?>
    </div>
</div>
    <div class="span10">
 
<?php    echo $content; ?>    
     </div>
 </div>   
<?php    
$this->endContent();
?>
