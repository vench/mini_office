<?php

class DefaultController extends CController
{
	/**
	 * layout
	 */
	public $layout='/layouts/default';
	
	/**
	*
	*/
	public function accessRules() {
       return array(  
            array('allow',  // allow all users 
                'users'=>array('@'),
            ),
            array('deny',  // deny all users
                'users'=>array('?'),
            ), 
        ); 
    }

	/**
	*
	*/
	public function actionIndex() {
		$vsChat = new VsChat();
		$vsChat->user_from = Yii::app()->user->getId();
		
		//инициализация сообщения
		if(isset($_POST['VsChat'])) {
			$vsChat->attributes = $_POST['VsChat'];
			$vsChat->expire = time();
			$vsChat->is_new = 1;
			if($vsChat->validate() && $vsChat->save()) {
				$this->addUserChat($vsChat->user_to);
				$this->setLastAddId($vsChat->user_to);
				$this->redirect(array('index'));
			}
		}
		//var_dump($this->getLastAddId());
		$stackChat = array();
		$stackChat[] = array( 
			'Новый чат', $vsChat, is_null($this->getLastAddId()), 
		);
		$users = User::getListTree();		
		$stack = $this->getUserStack();
		foreach($stack as $userId) {
			$model = clone $vsChat; 
			$model->user_to = $userId;
			$stackChat[] = array( 
				$model->userTo->getFullName(), $model, $this->getLastAddId() == $userId,  
			);
		}
		 
		$this->render('index', array(
			'stackChat'=>$stackChat,
			'users'=>$users,
		));
	}
	
	/**
	* Получить список чатов
	*/
	public function actionLoadChat($from) { 
             
		$models = VsChat::model()->findAll(array(
			'condition'=>'(user_to = :user_to AND user_from = :user_from) OR (user_to = :user_to1 AND user_from = :user_from1)',
			'params'=>array(
				':user_to'=>Yii::app()->user->getId(),
				':user_from'=>$from,
				':user_to1'=>$from,
				':user_from1'=>Yii::app()->user->getId(),
			),
			'order'=>'expire desc',
			'limit'=>'100',
			'with'=>array('userFrom'),
		));
                
                if(!is_null($models)) {
                    VsChat::model()->updateAll(array('is_new'=>0), 'user_to = :user_to AND user_from = :user_from', array(
                        ':user_to'=>Yii::app()->user->getId(),
			':user_from'=>$from,
                    )); 
                }
		
		$this->renderPartial('_chatList', array(
			'models'=>$models,			 
		));
		 
		Yii::app()->end();
	}
        
        /**
         * Проверка наличия новых сообщений для пользователя.
         */
        public function actionCheckNew() {
            $model = VsChat::model()->find('is_new = 1 AND user_to = :user_to', array(
                ':user_to'=>Yii::app()->user->getId(),
            ));
            echo is_null($model) ? 0 : 1;
            Yii::app()->end();
        }
        
        /**
         * Показать список новых диалогов
         */
        public function actionShowListNews() {
            $models = VsChat::model()->findAll(array(
                'condition'=>'is_new = 1 AND user_to = :user_to',
                'params'=>array(
                    ':user_to'=>Yii::app()->user->getId(),                
                ),
                'group'=>'user_to,user_from',
                'select'=>'user_to,user_from',
            ));
            
            $this->renderPartial('_listNews', array(
			'models'=>$models,			 
		));
            
            Yii::app()->end();
        }
        
        /**
         * Выбор чата
         * @param type $to ид пользователя
         */
        public function actionSelectChat($to) {
            $this->addUserChat($to);
            $this->setLastAddId($to);
            $this->redirect(array('index'));
        }
        

                /**
	*
	*/
	public function actionRmChat($id) {
		$this->removeUserChat($id);
		$this->redirect(array('index'));
	}
	
	/**
	* @return string
	*/
	protected function getNameStack() {
		return  __CLASS__.'Stack';
	}
	
	/**
	* @return array
	*/
	protected function getUserStack() {
		if(!isset(Yii::app()->session[$this->getNameStack()])) {
			Yii::app()->session[$this->getNameStack()] = array();
		}
		return Yii::app()->session[$this->getNameStack()];
	}
	
	/**
	*
	*/
	protected function addUserChat($user_id) { 
		$stack = isset(Yii::app()->session[$this->getNameStack()]) ? Yii::app()->session[$this->getNameStack()] : array();		
		if(!isset($stack [$user_id])) {
			$stack [$user_id] = $user_id;
			Yii::app()->session[$this->getNameStack()] = $stack;
			$this->setLastAddId($user_id);
		}
	}
	
	/**
	*/
	protected function getLastAddId() {
		return isset(Yii::app()->session[$this->getNameStack().'id']) ? Yii::app()->session[$this->getNameStack().'id'] : NULL;
	}
	
	/**
	*/
	protected function setLastAddId($user_id) {
		Yii::app()->session[$this->getNameStack().'id'] = $user_id;
	}
	
	/**
	*
	*/
	protected function removeUserChat($user_id) {
		$stack = isset(Yii::app()->session[$this->getNameStack()]) ? Yii::app()->session[$this->getNameStack()] : array();
		if(isset($stack[$user_id])) {
			unset($stack[$user_id]);
		}
		$this->setLastAddId(NULL);
		Yii::app()->session[$this->getNameStack()] = $stack;
	}
}