<?php
/* @var $this UserController */
/* @var $model Users */

$this->pageTitle = Yii::app()->name . ' - Настройки пользователя (Личные настройки)';
$this->breadcrumbs = array(
	'Настройки пользователя (Личные настройки)',
);
?>
<!-- Sidebar begins -->
<div id="sidebar">
	<?php $this->renderPartial('/blocks/mainNav') ?>
    <!-- Secondary nav -->
    <div class="secNav">
		<?php
		$this->renderPartial('_secWrapper', array('selectProfile' => true))
		?>
	</div>
</div>
<!-- Sidebar ends -->
<div id="content">
	<?php $this->renderPartial('/blocks/contentTop') ?>

    <!-- Breadcrumbs line -->
    <div class="breadLine">
        <div class="bc">
            <ul id="breadcrumbs" class="breadcrumbs">
                <li><a href="/">Главная</a></li>
                <li><a href="/user">Настройки пользователя</a></li>
                <li class="current"><a title="">Личные настройки</a></li>
            </ul>
        </div>

    </div>

    <!-- Main content -->
    <div class="wrapper">
		<?php $this->renderPartial('_accessMessage') ?>
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
						$form = $this->beginWidget('CActiveForm',
								array(
									'id' => 'profile-form',
									'enableAjaxValidation' => true,
									'clientOptions' => array(
										'validateOnSubmit' => true,
									),
									'focus' => array($model, 'user_type_id'),
								));
						?>
						<div class="formRow">
							<div class="grid3"><h5>Вид деятельности</h5></div>
							<div class="clear"></div>
						</div>
						<?php if (!$model->user_type_id): ?>
						<div class="formRow">
							<div class="grid12">
								<label style="color: #A64949; font-weight: bold;">
									ВНИМАНИЕ! Вы можете выбрать Ваш вид деятельности только один раз и больше не сможете внести изменения.
									Пожалуйста, будьте внимательны при выборе!
								</label>
							</div>
							<div class="clear"></div>
						</div>
						<?php endif; ?>
						<div class="formRow">
							<div class="grid3">
								<label>
									<?php if (!$model->user_type_id): ?>
									Выберите Ваш вид деятельности:
									<span class="req">*</span>
									<?php else: ?>
									 Вы зарегистрированы как
									<?php endif; ?>
								</label>
							</div>
							<div class="grid2">
								<?php echo CHtml::activeDropDownList($model, 'user_type_id', $userTypes, array('class' => 'user_type', 'disabled' => $model->user_type_id ? 'disabled' : '')); ?>
								<?php echo $form->error($model, 'user_type_id', array('class' => 'error')); ?>
							</div>
							<div class="grid7">
								<label id="shipper" class="explanation" style="display: none">Вы являетесь владельцем грузов и ищете транспортное средство для его перевозки</label>
								<label id="freighter" class="explanation" style="display: none">Вы являетесь владельцем грузового транспорта и ищете грузы для перевозки</label>
								<label id="dispatcher" class="explanation" style="display: none">
									Вы можете предлагать заявки на перевозку грузов, подбирать транспорт соответствующий параметам ваших грузов, а также предлагать свободный транспорт для перевозки
								</label>
							</div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><h5>Место проживания</h5></div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>Страна:<span class="req">*</span></label></div>
							<div class="grid9">
								<?php
								echo CHtml::activeDropDownList($model, 'country_id', $countries,
										array('empty' => 'Выберите страну', 'class' => 'country'), 
										array());
								?>
								<?php echo $form->error($model, 'country_id', array('class' => 'error')); ?>
							</div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>Регион:<span class="req">*</span></label></div>
							<div class="grid9">
								<?php echo CHtml::activeDropDownList($model, 'region_id', 
										$regions,
										array('empty' => 'Выберите регион', 'class' => 'region'), 
										array());
								?>
								<?php echo $form->error($model, 'region_id', array('class' => 'error')); ?>
							</div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>Населенный пункт:<span class="req">*</span></label></div>
							<div class="grid9">
								<?php echo CHtml::activeDropDownList($model, 'city_id', 
										$cities,
										array('empty' => 'Выберите населенный пункт', 'class' => 'city'), 
										array());
								?>
								<?php echo $form->error($model, 'city_id', array('class' => 'error')); ?>
							</div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>Адрес<span class="req">*</span>:</label></div>
							<div class="grid9">
								<?php echo $form->textField($model, 'address') ?>
								<?php echo $form->error($model, 'address', array('class' => 'error')); ?>
							</div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><h5>Владелец организации</h5></div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>Фамилия<span class="req">*</span>:</label></div>
							<div class="grid9 onlyText">
								<?php echo $form->textField($model, 'last_name') ?>
								<?php echo $form->error($model, 'last_name', array('class' => 'error')); ?>
							</div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>Имя<span class="req">*</span>:</label></div>
							<div class="grid9 onlyText">
								<?php echo $form->textField($model, 'first_name') ?>
								<?php echo $form->error($model, 'first_name', array('class' => 'error')); ?>
							</div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>Отчество<span class="req">*</span>:</label></div>
							<div class="grid9 onlyText">
								<?php echo $form->textField($model, 'middle_name') ?>
								<?php echo $form->error($model, 'middle_name', array('class' => 'error')); ?>
							</div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>Телефон мобильный<span class="req">*</span>:</label></div>
							<div class="grid9">
								<?php echo $form->textField($model, 'mobile', array('class' => 'maskPhone')) ?>
								<?php echo $form->error($model, 'mobile', array('class' => 'error')); ?>
							</div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>Телефон/Факс:</label></div>
							<div class="grid9 onlyNums">
								<?php echo $form->textField($model, 'phone') ?>
							</div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>Скайп (Skype):</label></div>
							<div class="grid9">
								<?php echo $form->textField($model, 'skype') ?>
							</div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>ICQ:</label></div>
							<div class="grid9">
								<?php echo $form->textField($model, 'icq') ?>
							</div>
							<div class="clear"></div>
						</div> 
						<div class="formRow">
							<?php echo CHtml::submitButton('Сохранить', array('class' => 'buttonM bBlack formSubmit'));?>
							<div class="clear"></div>
						</div>
					</div>
					<?php $this->endWidget(); ?>
					
					<div id="tabb2" class="tab_content">
						<?php
						$form = $this->beginWidget('CActiveForm',
								array(
							'action' => '/user/changeEmail',
							'id' => 'changeEmail-form',
							'enableAjaxValidation' => true,
							'clientOptions' => array(
								'validateOnSubmit' => true,
							),
							'focus' => array($user, 'newEmail'),
								));
						?>
						<div class="formRow">
							<div class="grid12"><h5>Изменение электронного адреса (e-mail)</h5></div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>Текущий электронный адрес:</label></div>
							<div class="grid9">
								<?php echo $form->textField($user, 'email') ?>
								<?php echo $form->error($user, 'email', array('class' => 'error')); ?>
							</div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>Новый электронный адрес:</label></div>
							<div class="grid9">
								<?php echo $form->textField($user, 'newEmail') ?>
								<?php echo $form->error($user, 'newEmail'); ?>
							</div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>Повторите новый электронный адрес:</label></div>
							<div class="grid9">
								<?php echo $form->textField($user, 'newEmailRepeat') ?>
								<?php echo $form->error($user, 'newEmailRepeat'); ?>
							</div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<?php echo CHtml::submitButton('Изменить', array('class' => 'buttonM bBlack formSubmit'));?>
							<div class="clear"></div>
						</div>
						<?php $this->endWidget(); ?>
					</div>
					
					<div id="tabb3" class="tab_content">
						<?php
						$form = $this->beginWidget('CActiveForm',
								array(
							'action' => '/user/changePassword',
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
								<?php echo $form->passwordField($user,'oldPassword', array('value' => '')); ?>
								<?php echo $form->error($user,'oldPassword', array('class' => 'error')); ?>
							</div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>Новый пароль:</label></div>
							<div class="grid9">
								<?php echo $form->passwordField($user,'newPassword'); ?>
								<?php echo $form->error($user,'newPassword', array('class' => 'error')); ?>
							</div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>Повторите новый пароль:</label></div>
							<div class="grid9">
								<?php echo $form->passwordField($user,'newPasswordRepeat'); ?>
								<?php echo $form->error($user,'newPasswordRepeat', array('class' => 'error')); ?>
							</div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<?php echo CHtml::submitButton('Изменить', array('class' => 'buttonM bBlack formSubmit'));?>
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

