<script type="text/javascript">
var jokerMap;
var jokerCenter = [<?php echo $this->jokerUser->organizations->latitude ? $this->jokerUser->organizations->latitude : 0 ?>, <?php echo $this->jokerUser->organizations->longitude ? $this->jokerUser->organizations->longitude : 0 ?>];
var placemark;
</script>

<?php
Yii::app()->clientScript->registerScriptFile('http://api-maps.yandex.ru/2.0-stable/?load=package.full&lang=ru-RU');
Yii::app()->clientScript->registerScriptFile('/js/files/jokerOrganizations.js', CClientScript::POS_BEGIN);

$this->pageTitle = Yii::app()->params['joker']['name'] . ' - Настройки (Организация)';
$this->breadcrumbs = array(
	'/joker/user' => 'Настройки',
	'current' => 'Организация',
);
?>

<!-- Sidebar begins -->
<div id="sidebar">
	<?php $this->renderPartial('/blocks/mainNavJoker') ?>
    <!-- Secondary nav -->
    <div class="secNav">
		<?php
		$this->renderPartial('_secWrapper', array('organization' => true))
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

        <?php
			$form = $this->beginWidget('CActiveForm',
					array(
						'id' => 'organizations-form',
						'enableAjaxValidation' => false,
						'clientOptions' => array(
							'validateOnSubmit' => true,
						),
						'focus' => array($this->jokerUser->organizations, 'name'),
						'htmlOptions' => array('class' => 'main', 'enctype' => 'multipart/form-data'),
					));

        ?>
		<div class="fluid">
			<div class="widget grid12">
				<div class="whead">
					<h6>Организация</h6>
					<div class="clear"></div>
				</div>
				<?php $this->renderPartial('/blocks/_atention'); ?>
				<div class="formRow">
					<div class="grid3"><label>Название организации:<span class="req">*</span></label></div>
					<div class="grid9">
						<?php echo $form->textField($this->jokerUser->organizations, 'name') ?>
						<?php echo $form->error($this->jokerUser->organizations, 'name', array('class' => 'error')); ?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<div class="grid3">
						<label>Вид деятельности:<span class="req">*</span></label>
					</div>
					<div class="grid9">
						<select multiple="multiple" class="fullwidth select" data-placeholder="Выберите из списка кликнув сюда" name="JokerOrganizations[business_types][]">
							<option value=""></option>
							<?php foreach ($typeOrganizations as $typeOrganization): ?>
									<option value="<?php echo $typeOrganization->id; ?>" <?php if ($this->jokerUser->organizations->hasBusinessType(
                                        $typeOrganization->id)): ?>selected="selected"<?php endif; ?>>
										<?php echo $typeOrganization->name; ?>
									</option>
							<?php endforeach; ?>
						</select>
						<?php echo $form->error($this->jokerUser->organizations, 'business_types', array('class' => 'error')); ?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<div class="grid3">
						<label>Описание деятельности:<span class="req">*</span></label>
					</div>
					<div class="grid9">
						<?php echo $form->textArea($this->jokerUser->organizations, 'description', array('style' => 'height:150px;')) ?>
						<?php echo $form->error($this->jokerUser->organizations, 'description', array('class' => 'error')); ?>
					</div>
					<div class="clear"></div>
				</div>
			</div>
		</div>
		<div class="fluid">
			<div class="widget grid6">
				<div class="whead">
					<h6>Местоположение Вашей организации</h6>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<div class="grid4"><label>Страна:<span class="req">*</span></label></div>
					<div class="grid2">
						<?php echo CHtml::activeDropDownList($this->jokerUser->organizations, 'country_id', $countries, array('empty' => 'Выберите страну', 'class' => 'country', 'id' => 'jokerCountry'), array());?>
						<?php echo $form->error($this->jokerUser->organizations, 'country_id', array('class' => 'error')); ?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<div class="grid4"><label>Регион:<span class="req">*</span></label></div>
					<div class="grid2">
						<?php echo CHtml::activeDropDownList($this->jokerUser->organizations, 'region_id', $regions, array('empty' => 'Выберите регион', 'class' => 'region', 'id' => 'jokerRegion'), array());?>
						<?php echo $form->error($this->jokerUser->organizations, 'region_id', array('class' => 'error')); ?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<div class="grid4"><label>Населенный пункт:<span class="req">*</span></label></div>
					<div class="grid2">
						<?php echo CHtml::activeDropDownList($this->jokerUser->organizations, 'city_id', $cities, array('empty' => 'Выберите населенный пункт', 'class' => 'city', 'id' => 'jokerCity'), array());?>
						<?php echo $form->error($this->jokerUser->organizations, 'city_id', array('class' => 'error')); ?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<div class="grid12"><label>Адрес (введите или укажите на карте, кликнув на ней в нужном месте):<span class="req">*</span></label></div>
					<div class="grid12" style="margin-left: 0;">
						<?php echo $form->textField($this->jokerUser->organizations, 'address', array('id' => 'jokerAddress', 'disabled' => 'disabled')) ?>
						<?php echo $form->error($this->jokerUser->organizations, 'address', array('class' => 'error')); ?>
					</div>
					<div class="clear"></div>
				</div>
			</div>
			<div class="widget grid6">
				<div class="whead">
					<h6>Местоположение Вашей организации на карте</h6>
					<div class="clear"></div>
				</div>
				<div id="jokerMap" style="height: 295px;"></div>

                <input type="hidden" id="jokerLatitude" name="JokerOrganizations[latitude]" value="<?php echo $this->jokerUser->organizations->latitude ?>" />
				<input type="hidden" id="jokerLongitude" name="JokerOrganizations[longitude]" value="<?php echo $this->jokerUser->organizations->longitude ?>" />
			</div>
		</div>
		<div class="fluid">
			<div class="widget grid12">
				<div class="whead">
					<h6>Контактные данные Вашей организации</h6>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<div class="grid3"><label>Телефон мобильный:<span class="req">*</span></label></div>
					<div class="grid9 onlyNums">
						<?php echo $form->textField($this->jokerUser->organizations, 'mobile') ?>
						<?php echo $form->error($this->jokerUser->organizations, 'mobile', array('class' => 'error')); ?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<div class="grid3"><label>Телефон/Факс:</label></div>
					<div class="grid9">
						<?php echo $form->textField($this->jokerUser->organizations, 'phone') ?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<div class="grid3"><label>Электронный адрес (E-mail):</label></div>
					<div class="grid9">
						<?php echo $form->textField($this->jokerUser->organizations, 'email') ?>
						<?php echo $form->error($this->jokerUser->organizations, 'email', array('class' => 'error')); ?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<div class="grid3"><label>Скайп (Skype):</label></div>
					<div class="grid9">
						<?php echo $form->textField($this->jokerUser->organizations, 'skype') ?>
						<?php echo $form->error($this->jokerUser->organizations, 'skype', array('class' => 'error')); ?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<div class="grid3"><label>Сайт:</label></div>
					<div class="grid9">
						<?php echo $form->textField($this->jokerUser->organizations, 'site') ?>
						<?php echo $form->error($this->jokerUser->organizations, 'site', array('class' => 'error')); ?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<div class="grid5"><label>Скидка, которую вы предоставляете пользователям сайта:</label></div>
					<div class="grid1 onlyNums">
						<?php echo $form->textField($this->jokerUser->organizations, 'discount') ?>
						<?php echo $form->error($this->jokerUser->organizations, 'discount', array('class' => 'error')); ?>
                    </div><span style="margin-left: 5px;">%</span>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<div class="grid2">
						<?php $logo = isset($this->jokerUser->organizations->logo) ? '/' . Yii::app()->params['files']['logo'] . $this->jokerUser->organizations->logo : '/images/' . Yii::app()->params['images']['defaultAvatar'];?>
						<img id="userLogo" width="72" height="70" alt="" src="<?php echo $logo . '?r=' . rand(0, 10000)?>">
						<input id="uploadInputLogo" name="Photos[logo]" type="hidden" value=""/>
					</div>
					<div class="grid2">
						<?php
						$this->widget('ext.EAjaxUpload.EAjaxUpload', array(
							'id' => 'uploadLogo',
							'config' => array(
								'action' => Yii::app()->createUrl('/joker/user/upload'),
								'allowedExtensions' => Yii::app()->params['images']['allowedExtensions'],
								'sizeLimit' => Yii::app()->params['images']['sizeAvatarLimit'],
								'multiple' => false,
								'template' => '
												<div class="qq-uploader">
													<div class="qq-upload-drop-area"></span></div>
													<div class="qq-upload-button btn" style="width: 170px;"><a href="javascript:void(0)" class="buttonL bGreyish">Загрузить логотип</a></div>
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
													$("#userLogo").attr("src","/' . Yii::app()->params['files']['tmp'] . '" + responseJSON.filename + "");
													$("#uploadInputLogo").val(responseJSON.filename);
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
					<?php echo CHtml::submitButton('Сохранить', array('class' => 'buttonM bBlue formSubmit')); ?>
					<div class="clear"></div>
				</div>
			</div>
			<div class="clear"></div>
		</div>
        <?php $this->endWidget(); ?>
    </div>
</div>

<!-- Content ends -->



