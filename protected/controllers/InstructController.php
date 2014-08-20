<?php

class InstructController extends BaseController
{

	/**
    * Specifies the access control rules.
    * This method is used by the 'accessControl' filter.
    * @return array access control rules
    */
    public function accessRules()
    {
       return array(
            array('allow',   
                'actions'=>array('create', 'remove', 'changeStatusFrom'),
                'roles'=>array('instruct.set'),
            ), 
            array('allow',  // allow all users
                'actions'=>array('index', 'changeStatus',),
                'users'=>array('@'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
           
        ); 
    }

	public function actionIndex($from = 0)
	{	
		$model = new Instruct('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Instruct'])) {
			$model->attributes=$_GET['Instruct'];
		}
		if($from == 0) {
			$model->user_id = Yii::app()->user->getId();
		} else {
			$model->user_to_id = Yii::app()->user->getId();
		}			
			
		$this->render('index', array(
			'dataProvider'=>$model->search(),
			'from'=>$from,
		));
	}
	
	/**
	* Создаем поручение
	*/
	public function actionCreate() {
		$model = new Instruct();
		$model->user_id = Yii::app()->user->getId();
		$model->datecreate = time();
		if($this->validateAndSaveModel($model)) {
			$model->sendMessages();
			$this->redirect(array('index'));
		}
		$this->render('create', array(
			'model'=>$model,
		));
	}
	
	/**
	* Удаление задания
	*/
	public function actionRemove($id) {
		$model = $this->loadModelByPk('Instruct', $id);
		$model->delete();
		$this->redirect(array('index', 'from'=>0));
	}
	
	/**
	* Смена статуса от заказчика
	*/
	public function actionChangeStatusFrom($id, $status) {
		$model = $this->loadModelByPk('Instruct', $id);
		$this->ensure($model->user_id == Yii::app()->user->getId(), 'Поручение не принадлежит вам');
		$model->status = $status;
		$model->save(false);
		$this->redirect(array('index', 'from'=>0));
	}
	
	/**
	* Смена стутуса
	*/
	public function actionChangeStatus($id, $status) {
		$model = $this->loadModelByPk('Instruct', $id);
		$this->ensure($model->user_to_id == Yii::app()->user->getId(), 'Поручение не принадлежит вам');
		$model->status = $status;
		$model->save(false);
		$this->redirect(array('index', 'from'=>1));
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}