<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ChangePass
 *
 * @author vench
 */
class ChangePass extends CFormModel {
    public $password;
    public $password2;
    
    /**
     * @return array validation rules for model attributes.
    */
    public function rules() { 
	return array(
	    array('password, password2', 'required'),
            array('password', 'length', 'min'=>5, 'max'=>64),
            array('password', 'compare', 'compareAttribute'=>'password2', 'message'=>'Пароли не совпадают.'),
        );
    }            
                
    
    public function attributeLabels() {
        return array( 
            'password'=>'Пароль',
            'password2'=>'Повторение пароля',
        );
    }
    
   
    /**
     * 
     * @param User $model
     * @return boolean
     */
    public function change(User $model) {
        $model->password = User::cryptPass($this->password);
        return $model->save();
    }
}

?>