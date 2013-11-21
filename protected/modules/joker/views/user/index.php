<?php
/* @var $this UserController */
/* @var $model Users */

$this->pageTitle = Yii::app()->params['joker']['name'] . ' - Настройки (Профиль)';
$this->breadcrumbs = array(
	'/joker/user' => 'Настройки',
	'current' => 'Профиль',
);
?>

<!-- Sidebar begins -->
<div id="sidebar">
	<?php $this->renderPartial('/blocks/mainNavJoker') ?>
    <!-- Secondary nav -->
    <div class="secNav">
		<?php
		$this->renderPartial('_secWrapper', array('profiles' => true))
		?>
	</div>
</div>

<!-- Sidebar ends -->
<div id="content">
	<?php $this->renderPartial('/blocks/contentTop') ?>

    <!-- Main content -->
    <div class="wrapper">
		<?php $this->renderPartial('/blocks/_notify') ?>
		<?php $this->renderPartial('/blocks/_middleNavR') ?>

        <!-- Tabs -->
		<div class="fluid">
			<div class="widget grid12">
				<ul class="tabs">
					<li><a href="#tabb1">Личная информация</a></li>
					<li><a href="#tabb2">Сменить элетронный адрес</a></li>
					<li><a href="#tabb3">Сменить пароль</a></li>
				</ul>
				<div class="tab_container">
					<div id="tabb1" class="tab_content">
						<?php
						$form = $this->beginWidget('CActiveForm', array(
							'id' => 'profile-form',
							'enableAjaxValidation' => false,
							'clientOptions' => array(
								'validateOnSubmit' => true,
							),
							'focus' => array($this->jokerUser->profiles, 'last_name'),
							));
						?>
						<?php $this->renderPartial('/blocks/_atention'); ?>
						<div class="formRow">
							<div class="grid12"><h5>Введите пожалйста Ваши личные данные:</h5></div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3">
								<label>
									Фамилия
									<span class="req">*</span>:
								</label>
							</div>
							<div class="grid9 onlyText">
								<?php echo $form->textField($this->jokerUser->profiles, 'last_name')?>
								<?php echo $form->error($this->jokerUser->profiles, 'last_name', array('class' => 'error'));?>
							</div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3">
								<label>
									Имя
									<span class="req">*</span>:
								</label>
							</div>
							<div class="grid9 onlyText">
								<?php echo $form->textField($this->jokerUser->profiles, 'first_name')?>
								<?php echo $form->error($this->jokerUser->profiles, 'first_name', array('class' => 'error'));?>
							</div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3">
								<label>
									Отчество:
								</label>
							</div>
							<div class="grid9 onlyText">
								<?php echo $form->textField($this->jokerUser->profiles, 'middle_name')?>
								<?php echo $form->error($this->jokerUser->profiles, 'middle_name', array('class' => 'error'));?>
							</div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid12"><h5>Введите пожалйста Ваши контакты:</h5></div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3">
								<label>
									Телефон мобильный
									<span class="req">*</span>:
								</label>
							</div>
							<div class="grid9 onlyNums">
								<?php echo $form->textField($this->jokerUser->profiles, 'mobile')?>
								<?php echo $form->error($this->jokerUser->profiles, 'mobile', array('class' => 'error'));?>
							</div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>Телефон/Факс:</label></div>
							<div class="grid9 onlyNums">
								<?php echo $form->textField($this->jokerUser->profiles, 'phone')?>
							</div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>Скайп (Skype):</label></div>
							<div class="grid9">
								<?php echo $form->textField($this->jokerUser->profiles, 'skype')?>
							</div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>ICQ:</label></div>
							<div class="grid9 onlyNums">
								<?php echo $form->textField($this->jokerUser->profiles, 'icq')?>
							</div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<?php echo CHtml::submitButton('Сохранить', array('class' => 'buttonM bBlue formSubmit'));?>
							<div class="clear"></div>
						</div>
					</div>
					<?php $this->endWidget(); ?>

					<div id="tabb2" class="tab_content">
						<?php
						$formChangeEmail = $this->beginWidget('CActiveForm', array(
							'action' => '/joker/user/changeEmail',
							'id' => 'changeEmail-form',
							'enableAjaxValidation' => true,
							'clientOptions' => array(
								'validateOnSubmit' => true,
							),
							'focus' => array($this->jokerUser, 'newEmail'),
							));
						?>

						<div class="formRow">
							<div class="grid12"><h5>Изменение электронного адреса (e-mail)</h5></div>
							<div class="clear"></div>
						</div>

						<div class="formRow">
							<div class="grid3"><label>Текущий электронный адрес:</label></div>
							<div class="grid9">
								<?php echo $formChangeEmail->textField($this->jokerUser, 'email')?>
								<?php echo $formChangeEmail->error($this->jokerUser, 'email', array('class' => 'error'));?>
							</div>
							<div class="clear"></div>
						</div>

						<div class="formRow">
							<div class="grid3"><label>Новый электронный адрес:</label></div>
							<div class="grid9">
								<?php echo $formChangeEmail->textField($this->jokerUser, 'newEmail')?>
								<?php echo $formChangeEmail->error($this->jokerUser, 'newEmail'); ?>
							</div>
							<div class="clear"></div>
						</div>

						<div class="formRow">
							<div class="grid3"><label>Повторите новый электронный адрес:</label></div>
							<div class="grid9">
								<?php echo $formChangeEmail->textField($this->jokerUser, 'newEmailRepeat')?>
								<?php echo $formChangeEmail->error($this->jokerUser, 'newEmailRepeat'); ?>
							</div>
							<div class="clear"></div>
						</div>

						<div class="formRow">
							<?php echo CHtml::submitButton('Изменить', array('class' => 'buttonM bBlue formSubmit'));?>
							<div class="clear"></div>
						</div>
						<?php $this->endWidget(); ?>
					</div>

					<div id="tabb3" class="tab_content">
						<?php
						$formChangePassword = $this->beginWidget('CActiveForm', array(
							'action' => '/joker/user/changePassword',
							'id' => 'changePassword-form',
							'enableAjaxValidation' => true,
							'clientOptions' => array(
								'validateOnSubmit' => true,
							),
							'focus' => array($user, 'newPassword'),
							));
						?>

						<div class="formRow">
							<div class="grid3"><h5>Изменение пароля</h5></div>
							<div class="clear"></div>
						</div>

						<div class="formRow">
							<div class="grid3"><label>Текущий пароль:</label></div>
							<div class="grid9">
							<?php echo $formChangePassword->passwordField($this->jokerUser, 'oldPassword', array('value' => ''));?>
							<?php echo $formChangePassword->error($this->jokerUser, 'oldPassword', array('class' => 'error'));?>
							</div>
							<div class="clear"></div>
						</div>

						<div class="formRow">
							<div class="grid3"><label>Новый пароль:</label></div>
							<div class="grid9">
							<?php echo $formChangePassword->passwordField($this->jokerUser, 'newPassword');?>
							<?php echo $formChangePassword->error($this->jokerUser, 'newPassword', array('class' => 'error'));?>
							</div>
							<div class="clear"></div>
						</div>

						<div class="formRow">
							<div class="grid3"><label>Повторите новый пароль:</label></div>
							<div class="grid9">
							<?php echo $formChangePassword->passwordField($this->jokerUser, 'newPasswordRepeat'); ?>
							<?php echo $formChangePassword->error($this->jokerUser, 'newPasswordRepeat', array('class' => 'error'));?>
							</div>
							<div class="clear"></div>
						</div>

						<div class="formRow">
							<?php echo CHtml::submitButton('Изменить', array('class' => 'buttonM bBlue formSubmit'));?>
							<div class="clear"></div>
						</div>
						<?php $this->endWidget(); ?>
					</div>
				</div>
				<div class="clear"></div>
			</div>
		</div>
    </div>
</div>

<!-- Content ends -->



