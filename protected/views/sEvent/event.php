<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$this->breadcrumbs=array(
	'Событие '.$model->name,
);
?>
<h1>Событие <small><?php echo $model->name; ?></small></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id', 
                array(
                    'name'=>'user_id',
                    'value'=>isset($model->user) ? $model->user->getFullName() : "Нет",
                ),
                array(
                    'name'=>'place_id',
                    'value'=>isset($model->place) ? $model->place->name : "Нет",
                ),
                array(
                    'name'=>'type_event_id',
                    'value'=>isset($model->typeEvent) ? $model->typeEvent->name : "Нет",
                ), 
		array(
                    'name'=>'dateevent',
                    'value'=> $model->dateeventInfo(),
                ), 
		 
			array(
				'name'=>'timestart',
				'label'=>'Время', 
				'value'=>$model->timestart.' - '. $model->timeend,
			),
		
                array(
                    'name'=>'cyclic',
                    'value'=> ($model->cyclic == 1) ? "Да" : "Нет",
                ), 
		'name',
		array(
                    'name'=>'description',
                    'type'=> "raw",
                ),
),
)); ?>

<?php if(sizeof($model->users) > 0) { ?>
         <h4>Участники</h4>
         <div class="well well-small">
        <?php
        $in = array();
        foreach($model->users as $user){?>
            <?php $in[] = $user->getFullName(); ?>    
        <?php }  
        echo join(', ', $in);
        ?>
         </div>
<?php } ?>