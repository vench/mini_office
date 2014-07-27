<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Класс реализует авторизацию пользователя по логину и паролю на основании записи в БД.
 *
 * @author v.raskin
 */
class UserIdentityDB extends CUserIdentity {
    //put your code here
    
    protected $_id;
    
    
    public function authenticate() {
        $model = User::model()->find('actual = 1 AND login = :login', array(
            ':login'=>$this->username,
        ));
        if(!is_null($model)) { 
            if($model->password !== User::cryptPass($this->password)) {
                $this->errorCode = self::ERROR_PASSWORD_INVALID; 
            } else {
                $this->_id = $model->getPrimaryKey();
                $this->errorCode = self::ERROR_NONE; 
            }  
        } else {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        }
        
        return !$this->errorCode;
    }
    
    /**
     *
     * @return int 
     */
    public function getId() {
       return $this->_id;
    }
}

?>
