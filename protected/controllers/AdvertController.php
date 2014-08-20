<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdvertController
 *
 * @author vench
 */
class AdvertController  extends BaseController{
    /**
    * Specifies the access control rules.
    * This method is used by the 'accessControl' filter.
    * @return array access control rules
    */
    public function accessRules()
    {
       return array(
            array('allow',   
                'actions'=>array('Add', 'Edit','Remove'),
                'roles'=>array('adverts'),
            ), 
            array('allow',  // allow all users
                'actions'=>array('index',),
                'users'=>array('*'),
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
         $advertModel = new Advert('search');
         $advertModel->unsetAttributes();
         $this->render('index', array(
             'advertModel'=>$advertModel,
         ));
    }
    
    /**
     * 
     */
    public function actionAdd() {
         $advertModel = new Advert();
         $advertModel->user_id = Yii::app()->user->getId();
         if($this->validateAndSaveModel($advertModel)) {
             $this->redirect(array('index'));
         }
         $this->render('add', array(
             'advertModel'=>$advertModel,
         ));
     }
     
     /**
     * 
     */
    public function actionEdit($id) {
         $advertModel = $this->loadModelByPk('Advert', $id);
         if($this->validateAndSaveModel($advertModel)) {
             $this->refresh();
         }
         $this->render('edit', array(
             'advertModel'=>$advertModel,
         ));
     }
     
     /**
      * 
      * @param type $id
      */
     public function actionRemove($id) {
         $advertModel = $this->loadModelByPk('Advert', $id);
         $advertModel->delete();
         $this->redirect(array('index'));
     }    
         
}

?>
