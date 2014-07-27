<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$this->pageTitle = 'Табель';
$this->breadcrumbs = array(
    'Табель посещений'=>array('/tabel'),
    'Табель'
 );
?>

<h1>Табель пользователя <small><?php echo $model->getFullName();?></small></h1> 

<?php echo CHtml::link('Добавить отклонение', array(
    'addUserWorkDeviation', 'uid'=>$model->id
), array(
    'class'=>'btn btn-large btn-primary',
));?>


<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'user-grid',
'dataProvider'=>$userWorkDeviations->search(),

'columns'=>array(
		array(
                    'name'=>'id',
                    'htmlOptions'=>array(
                        'class'=>'span2',
                    ),
                ),
		array('name'=>'deviation_id',  'value'=>'$data->deviation->name'),
		array('name'=>'set_user_id',  'value'=>'$data->setuser->getFullName()'), 
		array('name'=>'datestart',  'value'=>'$data->datestartStr()'),
                array('name'=>'dateend',  'value'=>'$data->dateendStr()'),
  
		 
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{update} {delete}',
            'updateButtonUrl'=>'Yii::app()->controller->createUrl("updateUWD",array("id"=>$data->primaryKey))',
            'deleteButtonUrl'=>'Yii::app()->controller->createUrl("deleteUWD",array("id"=>$data->primaryKey))'
        ),
    ),
)); ?>