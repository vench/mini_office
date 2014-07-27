<?php
$controllerId =  strtolower(Yii::app()->controller->getId());
$actionId =  strtolower(Yii::app()->controller->action->getId());
$user = Yii::app()->user;
$this->widget('bootstrap.widgets.TbNavbar', array(
	'type' => 'inverse', // null or 'inverse'
	'brand' => Yii::app()->name,
	'brandUrl' => Yii::app()->homeUrl,
	'collapse' => true,
	'fluid' => true,
	'fixed'=>'',
	'items' => array(
		array(
			'class' => 'bootstrap.widgets.TbMenu',
			'items' => array(
				array('label' => 'Панель администратора', 'url' => array('/admin'), 
                                    'visible' => ($user->checkAccess('srules') || $user->checkAccess('events') || $user->checkAccess('users') ||  $user->checkAccess('routine')
                                                || $user->checkAccess('subdivision') || $user->checkAccess('posts')|| $user->checkAccess('workDeviations') || $user->checkAccess('documents')), 
                                    'active' => in_array($controllerId, array('user', 'raccess', 'post', 'subdivision', 'event', 'workDeviation', 'place', 'documents', 'routine',)),
                                    'items' => array(
                                        array('label' => 'Пользователи', 
                                              'url'=>array('/admin/user/admin'),
                                              'visible' => $user->checkAccess('users'),
                                         ), 
                                        array('label' => 'Должности', 
                                              'url'=>array('/admin/post/admin'),
                                              'visible' => $user->checkAccess('posts'),
                                        ),
                                        array('label' => 'Подразделения', 
                                              'url'=>array('/admin/subdivision/admin'),
                                              'visible' => $user->checkAccess('subdivisions'),
                                        ),
                                        array('label' => 'События', 
                                              'url'=>array('/admin/event/admin'),
                                              'visible' => $user->checkAccess('events'),
                                        ),
                                        array('label' => 'Причины отсутствия', 
                                              'url'=>array('/admin/workDeviation/admin'),
                                              'visible'=>$user->checkAccess('workDeviations'),  
                                         ),
                                        array('label' => 'Права доступа', 
                                              'url'=>array('/raccess'),
                                              'visible' => $user->checkAccess('srules'),
                                        ),
										array('label' => 'Здания/места', 
                                              'url'=>array('/admin/place/admin'),
                                              'visible' => $user->checkAccess('places'),
                                        ),
					array('label' => 'Документы', 
                                              'url'=>array('/admin/documents/admin'),
                                              'visible' => $user->checkAccess('documents'),
                                        ),
                                        array('label' => 'Распорядок дня', 
                                              'url'=>array('/admin/routine/admin'),
                                              'visible' => $user->checkAccess('routine'),
                                        ),
                                        
                                    )
                                ),
                                array('label' => 'Табель', 
                                      'url' => array('/tabel'),
                                      'active' => $controllerId == 'tabel', 
                                      //'visible' => $user->checkAccess('tabel'),
                                ),
                                array('label' => 'Объявления', 
                                      'url' => array('/advert'),
                                      'active' => $controllerId == 'advert'
                                     // 'visible' => $user->checkAccess('adverts'),
                                ),
                                array('label' => 'Персонал', 
                                      'url' => array('/advert'),
                                      'active' => $controllerId == 'site' && (in_array($actionId, array('cmpnewusers', 'whoincomp','epsenusers'))),
                                      'items' => array(
                                        array('label' => 'Новые сотрудники', 
                                              'url'=>array('/site/cmpnewusers'), 
                                         ), 
                                           array('label' => 'Кто есть в компании', 
                                              'url'=>array('/site/whoincomp'), 
                                         ),
                                            array('label' => 'Отсутствуют', 
                                              'url'=>array('/site/epsenusers'), 
                                         ),
                                      )
                                ),
                            //Функционал
                                array('label' => 'Функционал',
                                        'active' => ($controllerId == 'site' && (in_array($actionId, array('scheduleregular', 'structure', 'negotiating', 'requestappointment')))) || $controllerId == 'instruct' || $controllerId == 'docs',
                                        'items' => array(
                                        
                                        array('label' => 'Расписание регулярных совещаний', 
                                              'url'=>array('/site/scheduleregular'), 
                                         ),
                                          array('label' => 'Структура предприятия', 
                                              'url'=>array('/site/structure'), 
                                         ),
										array('label' => 'Поручения', 
                                              'url'=>array('/instruct'), 
                                         ),
										 array('label' => 'Бланки документов', 
                                              'url'=>array('/docs/blanks'), 
                                         ),
										 array('label' => 'Бронирование переговорной', 
                                              'url'=>array('/site/negotiating'), 
                                         ),
										 array('label' => 'Запросить встречу', 
                                              'url'=>array('/site/requestappointment'), 
                                         ),
										 
                                            
                                )  )  
                            ),
                                 
		),
		array(
			'class' => 'bootstrap.widgets.TbMenu',
			'htmlOptions'=>array('class' => 'pull-right'),
			'items' => array(
				array('label' => 'Вход', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
				array('label' => 'Выход', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest),
			),
		),
	),
)); 

