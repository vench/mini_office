<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MessageController
 *
 * @author vench
 */
class MessageController extends BaseController  {
    
   /**
    * Specifies the access control rules.
    * This method is used by the 'accessControl' filter.
    * @return array access control rules
    */
    public function accessRules() {
        return array(
            array('allow',   
                'actions'=>array('Delete',),
                'roles'=>array('message.remove'),
            ),
            array('allow',   
                'actions'=>array('Index', 'AsRead','CreateMessage', 'arhive', 'ToArhive'),
                'users'=>array('@'),
            ), 
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }
    
    /**
     * 
     */
    public function actionIndex($from = 0) {
        
        $message = new Message('search');
        $message->unsetAttributes();
        if(isset($_REQUEST['Message'])) {
            $message->setAttributes($_REQUEST['Message']);
        }
        $message->arhive = 0;
        if($from == 1) {
           $message->user_id = Yii::app()->user->getId();
        } else {
           $message->user_to_id = Yii::app()->user->getId();
        }
   
        $this->render('index', array(
            'message'=>$message,
            'from'=>$from,
        ));
    }
    
    
    
    /**
     * 
     * @param type $from
     */
    public function  actionArhive($from = 0) {
        $message = new Message('search');
        $message->unsetAttributes();
        if(isset($_REQUEST['Message'])) {
            $message->setAttributes($_REQUEST['Message']);
        }
        $message->arhive = 1;
        
        if($from == 1) {
           $message->user_id = Yii::app()->user->getId();
        } else {
           $message->user_to_id = Yii::app()->user->getId();
        }
   
        
        $this->render('arhive', array(
            'message'=>$message,
            'from'=>$from,
        ));
    }
    
    /**
     * 
     * @param type $id ID Message
     */
    public function actionAsRead($id) {
       $model = Message::model()->findByPk($id, 'is_new = 1'); 
       if(!is_null($model)) {
           $model->is_new = 0;
           $model->save();
       }
       Yii::app()->end();
    }
    
    /**
     * 
     * @param type $id
     */
    public function actionToArhive($id) {
        $model = $this->loadModelByPk('Message', $id);
        $model->arhive = 1;
        $model->save();
        $this->redirect(array('index'));
    }
    
    /**
     * 
     * @param type $to 
     */
    public function actionCreateMessage($to = NULL) {
        $usersTo = array();
        if(isset($_REQUEST['to'])) {
            $models = User::model()->findAllByPk($_REQUEST['to']); 
            $usersTo = CHtml::listData($models, 'id', 'FullName');
        }
        $message = new Message();
        $message->user_id = Yii::app()->user->getId();
        if(isset($_REQUEST['Message'])) {
            $message->setAttributes($_REQUEST['Message']);
            if($message->validate() && sizeof($usersTo) > 0) {
                foreach($usersTo as $key=>$user) {
                    $mess = clone $message;
                    $mess->user_to_id = $key;
                    $mess->save();
                }
                $this->redirect(array('index'));
            }
        }
        $this->render('createMessage', array(
            'message'=>$message,       
            'usersTo'=>$usersTo,
        ));
    }
    
    /**
     * 
     * @param type $id
     */
    public function actionDelete($id) {
        $model = $this->loadModelByPk('Message', $id);
        $model->delete();
        $this->redirect(array('index'));
    }
    
    /**
     * 
   
    public function actionAjaxUserList() {
        $data = array();
        if (isset($_GET['term'])) {
            $term = CHtml::encode($_GET['term']);
            $users = User::model()->findAll(array(
                'condition'=>"name LIKE '%:name%' OR patronymic LIKE '%:patronymic%' OR surname LIKE '%:surname%'",
                'params'=>array(
                    ':name'=>$term,
                    ':patronymic'=>$term,
                    ':surname'=>$term,
                ),
                'select'=>'id, name,patronymic, surname',
            )); 
            foreach($users as $user) {
                $data[] = array('label'=>$user->getFullName(), 'id'=>$user->id); 
            }
        }
        
        echo CJSON::encode($data); 
        Yii::app()->end(); 
    }  */
    
    public function getUserList() {
        $data = array();
         $users = User::model()->findAll(array( 
                'select'=>'id, name,patronymic, surname',
         ));  
         foreach($users as $user) {
                $data[] = array('label'=>$user->getFullName(), 'id'=>$user->id); 
        }
        return $data;
    }
}

?>
