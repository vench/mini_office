<?php
 
/**
 * Базовый контроллер приложения.
 * Содержит всякие плюшки.
 *
 * @author v.raskin
 */
class BaseController extends CController
{
	/**
	 * layout
	 */
	public $layout='//layouts/layout_1_2';
	
	/**
	 * Хлебные крошки
	 * @var array 
	 */
	public $breadcrumbs = NULL;
	
	public $menu = array();
	
        /**
         * 
         * @return type
         */
        public function init() {
            Yii::app()->params['postsPerPage'] = Settings::value('postsPerPage', Yii::app()->params['postsPerPage']);
            return parent::init();
        }
        
	/**
	 *
	 * @return array 
	 */		
        public function filters() {
            return array(
                'accessControl'
            );
        }
	
	/**
	 * Проверка выражения на правильность.
	 * @param boolean $expr выражение
	 * @param string $mgs сообщение об ошибке
	 * @param integer $code код ошибки
	 * @throws CHttpException 
	 */
	public function ensure($expr, $mgs, $code = 404) {
		if(!$expr) {
			throw new CHttpException($code, $mgs);
		}
	}
	
	/**
	 * Автоматически ищет в $_REQUEST данные для класса ($model) и пытается их записать.
	 * @param CActiveRecord $model
	 * @return boolean 
	 */
	public function validateAndSaveModel(CActiveRecord $model) {
		$className = get_class($model);
		  
		if(isset($_REQUEST[$className])) { 
			$model->setAttributes($_REQUEST[$className]);
			return ($model->validate() && $model->save()); 
		}
		return false; 
	}
	
 
	/**
	 * Загрузка модели по ИД с выводом сообщения об ошибке, если модели нету.
	 * @param string $modelName Название класса модели
	 * @param integer $id ИД модели
	 * @param string $condition
	 * @param array $params
	 * @return CActiveRecord 
	 */
	public function loadModelByPk($modelName, $id, $condition = '', $params = NULL) {
		$model = CActiveRecord::model($modelName)->findByPk($id, $condition, $params);
		$this->ensure(!is_null($model), "Невозможно загрузить объект {$modelName} ({$id})");
		return $model; 
	}
	
	/**
      * Обновляем поле типа bootstrap.widgets.TbEditableField
    */
    public function actionUpdateEditableField() { 
        $pk = Yii::app()->request->getParam('pk');
        $name = Yii::app()->request->getParam('name');
        $value= Yii::app()->request->getParam('value');
        $modelName = Yii::app()->request->getParam('model');  
        $model = $this->loadModelByPk($modelName, $pk);
        $model->{$name} = $value;
        echo (int)$model->save();    
        Yii::app()->end();
    }
	
	/**
	 * 
	 */
	public function actionCreateOrDeleteEditableField() {
		$pk = Yii::app()->request->getParam('pk');
        $name = Yii::app()->request->getParam('name');
        $value= Yii::app()->request->getParam('value');
        $modelName = Yii::app()->request->getParam('model'); 
		$model = CActiveRecord::model($modelName)->findByPk($pk);
		if(is_null($model)) {
			$model = new $modelName();
			if(is_array($pk)) {
				foreach($pk as $key=>$value){
					$model->{$key} = $value;
				}
			}
			$model->save();
		} else {
			$model->delete();
		}   
        Yii::app()->end();
	}
        
        /**
         * 
         * @param type $itemName
         * @param type $params
         * @param type $allowCaching
         * @return boolean
         */
        public function userCheckAccess($itemName, $params = array(), $allowCaching = true) {
            return Yii::app()->user->checkAccess($itemName, $params, $allowCaching);
        }
}

?>
