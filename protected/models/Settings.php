<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Класс AR настроек программы.
 *
 * @author vench
 */
class Settings  extends CActiveRecord {
    /**
     *
     * @param string $className
     * @return CActiveRecord 
     */
    public static function model($className=__CLASS__) {
	return parent::model($className);
    }
     
    /**
     * 
     * @return array
     */
    public static function getTypes() {
        return array(
            '1'=>'Число',
            '2'=>'Строка',
            '3'=>'PHP код',
        );
    }

    /**
     * Получить значение по имени.
     * @param string $name
     * @param mixed $def значение по умолчанию.
     * @return mixed
     */
    public static function value($name, $def = NULL) {
        $model = self::loadByName($name);
        return !is_null($model) ? $model->getValue() : $def;
    }
    
    /**
     * Загрузить из буфера по имени.
     * @staticvar array $bufer
     * @param string $name
     * @return Settings
     */
    public static function loadByName($name) {
        static $bufer = array();
        if(!isset($bufer[$name])) {
            $bufer[$name] = self::model()->findByPk($name);
        }
        return $bufer[$name];
    }
    
    /**
     * Получить значение настройки
     * @return mixed
     */
    public function getValue() {
        $value = $this->value;
        switch($this->type) {
            case 1: $value = (float)$value; break;
            case 3: eval("\$value=$value"); break;
            default : $value = (string)$value; break;
        }
        return $value;
    }
    
    /**
     * 
     * @return string
     */
    public function getType() {
        $types = self::getTypes();
        return $types[$this->type];
    }

    /**
     * @return string 
    */
    public function tableName() {  
	return '{{Settings}}';
    }
    
    /**
     * 
     * @return array
     */
    public function rules() {
       return array(
           array('name,descript,type,value', 'required',),
           array('name', 'unique',), 
       );
    }
    
    
    
    /**
     * Фильтр установленных значений
     */
    public function filterValue() {
        $this->value = strip_tags($this->value);
        switch($this->type) {
            case 1:  $this->value = (int)$this->value;  break;
        }
        $this->setAttribute('value', $this->value);
    }
    
    /**
     * 
     * @return array
     */
    public function attributeLabels() {
        return array(
            'name'=>'Название значения',
            'descript'=>'Описание',
            'type'=>'Тип данных',
            'value'=>'Значение',
        );
    }
    
    /**
     * 
     * @return type
     */
    protected function beforeSave() {
        $this->filterValue();
        return parent::beforeSave();
    }
    
    /**
     * 
     * @return \CActiveDataProvider
     */
    public function search() {
        $criteria = new CDbCriteria(); 		
	return new CActiveDataProvider(get_class($this), array(
		'criteria' => $criteria,
		'sort' => array(
                    'defaultOrder' => 'name',
                ),
		'pagination' => array(
                    'pageSize' => Yii::app()->params['postsPerPage']
                ), 
	));
    }
}
