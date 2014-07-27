<?php

class UserIdentityModel extends CUserIdentity {

	/**
	* @var User
	*/
	private $model;

	public function __construct(User $model) {
		$this->model = $model;
	}
	
	    /**
     *
     * @return int 
     */
    public function getId() {
       return $this->model->getPrimaryKey();
    }
}
?>