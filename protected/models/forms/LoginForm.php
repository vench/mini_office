<?php

class LoginForm extends CFormModel
{
	public $username;
	public $password;
	public $rememberMe;
	
        /**
         *
         * @var CUserIdentity 
         */
	private $_identity;
	
        /**
         *
         * @return CUserIdentity 
         */
	public function getIdentity()
	{
            return $this->_identity;
        }
	
	public function rules()
	{
		return array(
			array('username, password', 'required'),
			array('password', 'authenticate'),
			array('rememberMe', 'boolean'),
		);
	}
	
	public function attributeLabels()
	{
		return array(
			'username' => 'Логин',
            'password' => 'Пароль',
			'rememberMe' => 'Запомнить',
		);
	}
	
	public function authenticate($attribute, $params)
	{
		if(!$this->hasErrors())
		{
			$this->_identity = new UserIdentityDB($this->username, $this->password);
			if(!$this->_identity->authenticate())
				$this->addError('password', 'Неверный логин или пароль.');
		}
	}
	
	public function login()
	{
		if($this->_identity === NULL)
		{
			$this->_identity = new UserIdentityDB($this->username, $this->password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode === UserIdentityDB::ERROR_NONE)
		{
			$duration=$this->rememberMe ? 3600 * 24 * 30 : 0; // 30 days
			Yii::app()->user->login($this->_identity, $duration);
			return true;
		}
		else
			return false;
	}
}

?>