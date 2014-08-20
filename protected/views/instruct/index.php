<?php
/* @var $this InstructController */

$this->breadcrumbs=array(
	'Поручения',
);
?>
<h1>Поручения</h1>


<div class="row-fluid">
	<div class="span6">
	<?php
echo CHtml::beginForm(array('/instruct'), 'get', array(
    'class'=>'form-inline',
    'id'=>'switch-form',
));

echo CHtml::radioButtonList('from', $from, array(
    '0'=>'созданые',
    '1'=>'полученные',
), array(
    'separator'=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',
));
echo CHtml::endForm();
 
?>

	</div>
	<div class="span6">
		<div class="btn-group right">
		<?php
		if(Yii::app()->user->checkAccess('instruct.set')) {
		   echo CHtml::link('Дать поручение', array('create'), array(
			 'class'=>'btn btn-large btn-primary',
		   ));
		}
		?>
		</div>
	</div>
</div>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
'viewData'=>array('from'=>$from),
)); ?>

<script type="text/javascript">
$(function(){
	$('.messTextLink').click(function(){
		$(this).parent().find('a.messTextLink + div.messText').toggleClass('hide');
		return false;
	});
	
	$('#switch-form input[type="radio"]').change(function(){
		this.form.submit();
	});
});
</script>