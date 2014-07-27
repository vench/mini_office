<?php

class WebUser extends CWebUser
{
	
   public $rightsReturnUrl; 
    
   /**
    *
    * @var User 
    */ 
   private $_model = null; 
    
   /**
    * Количество новых сообщений у пользователя
    * @var int 
    */
   private $_count_mes = NULL;
	
   /**
    * 
    * @return User
    */
   public function getModel() {
        if (!$this->isGuest && is_null($this->_model)) {
            $this->_model = User::model()->findByPk($this->getId());
        }
        return $this->_model;
    }
	
    /**
     * 
     * @return boolean
     */
    public function isSuperAdmin(){
	 return !is_null($this->getModel())  && $this->getModel()->isSuperAdmin(); 
    }

    /**
     * Количество новых сообщений у пользователя
     * @return int
     */
    public function getCountNewMess() {
        if(is_null($this->_count_mes)) {
            $m = Message::model()->find(array(
                'condition'=>'is_new=1 AND user_to_id = :user_to_id',
                'params'=>array(
                    ':user_to_id'=>$this->getId(),
                ),
                'select'=>'COUNT(*) AS agrValue'
            ));
            $this->_count_mes = isset($m) ? ($m->agrValue) : 0;
        }
        return $this->_count_mes;
    }

    
    /**
     * 
     * @param type $operation
     * @param type $params
     * @param type $allowCaching
     * @return boolean
     */
    public function checkAccess($operation, $params = array(), $allowCaching = true) { 
        if($this->isSuperAdmin()) {  
            return true;
        } 
        return parent::checkAccess($operation, $params, $allowCaching);
    }

    /**
     * 
     * @param type $name
     * @param type $parameters
     * @return type
     */
    public function __call($name, $parameters) {
        if(method_exists($this->getModel(), $name))  {
            return call_user_func_array(array($this->getModel(), $name), $parameters); 
        }
          
        return parent::__call($name, $parameters);
    }
     
}

?>
