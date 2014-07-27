<?php
$this->pageTitle = 'Ошибка ' . $code;
$this->breadcrumbs = array('Ошибка ' . $code);
?>

<h2>Ошибка <?= $code; ?></h2>

<div class="alert alert-error">
	<span><?= CHtml::encode($message); ?></span> <a href="javascript:history.back()">Вернуться на предыдущую страницу</a>
</div>