<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RaccesController
 *
 * @author vench
 */
class RaccessController extends BaseController {

     /**
    * Specifies the access control rules.
    * This method is used by the 'accessControl' filter.
    * @return array access control rules
    */
    public function accessRules() {
        return array(
            array('allow',   
                'actions'=>array('Index', 'update','addRole', 'RemoveRole'),
                'roles'=>array('srules'),
            ), 
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }
    
    /**
     * 
     */
    public function actionIndex() {
        
        $user = new User('search');
        $user->unsetAttributes();
        if(isset($_REQUEST['User'])) {
            $user->setAttributes($_REQUEST['User']);
        }
        
        $this->render('index', array(
            'user'=>$user,
        ));
    }
    
    /**
     * 
     * @param type $id ID User
     */
    public function actionUpdate($id) {
        $user = $this->loadModelByPk('User', $id);
        
        $this->render('update', array(
            'user'=>$user,
        ));
    }
    
    /**
     * 
     * @param type $id
     * @param type $name
     */
    public function actionAddRole($id, $name) {
        $user = $this->loadModelByPk('User', $id);
        $auth=Yii::app()->authManager;
        $auth->assign($name, $user->getPrimaryKey());
        $this->redirect(array('update', 'id'=>$user->getPrimaryKey()));
    }
    
    /**
     * 
     * @param type $id
     * @param type $name
     */
    public function actionRemoveRole($id, $name) {
        $user = $this->loadModelByPk('User', $id);
        $auth=Yii::app()->authManager;
        $auth->revoke($name, $user->getPrimaryKey());
        $this->redirect(array('update', 'id'=>$user->getPrimaryKey()));
    }
}

?>
