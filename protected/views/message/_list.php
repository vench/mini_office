
<?php $this->widget('bootstrap.widgets.TbListView',array(
    'dataProvider'=>$message->search(),
    'viewData'=>array(
        'from'=>$from,
    ),
    'sortableAttributes'=>array(
        'id'=>'#',
        'is_new',
        'datetime'
    ),
    'itemView'=>'_view',
    'afterAjaxUpdate' => 'js:function(id, data) {
        $(document).trigger("TbListViewAfterAjaxUpdate");
    }',
)); ?>

<script type="text/javascript">
$(function(){
    var fnInit = function () {
        $('a.viewDetail').click(function(){
            var self = $(this).parent().parent().parent().parent().find('div.messText');
            self.toggle('hide');

            <?php if($from == 0): ?>
            if(self.hasClass('new')) {
                self.removeClass('new');
                $.get('<?php echo $this->createUrl('asRead')?>', {id: self.data('pk')});
            }
            <?php endif;?>
            return false;
        });

        $('a.delete').click(function(){        
            return confirm("Вы уверены, что хотите удалить сообщение?");
        });
    }
    fnInit();
    $(document).bind('TbListViewAfterAjaxUpdate', fnInit);
});
</script>