<?php
/* @var $this MainController */
/* @var $model Users */
/* @var $form CActiveForm  */

$this->pageTitle = Yii::app()->name . ' - Востановление пароля';
$this->breadcrumbs = array(
	'Востановление пароля',
);
?>
<?php if(Yii::app()->user->hasFlash('forgot')):?>
<div id="content">
	<div class="wrapper" style="text-align: center; margin-top: 100px;">
		<h3>Спасибо!</h3>
		<p><?php echo Yii::app()->user->getFlash('forgot'); ?></p>
	</div>
</div>
<?php else: ?>
<!-- Forgot wrapper begins -->
<div class="loginWrapper">

	<!-- Forgot password form -->
	<?php
	$form = $this->beginWidget('CActiveForm',
			array(
		'action' => '/main/forgot',
		'id' => 'forgot-form',
		'clientOptions' => array(
			'validateOnSubmit' => true,
		),
		'htmlOptions' => array('style' => 'margin-top: -25px'),
			));
	?>
	<div class="loginPic">
		<a href="javascript:void(0)" title=""><img src="/images/userLogin2.png" alt="" /></a>
	</div>

	<div class="logControl" style="width: 350px;">
		<label>Введите Ваш Email на который будет выслан новый пароль</label>
	</div>

	<?php echo $form->textField($model, 'email', array('placeholder' => 'Электронный адрес', 'class' => 'loginEmail')); ?>
	<?php echo $form->error($model, 'email', array('class' => 'error')); ?>

	<div class="logControl">
		<a href="/main/login" class="buttonM bLightBlue" style="margin-left: -77px;">Войти</a>
		<input type="submit" name="submit" value="Напомнить" class="buttonM bBlue" />
	</div>

<?php $this->endWidget(); ?>
</div>

<?php endif; ?>
<!-- Forgot wrapper ends -->