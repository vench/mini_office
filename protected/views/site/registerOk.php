<?php
$this->pageTitle = 'Регистрация завершена';
$this->breadcrumbs = array('Регистрация завершена' );
?>
<div class="row">
	<div class="span12">
<div class="well">
  <h1>  Спасибо за регистрацию! <small> Ваш аккаунт успешно создан. <small> </h1>
  <p>Для входа в сисетему используйте свой логин и пароль.</p>
</div>
</div></div>
<?php
$this->renderPartial('_login', array(
    'model'=>$model,
));