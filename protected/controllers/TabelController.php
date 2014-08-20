<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TabelController
 *
 * @author vench
 */
class TabelController extends BaseController {
    
    
    /**
    * Specifies the access control rules.
    * This method is used by the 'accessControl' filter.
    * @return array access control rules
    */
    public function accessRules()
    {
       return array(
            array('allow',   
                'actions'=>array('User', 'UpdateUWD','DeleteUWD', 'AddUserWorkDeviation'),
                'roles'=>array('tabel'),
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
    public function actionIndex($time = NULL) {
        if(is_null($time)) {
            $time = time();
        }
        $models = User::model()->findAll(array(
            'with'=>array(
                'userWorkDeviations'=>array(
                'on'=>'datestart <= :t2 AND dateend >= :t1 ',
                'params'=>array(
                     ':t1'=>Utill::timeToMinMonth($time),
                     ':t2'=>Utill::timeToMaxMonth($time),
                 ),   
            )),
            'order'=>'subdivision_id ',
        ));
        $this->render('index', array(
            'models'=>$models,
            'time'=>$time,
        ));
    }
    
    /**
     * 
     * @param type $time
     * @param type $uid
     */
    public function actionUser($time,$uid) {
       $model = $this->loadModelByPk('User', $uid);
       $userWorkDeviations = new UserWorkDeviation('search');
       $userWorkDeviations->user_id = $uid;
      
       $this->render('user', array(
            'model'=>$model,
            'time'=>$time,
            'userWorkDeviations'=>$userWorkDeviations,
        )); 
    }
    
    /**
     * 
     * @param type $id ID UserWorkDeviation
     */
    public function actionUpdateUWD($id) {
        $model = $this->loadModelByPk('UserWorkDeviation', $id);
        $model->datestart = $model->datestartStr();
        $model->dateend = $model->dateendStr();
        $model->set_user_id = Yii::app()->user->getId();
        if($this->validateAndSaveModel($model)) {
            $this->redirect(array('/tabel/user', 'time'=>time(), 'uid'=>$model->user_id));
        }
        $this->render('updateUW', array( 
            'model'=>$model,
        )); 
    }
    
    /**
     * 
     * @param type $id ID UserWorkDeviation
     */
    public function actionDeleteUWD($id) {
        $this->ensure(Yii::app()->request->isPostRequest, 'Только POST');
        $model = $this->loadModelByPk('UserWorkDeviation', $id);
        $model->delete();
        if(!isset($_GET['ajax'])) {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
    }
    
    /**
     * 
     * @param type $uid ID User
     */
    public function actionAddUserWorkDeviation($uid) {
        $model = $this->loadModelByPk('User', $uid);
        $userWorkDeviations = new UserWorkDeviation();
        $userWorkDeviations->set_user_id = Yii::app()->user->getId();
        $userWorkDeviations->user_id = $uid;
        if($this->validateAndSaveModel($userWorkDeviations)) {
            $this->redirect(array('/tabel/user', 'time'=>time(), 'uid'=>$uid));
        }
        $this->render('addUserWorkDeviation', array(
            'model'=>$model, 
            'userWorkDeviations'=>$userWorkDeviations,
        ));
    }
}

?>
