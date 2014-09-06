<?php
$this->pageTitle = 'Вход';
$this->breadcrumbs = array('Вход ' );
?>

<div class="row">
	<div class="span12">
        <div class="alert alert-info">
            <span>Для входа в систему необходимо ввести логин и пароль.</span>
        </div>
    </div>
</div>

<?php
$this->renderPartial('_login', array(
    'model'=>$model,
));
