<?php
/* @var $this MainController */
/* @var $model Users */
/* @var $form CActiveForm  */

$this->pageTitle = Yii::app()->name . ' - Регистрация';
$this->breadcrumbs = array(
	'Регистрация',
);
?>

<?php if(Yii::app()->user->hasFlash('register')):?>
<div id="content">
	<div class="wrapper" style="text-align: center; margin-top: 100px;">
		<h3>Спасибо!</h3>
		<p><?php echo Yii::app()->user->getFlash('register'); ?></p>
	</div>
</div>
<?php else: ?>
<!-- Registration wrapper begins -->
<div class="loginWrapper" style="left:47%">
	<?php
	$form = $this->beginWidget('CActiveForm',
			array(
		'action' => '/main/register',
		'id' => 'register-form',
		'clientOptions' => array(
			'validateOnSubmit' => true,
		),
		'htmlOptions' => array('style' => 'margin-top: -55px;width: 300px'),
		'focus'=>array($model,'email'),
			));
	?>
	<!-- Current user form -->
	<div class="loginPic">
		<span>Регистрация</span>
	</div>
	
	<div class="logControl register">
		<label><span style="color:#DB6464;margin-left: 5px;">*</span></label>
		<?php echo $form->textField($model,'email', array('placeholder' => 'Электронный адрес', 'class' => 'loginEmail')); ?>
		<?php echo $form->error($model,'email', array('class' => 'error')); ?>
		<div class="clear"></div>
	</div>
	<div class="logControl register">
		<label><span style="color:#DB6464;margin-left: 5px;">*</span></label>
		<?php echo $form->passwordField($model,'password', array('placeholder' => 'Пароль', 'class' => 'loginPassword')); ?>
		<?php echo $form->error($model,'password', array('class' => 'error')); ?>
		<div class="clear"></div>
	</div>
	<div class="logControl register">
		<label><span style="color:#DB6464;margin-left: 5px;">*</span></label>
		<?php echo $form->passwordField($model,'password_repeat', array('placeholder' => 'Повторите пароль', 'class' => 'loginPassword')); ?>
		<?php echo $form->error($model,'password_repeat', array('class' => 'error')); ?>
		<div class="clear"></div>
	</div>
	<div class="logControl captcha">
		<?if(CCaptcha::checkRequirements()):?>
			<?php $this->widget('CCaptcha', array('buttonLabel' => '<br>[новый код]'))?>
		<?endif?>
	</div>
	<div class="logControl register">
		<label><span style="color:#DB6464;margin-left: 5px;">*</span></label>
		<?php echo $form->textField($model,'verifyCode', array('placeholder' => 'Веедите код с картинки')); ?>
		<?php echo $form->error($model,'verifyCode', array('class' => 'error')); ?>
	</div>
	
	<div class="logControl">
		<?php echo CHtml::submitButton('Зарегистрироваться', array('class' => 'buttonM bBlue', 'style' => 'margin-right:70px;')); ?>
	</div>

	<?php $this->endWidget(); ?>

</div>
<?php endif; ?>
<!-- Registration wrapper ends -->
