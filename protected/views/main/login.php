<?php
/* @var $this MainController */
/* @var $model Users */
/* @var $form CActiveForm  */

$this->pageTitle = Yii::app()->name . ' - Вход';
$this->breadcrumbs = array(
	'Вход',
);
?>

<!-- Login wrapper begins -->
<div class="loginWrapper">
	<?php
	$form = $this->beginWidget('CActiveForm',
			array(
		'action' => '/main/login',
		'id' => 'login-form',
		'clientOptions' => array(
			'validateOnSubmit' => true,
		),
		'htmlOptions' => array('style' => 'margin-top: -55px'),
		'focus'=>array($model,'email'),
			));
	?>
	<!-- Current user form -->
	<div class="loginPic">
		<a href="javascript:void(0)" title=""><img src="/images/userLogin2.png" alt="" /></a>
		<span>Вход</span>
	</div>
	
	<?php echo $form->error($model,'login', array('class' => 'error')); ?>

	<?php echo $form->textField($model,'email', array('placeholder' => 'Электронный адрес', 'class' => 'loginEmail')); ?>
	<?php echo $form->error($model,'email', array('class' => 'error')); ?>
	<?php echo $form->passwordField($model,'password', array('placeholder' => 'Пароль', 'class' => 'loginPassword')); ?>
	<?php echo $form->error($model,'password', array('class' => 'error')); ?>

	<div class="logControl">
		<div class="memory">
			<?php echo $form->checkBox($model,'rememberMe', array('checked' => 'checked', 'class'=>'check')); ?>
			<?php echo $form->label($model,'rememberMe'); ?>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="logControl">
		<a href="/main/forgot" class="buttonM bLightBlue" style="margin-left: -52px;">Забыли пароль?</a>
		<?php echo CHtml::submitButton('Вход', array('class' => 'buttonM bBlue')); ?>
	</div>

	<?php $this->endWidget(); ?>

</div>
<!-- Login wrapper ends -->
