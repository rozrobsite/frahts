<?php
/* @var $this UserController */
/* @var $model Users */

$this->pageTitle = Yii::app()->params['joker']['name'] . ' - Личный кабинет (Личная информация)';
$this->breadcrumbs = array(
	'/joker/user' => 'Личные настройки',
	'current' => 'Профиль',
);
?>

<!-- Sidebar begins -->
<div id="sidebar">
	<?php $this->renderPartial('/blocks/mainNavJoker') ?>
    <!-- Secondary nav -->
    <div class="secNav">
		<?php
		$this->renderPartial('_secWrapper')
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
					<li><a href="#organization">Организация</a></li>
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
							'focus' => array($model, 'user_type_id'),
							));
						?>
						<?php $this->renderPartial('/blocks/_atention'); ?>
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

								<?php
								echo CHtml::activeDropDownList($model, 'user_type_id', $userTypes, array('class' => 'user_type', 'disabled' => $model->user_type_id ? 'disabled' : ''));
								?>

								<?php echo $form->error($model, 'user_type_id', array('class' => 'error'));
								?>

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
								echo CHtml::activeDropDownList($model, 'country_id', $countries, array('empty' => 'Выберите страну', 'class' => 'country'), array());
								?>

								<?php echo $form->error($model, 'country_id', array('class' => 'error'));
								?>

							</div>

							<div class="clear"></div>

						</div>

						<div class="formRow">

							<div class="grid3"><label>Регион:<span class="req">*</span></label></div>

							<div class="grid9">

								<?php
								echo CHtml::activeDropDownList($model, 'region_id', $regions, array('empty' => 'Выберите регион', 'class' => 'region'), array());
								?>

								<?php echo $form->error($model, 'region_id', array('class' => 'error'));?>

							</div>

							<div class="clear"></div>

						</div>

						<div class="formRow">

							<div class="grid3"><label>Населенный пункт:<span class="req">*</span></label></div>

							<div class="grid9">

								<?php
								echo CHtml::activeDropDownList($model, 'city_id', $cities, array('empty' => 'Выберите населенный пункт', 'class' => 'city'), array());
								?>

								<?php echo $form->error($model, 'city_id', array('class' => 'error'));?>

							</div>

							<div class="clear"></div>

						</div>

						<div class="formRow">

							<div class="grid3"><label>Адрес<span class="req">*</span>:</label></div>

							<div class="grid9">

								<?php echo $form->textField($model, 'address')?>

								<?php echo $form->error($model, 'address', array('class' => 'error'));?>

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

								<?php echo $form->textField($model, 'last_name')?>

								<?php echo $form->error($model, 'last_name', array('class' => 'error'));?>

							</div>

							<div class="clear"></div>

						</div>

						<div class="formRow">

							<div class="grid3"><label>Имя<span class="req">*</span>:</label></div>

							<div class="grid9 onlyText">

								<?php echo $form->textField($model, 'first_name')?>

								<?php echo $form->error($model, 'first_name', array('class' => 'error'));?>

							</div>

							<div class="clear"></div>

						</div>

						<div class="formRow">

							<div class="grid3"><label>Отчество<span class="req">*</span>:</label></div>

							<div class="grid9 onlyText">

								<?php echo $form->textField($model, 'middle_name')?>

								<?php echo $form->error($model, 'middle_name', array('class' => 'error'));?>

							</div>

							<div class="clear"></div>

						</div>

						<div class="formRow">

							<div class="grid3"><label>Телефон мобильный<span class="req">*</span>:</label></div>

							<div class="grid9 onlyNums">

								<?php echo $form->textField($model, 'mobile')?>

								<?php echo $form->error($model, 'mobile', array('class' => 'error'));?>

							</div>

							<div class="clear"></div>

						</div>

						<div class="formRow">

							<div class="grid3"><label>Телефон/Факс:</label></div>

							<div class="grid9 onlyNums">

								<?php echo $form->textField($model, 'phone')?>

							</div>

							<div class="clear"></div>

						</div>

						<div class="formRow">

							<div class="grid3"><label>Скайп (Skype):</label></div>

							<div class="grid9">

								<?php echo $form->textField($model, 'skype')?>

							</div>

							<div class="clear"></div>

						</div>

						<div class="formRow">

							<div class="grid3"><label>ICQ:</label></div>

							<div class="grid9 onlyNums">

								<?php echo $form->textField($model, 'icq')?>

							</div>

							<div class="clear"></div>

						</div>

						<div class="formRow">

							<div class="grid3"><h5>Ваша фотография</h5></div>

							<div class="clear"></div>

						</div>

						<div class="formRow">

							<div class="grid2">

								<?php $avatar = isset($this->user->profiles->avatar) ? Yii::app()->params['files']['avatars'] . $this->user->profiles->avatar : '/images/' . Yii::app()->params['images']['defaultAvatar'];?>

								<img id="userAvatar" width="72" height="70" alt="" src="<?php echo $avatar . '?r=' . rand(0, 10000)?>">

								<input id="uploadInputAvatar" name="Photos[avatar]" type="hidden" value=""/>

							</div>

							<div class="grid2">

								<?php
								$this->widget('ext.EAjaxUpload.EAjaxUpload', array(
									'id' => 'uploadAvatar',
									'config' => array(
										'action' => Yii::app()->createUrl('/user/upload'),
										'allowedExtensions' => Yii::app()->params['images']['allowedExtensions'],
										'sizeLimit' => Yii::app()->params['images']['sizeAvatarLimit'],
										'multiple' => false,
										'template' => '
														<div class="qq-uploader">
															<div class="qq-upload-drop-area"></span></div>
															<div class="qq-upload-button btn" style="width: 170px;"><a href="javascript:void(0)" class="buttonL bGreyish">Загрузить фотографию</a></div>
															<span class="qq-drop-processing"><span class="qq-drop-processing-spinner"></span></span>
															<ul class="qq-upload-list"></ul>
														</div>',
								'messages' => array(
									'typeError' => "{file} имеет недопустимый формат. Допустимые форматы: {extensions}.",
									'sizeError' => "{file} имеет слишком большой объём, максимальный объём файла – {sizeLimit}.",
									'minSizeError' => "{file} имеет слишком маленький объём, минимальный объём файла – {minSizeLimit}.",
									'emptyError' => "{file} пуст, пожалуйста, выберите другой файл.",
									'noFilesError' => "Файлы для загрузки не выбраны.",
									'onLeave' => "В данный момент идёт загрузка файлов, если вы покинете страницу, загрузка будет отменена."
								),
								'text' => array(
									'failUpload' => 'загрузка не удалась',
									'dragZone' => 'Перетащите файл для загрузки',
									'cancelButton' => 'Отмена',
									'waitingForResponse' => 'Обработка...'
								),
								'callbacks' => array(
									'onComplete' => 'js:function(id, fileName, responseJSON){
														if (responseJSON.success)
														{
															$("#userAvatar").attr("src","/' . Yii::app()->params['files']['tmp'] . '" + responseJSON.filename + "");
															$("#uploadInputAvatar").val(responseJSON.filename);
														}
													}'
										),
									)
									)
								);
								?>

							</div>

							<div class="clear"></div>

						</div>

						<div class="formRow">

							<?php echo CHtml::submitButton('Сохранить', array('class' => 'buttonM bBlack formSubmit'));?>

							<div class="clear"></div>

						</div>

					</div>
					<?php $this->endWidget(); ?>

					<div id="organization" class="tab_content">
							<?php
							$formOrganization = $this->beginWidget('CActiveForm',
									array(
										'id' => 'organizations-form',
										'action' => '/user/organization',
										'enableAjaxValidation' => true,
										'clientOptions' => array(
											'validateOnSubmit' => true,
										),
										'focus' => array($user->organizations, 'user_type_id'),
										'htmlOptions' => array('class' => 'main', 'enctype' => 'multipart/form-data'),
									));
							?>

							<?php $this->renderPartial('/blocks/_atention'); ?>

							<div class="formRow">
								<div class="grid12"><h5>Регистрационные данные о Вашей организации</h5></div>
								<div class="clear"></div>
							</div>

							<div class="formRow">
								<div class="grid3"><label>Форма регистрации:<span class="req">*</span></label></div>
								<div class="grid9">
									<?php echo CHtml::activeDropDownList($user->organizations, 'type_org_id', $typeOrganizations); ?>
									<?php echo $formOrganization->error($user->organizations, 'type_org_id', array('class' => 'error')); ?>
								</div>
								<div class="clear"></div>
							</div>

							<div class="formRow">
								<div class="grid3">
									<label>Форма налогообложения:<span class="req">*</span></label>
								</div>

								<div class="grid9">
									<?php echo $formOrganization->textField($user->organizations, 'form_tax') ?>
									<?php echo $formOrganization->error($user->organizations, 'form_tax', array('class' => 'error')); ?>
								</div>
								<div class="clear"></div>
							</div>

							<div class="formRow">
								<div class="grid3"><label>Форма организации:</label></div>
								<div class="grid1">
									<?php echo CHtml::activeDropDownList($user->organizations, 'form_org_id', $formOrganizations); ?>
									<?php echo $formOrganization->error($user->organizations, 'form_org_id', array('class' => 'error')); ?>
								</div>
								<div class="grid8">
									<?php echo $formOrganization->textField($user->organizations, 'name_org') ?>
									<?php echo $formOrganization->error($user->organizations, 'name_org', array('class' => 'error')); ?>
								</div>
								<div class="clear"></div>
							</div>

							<div class="formRow">
								<div class="grid3"><label>Лицензия:</label></div>
								<div class="grid9">
									<?php echo $formOrganization->textField($user->organizations, 'license') ?>
									<?php echo $formOrganization->error($user->organizations, 'license', array('class' => 'error')); ?>
								</div>
								<div class="clear"></div>
							</div>
							<div class="formRow">
								<div class="grid12"><h5>Ваши платежные реквизиты</h5></div>
								<div class="clear"></div>
							</div>

							<div class="formRow">
								<div class="grid3">
									<label id="private_label"
										   style="<?php if (isset($this->user->organizations->id) && $this->user->organizations->type_org_id == Organizations::TYPE_CORPORATE): ?>display: none<?php endif; ?>">
										Адрес регистрации:
									</label>
									<label id="corporate_label"
										   style="<?php if (isset($this->user->organizations->id) && $this->user->organizations->type_org_id == Organizations::TYPE_PRIVATE): ?>display: none<?php endif; ?>">
										Юридический адресс:
									</label>
								</div>

								<div class="grid9">
									<?php echo $formOrganization->textField($user->organizations, 'address') ?>
									<?php echo $formOrganization->error($user->organizations, 'address', array('class' => 'error')); ?>
								</div>
								<div class="clear"></div>
							</div>
							<div id="edrpou" class="formRow"
								 style="<?php if (isset($this->user->organizations->id) && $this->user->organizations->type_org_id == Organizations::TYPE_PRIVATE): ?>display: none<?php endif; ?>">
								<div class="grid3">
									<label>Код ЕДРПОУ:</label>
								</div>
								<div class="grid9 onlyNums">
									<?php echo $formOrganization->textField($user->organizations, 'edrpou') ?>
									<?php echo $formOrganization->error($user->organizations, 'edrpou', array('class' => 'error')); ?>
								</div>
								<div class="clear"></div>
							</div>

							<div class="formRow">
								<div class="grid3"><label>№ счета:</label></div>
								<div class="grid9 onlyNums">
									<?php echo $formOrganization->textField($user->organizations, 'account_number') ?>
									<?php echo $formOrganization->error($user->organizations, 'account_number', array('class' => 'error')); ?>
								</div>
								<div class="clear"></div>
							</div>

							<div class="formRow">
								<div class="grid3"><label>В каком банке:</label></div>
								<div class="grid9">
									<?php echo $formOrganization->textField($user->organizations, 'bank') ?>
									<?php echo $formOrganization->error($user->organizations, 'bank', array('class' => 'error')); ?>
								</div>
								<div class="clear"></div>
							</div>

							<div class="formRow">
								<div class="grid3"><label>В каком городе:</label></div>
								<div class="grid9">
									<?php echo $formOrganization->textField($user->organizations, 'city') ?>
									<?php echo $formOrganization->error($user->organizations, 'city', array('class' => 'error')); ?>
								</div>
								<div class="clear"></div>
							</div>

							<div class="formRow">
								<div class="grid3"><label>МФО:</label></div>
								<div class="grid9 onlyNums">
									<?php echo $formOrganization->textField($user->organizations, 'mfo') ?>
									<?php echo $formOrganization->error($user->organizations, 'mfo', array('class' => 'error')); ?>
								</div>
								<div class="clear"></div>
							</div>

							<div class="formRow">
								<div class="grid3"><label>ИНН:</label></div>
								<div class="grid9 onlyNums">
									<?php echo $formOrganization->textField($user->organizations, 'inn') ?>
									<?php echo $formOrganization->error($user->organizations, 'inn', array('class' => 'error')); ?>
								</div>
								<div class="clear"></div>
							</div>

							<div class="formRow">
								<div class="grid3">
									<label id="private_certificate_label"
										   style="<?php if (isset($this->user->organizations->id) && $this->user->organizations->type_org_id == Organizations::TYPE_CORPORATE): ?>display: none<?php endif; ?>">
										№ свидетельства:
									</label>
									<label id="corporate_certificate_label"
										   style="<?php if (isset($this->user->organizations->id) && $this->user->organizations->type_org_id == Organizations::TYPE_PRIVATE): ?>display: none<?php endif; ?>">
										Свидетельство плательщика НДС:
									</label>
								</div>
								<div class="grid9 onlyNums">
									<?php echo $formOrganization->textField($user->organizations, 'certificate') ?>
									<?php echo $formOrganization->error($user->organizations, 'certificate', array('class' => 'error')); ?>
								</div>
								<div class="clear"></div>
							</div>

							<div class="formRow">
								<div class="grid3"><label>Телефоны / Факс:</label></div>
								<div class="grid9">
									<?php echo $formOrganization->textField($user->organizations, 'phone') ?>
									<?php echo $formOrganization->error($user->organizations, 'phone', array('class' => 'error')); ?>
								</div>
								<div class="clear"></div>
							</div>

							<div class="formRow">
								<?php echo CHtml::submitButton('Сохранить', array('class' => 'buttonM bBlack formSubmit')); ?>
								<div class="clear"></div>
							</div>

							<input type="hidden" id="privateName" value="ЧП <?php echo $privateName ?>" />

							<div class="clear"></div>

					<?php $this->endWidget(); ?>

					</div>

					<div id="tabb2" class="tab_content">
						<?php
						$formChangeEmail = $this->beginWidget('CActiveForm', array(
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
								<?php echo $formChangeEmail->textField($user, 'email')?>
								<?php echo $formChangeEmail->error($user, 'email', array('class' => 'error'));?>
							</div>
							<div class="clear"></div>
						</div>

						<div class="formRow">
							<div class="grid3"><label>Новый электронный адрес:</label></div>
							<div class="grid9">
								<?php echo $formChangeEmail->textField($user, 'newEmail')?>
								<?php echo $formChangeEmail->error($user, 'newEmail'); ?>
							</div>
							<div class="clear"></div>
						</div>

						<div class="formRow">
							<div class="grid3"><label>Повторите новый электронный адрес:</label></div>
							<div class="grid9">
								<?php echo $formChangeEmail->textField($user, 'newEmailRepeat')?>
								<?php echo $formChangeEmail->error($user, 'newEmailRepeat'); ?>
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
						$form = $this->beginWidget('CActiveForm', array(
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
							<?php echo $form->passwordField($user, 'oldPassword', array('value' => ''));?>
							<?php echo $form->error($user, 'oldPassword', array('class' => 'error'));?>
							</div>
							<div class="clear"></div>
						</div>

						<div class="formRow">
							<div class="grid3"><label>Новый пароль:</label></div>
							<div class="grid9">
							<?php echo $form->passwordField($user, 'newPassword');?>
							<?php echo $form->error($user, 'newPassword', array('class' => 'error'));?>
							</div>
							<div class="clear"></div>
						</div>

						<div class="formRow">
							<div class="grid3"><label>Повторите новый пароль:</label></div>
							<div class="grid9">
							<?php echo $form->passwordField($user, 'newPasswordRepeat'); ?>
							<?php echo $form->error($user, 'newPasswordRepeat', array('class' => 'error'));?>
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



