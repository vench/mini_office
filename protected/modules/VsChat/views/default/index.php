<?php
/* @var $this DefaultController */

?>

<div class=vs-chat>
<?php

$tabs = array();

foreach($stackChat as $chat) {
	list($title, $model, $active) = $chat;
	 
	$tabs[] = array(
		'label'=>$title,
		'content'=>$this->renderPartial('_form', array(
				'model'=>$model,
				'users'=>$users, 
			),
			true
		),
		'active'=>$active,
	);		
}

$tabs[] = array(
    'label'=>'Новые!',
    'content'=>'',
    'itemOptions'=>array(
        'class'=>'new',
    ),
);

$this->widget('bootstrap.widgets.TbTabs', array(
    'type'=>'tabs', // 'tabs' or 'pills'
    'tabs'=>$tabs,
));
 
?> 

 
<script type="text/javascript">
$(function(){ 
	var _currentBlock,
		_interval,
                _fnShowListNews = function() {
                    $.get('<?php echo $this->createAbsoluteUrl('showListNews');?>', { }, function(data){
                        $('.vs-chat .tab-pane').last().html(data);
                    });    
                },
                _fnUpdateListChar = function() {
                    if($('.vs-chat ul.nav.nav-tabs li.new').css('display') != 'none') {
                        return;
                    }
                   
                    $.get('<?php echo $this->createAbsoluteUrl('checkNew');?>', { }, function(data){
                        if(data == 1) {
                             $('.vs-chat ul.nav.nav-tabs li.new').show();  
                        }
                    });    
                },
		_fnUpdateAjax = function() {
			var block = $('#'+ _currentBlock),
				from;
			if(!block) {
                                _fnUpdateListChar();
				return;
			}
			from = block.find('input[name="VsChat[user_to]"]');  
                        
			if(!from || !from.val()) {
                                _fnUpdateListChar();  
				return;	
			}
			$.get('<?php echo $this->createAbsoluteUrl('loadChat');?>', {from:from.val()}, function(data){ 
				block.find('.chatList').html(data);
                                _fnUpdateListChar();
			});
		};
		
	_interval = setInterval(_fnUpdateAjax, 10000);	
	
	$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		  var id = e.target.href.split('#')[1]; 
		  _currentBlock = (id);
		  _fnUpdateAjax();
	});
	$('.vs-chat li.active > a[data-toggle="tab"]').trigger('shown.bs.tab');
        $('.vs-chat ul.nav.nav-tabs li.new').hide();
        $('.vs-chat ul.nav.nav-tabs li.new').click(_fnShowListNews);
});
</script>
</div>