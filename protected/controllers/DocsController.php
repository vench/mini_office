<?php
class DocsController extends BaseController
{

    /**
    * Specifies the access control rules.
    * This method is used by the 'accessControl' filter.
    * @return array access control rules
    */
    public function accessRules() {
        return array(
           /* array('allow',   
                'actions'=>array('*'),
                'roles'=>array('events'),
            ), 
            array('deny',  // deny all users
                'users'=>array('*'),
            ),*/
            
            array('allow',  // deny all users 
                'users'=>array('@'),
            ),
			 array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }
	
	public function actionIndex() {
	
	}
	
	/**
	*blanks Список документов
	*/
	public function actionBlanks() {	 
		$model=new Documents('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Documents']))
            $model->attributes=$_GET['Documents']; 
		$model->type = Documents::TYPE_BLANKS;
		$this->render('blanks', array(
			'model'=>$model,
		));
	}
	
	/**
	* Дать скачать файл
	*/
	public function actionDownload($id) {
		$model = $this->loadModelByPk('Documents', $id);
		$this->ensure($model->isFileExists(), 'Файл не существует!');
		$model->download();		
	}

}