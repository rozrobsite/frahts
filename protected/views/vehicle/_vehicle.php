<?php/* @var $this UserController *//* @var $model Users */$this->pageTitle = Yii::app()->name . ' - ' . ($model->isNewRecord ? 'Регистрация транспорта' : 'Редактирование транспорта "' . $model->bodyType->name_ru . ' ' . $model->marka->name . ' ' . $model->modeli->name . '"');;$this->breadcrumbs = array(	'Мой транспорт',);?><!-- Sidebar begins --><div id="sidebar">	<?php $this->renderPartial('/blocks/mainNav') ?>    <!-- Secondary nav -->    <div class="secNav">		<?php		$this->renderPartial('_secWrapper', array('is_active' => 0))		?>	</div></div><!-- Sidebar ends --><div id="content">	<?php $this->renderPartial('/blocks/contentTop') ?>    <!-- Breadcrumbs line -->    <div class="breadLine">        <div class="bc">            <ul id="breadcrumbs" class="breadcrumbs">                <li><a href="/">Главная</a></li>                <li><a href="/vehicle">Мой транспорт</a></li>                <li class="current">					<a title=""><?php echo isset($model->id) ? 'Редактирование транспорта' : 'Регистрация транспорта' ?></a>				</li>            </ul>        </div>    </div>    <!-- Main content -->    <div class="wrapper">		<?php $this->renderPartial('/blocks/_notify') ?>		<?php $this->renderPartial('/blocks/_middleNavR') ?>		<?php		$form = $this->beginWidget('CActiveForm',				array(			'id' => 'vehicleForm',			'enableAjaxValidation' => false,			'clientOptions' => array(				'validateOnSubmit' => true,			),			'focus' => array($model, 'vehicle_type_id'),			'htmlOptions' => array('class' => 'main', 'enctype' => 'multipart/form-data'),				));		?>		<div class="fluid">			<div class="widget grid12">				<div class="whead">					<h6><?php						echo $model->isNewRecord ? 'Регистрация нового транспорта' : 'Редактирование транспорта "'								. ucfirst($model->bodyType->name_ru) . " " . $model->marka->name . " " . $model->modeli->name								. ', номер: ' . $model->license_plate . '"'						?>					</h6>					<div class="clear"></div>				</div>				<?php $this->renderPartial('/blocks/_atention'); ?>				<div class="formRow">					<div class="grid2"><label>Транспорт свободен:<span class="req">*</span></label></div>					<div class="grid3">						<ul class="datesRange">							<li>								<?php if ($model->date_from) $model->date_from = date('d.m.Y', $model->date_from); echo $form->textField($model, 'date_from', array('id' => 'fromDate', 'placeholder' => 'С')) ?>							</li>							<li class="sep" style="font-weight: bold">-</li>							<li>								<?php if ($model->date_to) $model->date_to = date('d.m.Y', $model->date_to); echo $form->textField($model, 'date_to', array('id' => 'toDate', 'placeholder' => 'По')) ?>							</li>						</ul>						<br/><br/>						<?php echo $form->error($model, 'date_from', array('class' => 'error')); ?>						<?php echo $form->error($model, 'date_to', array('class' => 'error')); ?>					</div>					<div class="clear"></div>				</div>				<div class="formRow">					<div class="grid3"><label>Текущее расположение:<span class="req">*</span></label></div>					<div class="grid3">						<?php							echo CHtml::activeDropDownList($model, 'country_id', $countries,									array('empty' => 'Выберите страну', 'class' => 'countryFrom'), array());							?>						<?php echo $form->error($model, 'country_id', array('class' => 'error')); ?>					</div>					<div class="grid3">						<?php echo CHtml::activeDropDownList($model, 'region_id',								$regionsFrom,								array('empty' => 'Выберите регион', 'class' => 'regionFrom'),								array());						?>						<?php echo $form->error($model, 'region_id', array('class' => 'error')); ?>					</div>					<div class="grid3">						<?php echo CHtml::activeDropDownList($model, 'city_id',								$citiesFrom,								array('empty' => 'Выберите населенный пункт', 'class' => 'cityFrom'),								array());						?>						<?php echo $form->error($model, 'city_id', array('class' => 'error')); ?>					</div>					<div class="clear"></div>				</div>				<div class="formRow">					<div class="grid3"><label>Готовы ехать в:</label></div>					<div class="grid3">						<?php							echo CHtml::activeDropDownList($model, 'country_id_to', $countries,									array('empty' => 'Выберите страну', 'class' => 'countryTo'), array());							?>						<?php echo $form->error($model, 'country_id_to', array('class' => 'error')); ?>					</div>					<div class="grid3">						<?php echo CHtml::activeDropDownList($model, 'region_id_to',								$regionsTo,								array('empty' => 'Выберите регион', 'class' => 'regionTo'),								array());						?>						<?php echo $form->error($model, 'region_id_to', array('class' => 'error')); ?>					</div>					<div class="grid3">						<?php echo CHtml::activeDropDownList($model, 'city_id_to',								$citiesTo,								array('empty' => 'Выберите населенный пункт', 'class' => 'cityTo'),								array());						?>						<?php echo $form->error($model, 'city_id_to', array('class' => 'error')); ?>					</div>					<div class="clear"></div>				</div>				<div class="formRow">					<div class="grid3"><label>Тип транспорта:<span class="req">*</span></label></div>					<div class="grid3">						<?php						echo CHtml::activeDropDownList($model, 'vehicle_type_id', $vehicleTypes,								array('empty' => 'Выберите тип транспорта', 'class' => 'type'), array());						?>						<?php echo $form->error($model, 'vehicle_type_id',								array('class' => 'error')); ?>					</div>					<div class="grid2"><label>Номер транспорта:<span class="req">*</span></label></div>					<div class="grid2">						<?php echo $form->textField($model, 'license_plate') ?>						<?php echo $form->error($model, 'license_plate', array('class' => 'error')); ?>					</div>					<div class="clear"></div>				</div>				<div class="formRow">					<div class="grid3"><label>Вид транспорта:<span class="req">*</span></label></div>					<div class="grid3">						<?php						echo CHtml::activeDropDownList($model, 'category_id', $categories,								array('empty' => 'Выберите вид транспорта', 'class' => 'categories'));						?>						<?php echo $form->error($model, 'category_id', array('class' => 'error')); ?>					</div>					<div class="grid2"><label>Номер прицепа:</label></div>					<div class="grid2">						<?php echo $form->textField($model, 'number_trailer') ?>						<?php echo $form->error($model, 'number_trailer', array('class' => 'error')); ?>					</div>					<div class="clear"></div>				</div>				<div class="formRow">					<div class="grid3"><label>Марка:<span class="req">*</span></label></div>					<div class="grid3">						<?php						echo CHtml::activeDropDownList($model, 'make_id', $makes,								array('empty' => 'Выберите марку', 'class' => 'make'));						?>						<?php echo $form->error($model, 'make_id', array('class' => 'error')); ?>					</div>					<div class="grid2"><label>Номер полуприцепа:</label></div>					<div class="grid2">						<?php echo $form->textField($model, 'number_semitrailer') ?>						<?php echo $form->error($model, 'number_semitrailer', array('class' => 'error')); ?>					</div>					<div class="clear"></div>				</div>				<div class="formRow">					<div class="grid3"><label>Модель:<span class="req">*</span></label></div>					<div class="grid3">						<?php						echo CHtml::activeDropDownList($model, 'model_id', $models,								array('empty' => 'Выберите модель', 'class' => 'model'), array());						?>						<?php echo $form->error($model, 'model_id',								array('class' => 'error')); ?>					</div>					<div class="grid2"><label>Грузоподъемность:<span class="req">*</span></label></div>					<div class="grid2">						<?php echo $form->textField($model, 'bearing_capacity', array('id' => 's2')) ?>						<?php echo $form->error($model, 'bearing_capacity', array('class' => 'error')); ?>					</div>					<div class="grid1"><label>(т)</label></div>					<div class="clear"></div>				</div>				<div class="formRow">					<div class="grid3"><label>Тип кузова:<span class="req">*</span></label></div>					<div class="grid3">						<?php						echo CHtml::activeDropDownList($model, 'body_type_id', $bodyTypes,								array('empty' => 'Выберите тип кузова', 'class' => 'bodyType'), array());						?>						<?php echo $form->error($model, 'body_type_id', array('class' => 'error')); ?>					</div>					<div class="grid2"><label>Объем кузова:<span class="req">*</span></label></div>					<div class="grid2">						<?php echo $form->textField($model, 'body_capacity', array('id' => 's1')) ?>						<?php echo $form->error($model, 'body_capacity', array('class' => 'error')); ?>					</div>					<div class="grid1"><label>(м&sup3;)</label></div>					<div class="clear"></div>				</div>			</div>			<div class="clear"></div>		</div>		<div class="fluid">			<div class="widget grid6">				<div class="whead"><h6>Вид загрузки</h6><div class="clear"></div></div>					<?php for ($index = 0; $index < count($shipments); $index += 2): ?>					<div class="formRow">						<div class="grid3"><label><?php echo $shipments[$index]->name_ru ?>: </label></div>						<div class="grid3 on_off">							<div class="floatL mr10">								<input type="checkbox" id="shipment_<?php echo $shipments[$index]->id ?>" <?php if (in_array($shipments[$index]->id,					$shipmentsChecked)) echo 'checked' ?> name="Vehicle[shipments][<?php echo $shipments[$index]->id ?>]" />							</div>						</div>						<?php if (isset($shipments[$index + 1])): ?>							<div class="grid3"><label><?php echo $shipments[$index + 1]->name_ru ?>: </label></div>							<div class="grid3 on_off">								<div class="floatL mr10">									<input type="checkbox" id="shipment_<?php echo $shipments[$index + 1]->id ?>" <?php if (in_array($shipments[$index + 1]->id,						$shipmentsChecked)) echo 'checked' ?> name="Vehicle[shipments][<?php echo $shipments[$index + 1]->id ?>]" />								</div>							</div>						<?php endif; ?>						<div class="clear"></div>					</div>					<?php endfor; ?>			</div>			<div class="widget grid6">				<div class="whead"><h6>Разрешения</h6><div class="clear"></div></div>					<?php for ($index = 0; $index < count($permissions); $index += 2): ?>					<div class="formRow">						<div class="grid3"><label><?php echo $permissions[$index]->name_ru ?>: </label></div>							<?php if ($permissions[$index]->id == 4): ?>							<div class="grid3 on_off">								<div class="floatL mr10">									<input type="checkbox" id="permission_<?php echo $permissions[$index]->id ?>" <?php if (in_array($permissions[$index]->id,									$permissionsChecked)) echo 'checked' ?> name="Vehicle[permissions][<?php echo $permissions[$index]->id ?>]" />								</div>								<?php								echo CHtml::activeDropDownList($model, 'adr',										array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9'),										array('class' => 'bodyType'), array());								?>							</div>							<?php else: ?>							<div class="grid3 on_off">								<div class="floatL mr10">									<input type="checkbox" id="permission_<?php echo $permissions[$index]->id ?>" <?php if (in_array($permissions[$index]->id,						$permissionsChecked)) echo 'checked' ?> name="Vehicle[permissions][<?php echo $permissions[$index]->id ?>]" />								</div>							</div>							<?php endif; ?>							<?php if (isset($permissions[$index + 1])): ?>							<div class="grid3"><label><?php echo $permissions[$index + 1]->name_ru ?>: </label></div>							<div class="grid3 on_off">								<div class="floatL mr10">									<input type="checkbox" id="permission_<?php echo $permissions[$index + 1]->id ?>" <?php if (in_array($permissions[$index + 1]->id,										$permissionsChecked)) echo 'checked' ?> name="Vehicle[permissions][<?php echo $permissions[$index + 1]->id ?>]" />								</div>							</div>							<?php endif; ?>						<div class="clear"></div>					</div>					<?php endfor; ?>			</div>		</div>		<div class="fluid">			<div class="widget grid12">				<div class="whead"><h6>Фотографии транспорта</h6><div class="clear"></div></div>				<div class="body">					<?php if (isset($model->photos)): ?>						<?php foreach ($model->photos as $photo): ?>							<a href="<?php echo '/' . Yii::app()->params['files']['photos'] . $photo->size_big ?>" class="lightbox photo_<?php echo $photo->id ?>" style="margin: 0 10px;" rel="group">								<img width="80" height="80" src="<?php echo '/' . Yii::app()->params['files']['photos'] . $photo->size_middle ?>" alt="">							</a>							<a href="javascript:void(0)" rel="<?php echo $photo->id ?>" style="disply:block;vertical-align:top;margin: 0 -5px 0 -10px;" class="deletePhoto photo_<?php echo $photo->id ?>"">								<img src="/images/elements/uploader/deleteFile.png" alt="">							</a>						<?php endforeach; ?>					<?php endif; ?>				</div>				<div class="formRow" style="border: 0;">					<?php						$this->widget('ext.EAjaxUpload.EAjaxUpload',								array(									'id' => 'uploadPhoto',									'config' => array(										'action' => Yii::app()->createUrl('/vehicle/upload'),										'allowedExtensions' => Yii::app()->params['images']['allowedExtensions'],										'sizeLimit' => Yii::app()->params['images']['sizeLimit'],										'multiple' => true,										'template' => '											<div class="qq-uploader">												<div class="qq-upload-drop-area"></span></div>												<div class="qq-upload-button btn" style="width: 164px;"><a href="javascript:void(0)" class="buttonL bGreyish">Загрузить фотографии</a></div>												<span class="qq-drop-processing"><span class="qq-drop-processing-spinner"></span></span>												<ul class="qq-upload-list"></ul>											</div>',										'messages' => array(											'typeError'    => "{file} имеет недопустимый формат. Допустимые форматы: {extensions}.",											'sizeError'    => "{file} имеет слишком большой объём, максимальный объём файла – {sizeLimit}.",											'minSizeError' => "{file} имеет слишком маленький объём, минимальный объём файла – {minSizeLimit}.",											'emptyError'   => "{file} пуст, пожалуйста, выберите другой файл.",											'noFilesError' => "Файлы для загрузки не выбраны.",											'onLeave'      => "В данный момент идёт загрузка файлов, если вы покинете страницу, загрузка будет отменена."										),										'text' => array(											'failUpload'   => 'загрузка не удалась',											'dragZone'     => 'Перетащите файл для загрузки',											'cancelButton' => 'Отмена',											'waitingForResponse' => 'Обработка...'										),										'callbacks' => array(											'onComplete' => 'js:function(id, fileName, responseJSON){																if (responseJSON.success)																{																	$(".lightbox").fancybox({																		"padding": 2																	});																	$("#uploadPhoto").append(																			"<a href=\"/' . Yii::app()->params['files']['tmp'] . '" + responseJSON.filename + "\" class=\"lightbox delClass\" data-filename=\"" + responseJSON.filename + "\" rel=\"group\" style=\"margin-right: 10px;\"><img src=\"/' . Yii::app()->params['files']['tmp'] . '" + responseJSON.filename + "\" width=\"80\" height=\"80\" /></a>"																		);																	$("#uploadPhoto").append(																			"<a id=\"image_" + responseJSON.filename + "\" href=\"javascript:void(0)\" onclick=\"photo.deletePreviewUpload(this);\" data-filename=\"" + responseJSON.filename + "\" rel=\"" + responseJSON.filename + "\" class=\"delClass\" style=\"margin:0 5px 0 -5px; vertical-align:top;\"><img src=\"/images/elements/uploader/deleteFile.png\" /></a>"																		);																	$("#uploadPhoto").append(																			 "<input name=\"Photos[]\" type=\"hidden\" value=\"" + responseJSON.filename + "\" data-filename=\"" + responseJSON.filename + "\" class=\"delClass\"/>"																		);																}															}'										),									)								)						);					?>					<div class="clear"></div>				</div>				<div class="clear"></div>			</div>		</div>		<div class="fluid">			<div class="widget grid12">				<div class="formRow">					<?php					echo CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить',							array(						'class' => 'buttonM bBlack formSubmit',					));					?>					<div class="clear"></div>				</div>			</div>		</div>	<?php $this->endWidget(); ?>	</div>	<!-- Content ends -->