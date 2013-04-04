<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Фрахты.com - Административная панель</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1">
	<link rel="stylesheet" href="/css/admin/bootstrap.css">
	<link rel="stylesheet" href="/css/admin/jquery.fancybox.css">
	<link rel="stylesheet" href="/css/admin/style.css">
</head>
<body class='login_body'>
	<div class="wrap">
		<h2 style="font-size: 16px">Фрахты.com - Административная панель</h2>
		<h4>Авторизация</h4>
		<?php /** @var TbActiveForm $form */
		$form = $this->beginWidget('CActiveForm', array(
			'id' => 'adminLoginForm',
			'action' => $this->createUrl('/admin/default/login'),
			'htmlOptions' => array(
				'autocomplete' => 'off',
			),
		)); ?>
			<?php echo $form->errorSummary($model); ?>
			<div class="login">
				<div class="email">
					<label for="user">Логин</label>
					<div class="email-input">
						<div class="input-prepend">
							<span class="add-on"><i class="icon-envelope"></i></span>
							<?php echo $form->textField($model,'email'); ?>
						</div>
					</div>
				</div>
				<div class="pw">
					<label for="pw">Пароль</label>
					<div class="pw-input">
						<div class="input-prepend">
							<span class="add-on"><i class="icon-lock"></i></span>
							<?php echo $form->passwordField($model,'password'); ?>
						</div>
					</div>
				</div>
			</div>
			<div class="submit">
				<button class="btn btn-red5">Войти</button>
			</div>
		<?php $this->endWidget(); // form ?>
	</div>
	<script src="/js/admin/jquery.js"></script>
</body>
</html>