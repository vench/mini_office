<?php

/**
 * 
 */
class SiteController extends BaseController {

    
        //
    
        /**
       * Specifies the access control rules.
       * This method is used by the 'accessControl' filter.
       * @return array access control rules
       */
       public function accessRules() {
           return array( 
               array('deny',  // deny all users
                   'actions'=>array('requestappointment', 'negotiating'),
                   'users'=>array('?'),
               ),
           );
       }  
       
       /**
        * 
        * @return array
        */
       public function actions(){
        return array(
            'captcha'=>array(
                'class'=>'CCaptchaAction',
            ),
        );
    }
    
       
    
	/** 
	*/
	public function actionIndex() {
		$this->render('index2');
	}
        
        /**
         * События сегодня
         */
        public function actionEventNow() {
            $this->render('eventNow');            
        }
        
        /**
         * События завтра
         */
        public function actionEventTomorow() {
            $this->render('eventTomorow'); 
        }
        
         /**
         * Важные объявления
         */
        public function actionAnnouncements() {
            $this->render('announcements'); 
        } 
        
         /**
         * Распорядок дня
         */
        public function actionRoutine() {
            $this->render('routine'); 
        }  
        
         public function actionBirthday() {
            $this->render('birthday'); 
        }  
        
        /**
         * 
         */
        public function actionStructure() {
                $models = Subdivision::model()->findAll(array(
                    'condition'=>'t.parent_id=0 OR t.parent_id IS NULL',
                    'with'=>array('users'=>array(
                        'with'=>'post'
                    ), 'subdivisions'),
                ));
            
                $this->render('structure', array(
                    'models'=>$models,
                )); 
        }
		
		/**
		*
		*/
		public function actionRequestappointment() {
		 
			$this->render('requestappointment', array( 
                ));
		}
        
        /**
         * 
         */
        public function actionEpsenusers() {
            $now = time();
            $models = UserWorkDeviation::model()->findAll(array(
                'condition'=>'
                    t.datestart <= :end AND t.dateend >= :start',
                'params'=>array(
                    ':start'=>$now,
                    ':end'=>$now,
                ),
                'order'=>'t.deviation_id',
                'with'=>array(
                    'user'=>array(
                    
                    ),
                    'deviation'=>array(
                        
                    )),
            ));
            $this->render('epsenusers', array(
                    'models'=>$models,
                ));
            
        }
        
        /**
         * Расписание регулярных совещаний
         */
        public function actionScheduleregular() {
            $model = new Event('search');
            //$model->cyclic=1;
            $model->type_event_id = 1; //совещания
            
             $this->render('scheduleregular', array(
                    'model'=>$model,
             ));
        }
        
        /**
         * 
         */
        public function actionWhoincomp() {
            $model = new User('search');
            $model->unsetAttributes();
            $model->actual = 1; 
            $this->render('whoincomp', array(
                    'model'=>$model,
                ));
        }
        
        /**
         * 
         */
        public function actionCmpnewusers() {
            $model = new User('search');
            $model->unsetAttributes();
            $model->actual = 1;
            $model->dateworkat = mktime(0, 0, 0, date('m'), 1);
            $this->render('cmpnewusers', array(
                    'model'=>$model,
                ));
        }

        /** 
	*/
	public function actionLogin() {
		$model = new LoginForm();		
		if (isset($_POST['ajax']) && $_POST['ajax']==='login-form'){
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		
		if (isset($_POST['LoginForm'])){
			$model->attributes = $_POST['LoginForm'];
			if ($model->validate() && $model->login()){
				$this->redirect(Yii::app()->user->returnUrl);
			}
		}		
		$this->render('login', array('model'=>$model));
	}
        
        
        /**
	 * 
	 */
	public function actionError() {
		if(($error = Yii::app()->errorHandler->error)) {
			if (Yii::app()->request->isAjaxRequest) {
				echo $error['message'];
			} else{
				$this->render('error', $error);
			}	
		}
	}
        
        /**
         * 
         */	
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
 
	
	/**
	* Бронирование переговорной
	*/
	public function actionNegotiating() {
		$this->render('negotiating', array());
	}
        
        
        /**
         * Регистрация в системе          
         * @param type $success
         */
        public function actionRegister($success = FALSE) {     
            if($success) {
                $this->render('registerOk', array(
                     'model'=>new LoginForm(),
                ));
                return;
            }
            $model = new User('register');
            if($this->validateAndSaveModel($model)) {
                $this->redirect(array('register', 'success'=>1));
            }
            $this->render('register', array(
                'model'=>$model,
            ));
        }
}

