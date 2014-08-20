<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TabelUsers
 *
 * @author vench
 */
class TabelUsers extends CWidget {
    //put your code here
    
    /**
     * Список пользователей
     * @var array 
     */
    public $models;
    
    /**
     *
     * @var type 
     */
    public $time;
    
    /**
     *
     * @var type 
     */
    public $actionTabel = '/tabel';
    
    /**
     *
     * @var type 
     */
    public $actionTabelUser = '/tabel/user';

    /**
     * 
     */
    public function run(){
        $this->render('tabelUsers', array(
            'models'=>$this->models,
            'time'=>$this->time,
        ));
    }
    
    /**
     * 
     * @return int
     */
    public function getTimeBack() { 
        return Utill::timeRemoveMonth($this->time);
    }
    
    /**
     * 
     * @return int
     */
    public function getTimeNext() { 
        return Utill::timeAddMonth($this->time);
    }
}

?>
