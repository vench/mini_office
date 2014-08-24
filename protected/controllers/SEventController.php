<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SEventController
 *
 * @author vench
 */
class SEventController extends BaseController {
    
        /**
    * Specifies the access control rules.
    * This method is used by the 'accessControl' filter.
    * @return array access control rules
    */
    public function accessRules() {
        return array(
           /* array('allow',   
                'actions'=>array('*'),
                'roles'=>array('events'),
            ), */
            array('deny',  // deny all users
                'actions'=>array( 'negotiatingAdd'),
                'users'=>array('?'),
            ),
            
            array('allow',  // deny all users
                'users'=>array('*'),
            ),
        );
    }
    
    /**
     * 
     * @param type $start
     * @param type $end
     */
    public function actionAjaxListEvent($start, $end, $type_event_id = NULL) {     

		$params = array(
                ':mintime'=>  $start,
                ':maxtime'=>  $end, 
				':user_id'=> Yii::app()->user->getId(),
				':user_id2'=> Yii::app()->user->getId(),
            );
		if(!is_null($type_event_id)){
			$params['type_event_id'] =  $type_event_id;
		}
		
	
        $models = Event::model()->findAll(array(
            'condition'=>
				'(t.show_all = 1 OR t.user_id = :user_id OR t.id IN (SELECT event_id FROM {{EventInvited}} WHERE user_id = :user_id2) ) AND '.
				'((t.dateevent2 >= :mintime AND t.dateevent <= :maxtime))' . 
				(!is_null($type_event_id) ? ' AND type_event_id = :type_event_id' : ''),
            'params'=>$params,
            'order'=>'t.timestart',
            'select'=>'name,id,dateevent,dateevent2',   
            'with'=>array('typeEvent'),
        )); 
        $items = array();
        foreach($models as $model) { 
               $items[]=$this->buildEventItem($model);
            
        }
        
        echo CJSON::encode($items);
        Yii::app()->end();
    }
    
    /**
     * 
     * @param type $id Event
     */
    public function actionEvent($id) {
        $model= $this->loadModelByPk('Event', $id);
        $this->render('event', array(
            'model'=>$model,
        ));
    }
    
    /**
     * 
     * @param Event $event
     * @param type $time
     * @return type
     */
     public function buildEventItem(Event $event) {
         return array(
                        'title'=>$event->name, 
                        'start'=>  strtotime($event->dateevent),
                        'end'=>strtotime($event->dateevent2),
						//'allDay'=>true,	
						//'end'=>date('Y-m-d',$time) ,
                        'color'=>isset($event->typeEvent) ? $event->typeEvent->getSoftColor() : '', 
                        'url'=>$this->createUrl('event', array('id'=>$event->id)),
                    );
     }
	 
	 /**
	 * Добавить "бронирование переговорной"
	 */
	public function actionNegotiatingAdd() {
		$model = new Event();
		$model->type_event_id = 3;
		$model->show_all = 1;
		$model->user_id = Yii::app()->user->getId();
		if($this->validateAndSaveModel($model)) {
			$this->redirect(array('/site/negotiating'));
		}
		$this->render('negotiatingAdd', array(
            'model'=>$model,
        ));
	}
	
	 /**
	 * Добавить "запрос встречи"
	 */
	public function actionRequestappointmentAdd() {
		$model = new Event();
		$model->type_event_id = 4;
		$model->show_all = 0;
		$model->user_id = Yii::app()->user->getId();
		$userTo = new User();
		if(isset($_POST['Event'])) {
			$userTo = User::model()->findByPk(Yii::app()->request->getParam('to', 0));  			 
			if(!is_null($userTo) && $this->validateAndSaveModel($model)) {
				$eventInvited = new EventInvited();
				$eventInvited->sendNotif = true;
				$eventInvited->user_id = $userTo->getPrimaryKey();
				$eventInvited->event_id = $model->getPrimaryKey();
				$eventInvited->save();
				$this->redirect(array('/site/requestappointment'));
			}	
		}
		$this->render('requestappointmentAdd', array(
            'model'=>$model,
			'userTo'=>$userTo,
        ));
	}
    
}

?>
