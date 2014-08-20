<div class="alert <?php echo ($data->is_new == 0) ? "alert-info" : "alert-success";?>">   	 
    
    
    
    <div class="row-fluid">
        <div class="span8">
            
            <h3><?php if($data->is_new == 1) :?><small><i class="icon-envelope"></i> Новое!</small><?php endif; ?> <?php echo $data->subject?><br/>
        <small> дата: <?php echo $data->datetimeStr()?> | 
            <?php if($from == 0) { ?>
            отправитель:  <?php echo $data->user->getFullName()?>
            <?php } else {?>
            получатель:  <?php echo $data->userTo->getFullName()?>
            <?php }?>
        </small></h3>
    
        </div>
        
        <div class="span4">
            
            <div class="btn-group">
        <?php echo CHtml::link('Просмотр', 'javascript:;', array(
            'class'=>'btn btn-mini btn-info viewDetail',
        ));?>
        <?php 
        
        if($from == 0 && !$data->isArhive()) {
            echo CHtml::link('Ответить', array('createMessage', 'to'=>$data->user_id), array(
                'class'=>'btn btn-mini btn-primary answer',
            ));
        }?>
        <?php 
         if(!$data->isArhive()) {
            echo CHtml::link('В архив', array('toArhive', 'id'=>$data->id), array(
                'class'=>'btn btn-mini btn-warning arhive',
            ));
         }   
        ?>
        <?php        
        if(Yii::app()->user->checkAccess('message.remove')) {
        echo CHtml::link('Удалить', array('delete', 'id'=>$data->id), array(
            'class'=>'btn btn-mini delete btn-danger',
        ));
        }
        ?>
    </div>
        </div>
    </div> 
    
    <hr/>
    
    <div data-pk="<?php echo $data->id; ?>" class="hide messText  <?php if($data->is_new == 1) :?>new<?php endif; ?> "><?php echo $data->text?></div>
    
</div>