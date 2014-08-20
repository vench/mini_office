<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Utill
 *
 * @author vench
 */
class Utill {
    //put your code here
    /**
     * 
     * @return array
     */
    public static function getYesNo() {
        return array('0'=>'Нет', '1'=>'Да'); 
    }
    
    /**
     * 
     * @param type $data
     * @param type $idParent
     * @param type $keyId
     * @param type $keyParentId
     * @param type $tree
     * @return array
     */
    public static function buildTree($data, $idParent = 0, $keyId = 'id', $keyParentId = 'parent', $tree = NULL) {
        if(is_null($tree)) {
            $tree = array();
        }
        foreach($data as $item) {
            if($item[$keyParentId] != $idParent) {
                continue;
            }
            $item['children'] = self::buildTree($data, $item[$keyId], $keyId, $keyParentId);
            $tree[] = $item;
        }
        return $tree;
    }
    
    /**
     * 
     * @param type $n
     * @return type
     */
    public static function getMonthStr($n) {
        $names = array(
                "1" => "январь",
                "2" => "февраль",
                "3" => "март",
                "4" => "апрель",
                "5" => "май",
                "6" => "июнь",
                "7" => "июль",
                "8" => "август",
                "9" => "сентябрь",
                "10" => "октябрь",
                "11" => "ноябрь",
                "12" => "декабрь");
         $n = (int)$n;
         return isset($names[$n]) ? $names[$n] : '';
    }
    
    /**
     * 
     * @param type $n
     *  @return type
     */
    public static function getWeekDayStr($n) {
        $names = array(
            '1'=>'пн','2'=>'вт','3'=>'ср','4'=>'чт','5'=>'пт','6'=>'сб','0'=>'вс',
        );
        $n = (int)$n;
        return isset($names[$n]) ? $names[$n] : '';
    }
    
    /**
     * 
     * @param type $time
     * @return type
     */
    public static function getWeekDayStrByTime($time) {
        return self::getWeekDayStr( (int) date('w', $time) );
    }
    
    /**
     * 
     * @return type
     */
    public static function getColorList() {
        return array(
            '#00FFFF'=>'Морская волна',
            '#000000'=>'Черный',
            '#0000FF'=>'Голубой',
            '#FF00FF'=>'Фуксин',
            '#808080'=>'Серый',
            '#008000'=>'Зеленый',
            '#00FF00'=>'Салатный',
            '#800000'=>'Бордовый',
            '#808000'=>'Оливковый',
            '#800080'=>'Фиолетовый',
            '#FF0000'=>'Красный',
            '#C0C0C0'=>'Серебряный',
            '#008080'=>'Серо-зеленый',
            '#FFFFFF'=>'Белый',
            '#FFFF00'=>'Желтый',
        );
    }
    
    /**
     * 
     * @param type $time
     * @return type
     */
    public static function timeAddMonth($time) {
        $year = date('Y', $time);
        $month = date('m', $time) + 1;
        if($month > 12) {
            $month = 1;
            $year += 1;
        }
        return $time + (3600 * 24 * date('t', mktime(0,0,0,$month, 1, $year)));
    }
    
     /**
     * 
     * @param type $time
     * @return type
     */
    public static function timeRemoveMonth($time) {
        $year = date('Y', $time);
        $month = date('m', $time) - 1;
        if($month == 0) {
            $month = 12;
            $year -= 1;
        }
        return $time - (3600 * 24 * date('t', mktime(0,0,0,$month, 1, $year)));
    }
    
    /**
     * 
     * @param type $time
     * @return type
     */
    public static function timeToMinMonth($time) {
        return mktime(0,0,0,date('m', $time), 1, date('Y', $time));
    }
    
        /**
     * 
     * @param type $time
     * @return type
     */
    public static function timeToMaxMonth($time) {
        return mktime(0,0,0,date('m', $time), date('t', $time), date('Y', $time));
    }
}

?>
