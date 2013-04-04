<?php
/* @var $this UserController */
/* @var $model Users */

$this->pageTitle = Yii::app()->name . ' - Поиск подходящего транпорта';
$this->breadcrumbs = array(
	'Поиск подходящего транпорта',
);
?>
<!-- Sidebar begins -->
<div id="sidebar">
	<?php $this->renderPartial('/blocks/mainNav') ?>
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

    <!-- Breadcrumbs line -->
    <div class="breadLine">
        <div class="bc">
            <ul id="breadcrumbs" class="breadcrumbs">
                <li><a href="/">Главная</a></li>
                <li><a href="/goods/search">Поиск транспорта</a></li>
                <li class="current">
					<a title="">Найденные подходящие транпортные средства</a>
				</li>
            </ul>
        </div>

    </div>

    <!-- Main content -->
    <div class="wrapper">
	<?php $this->renderPartial('_accessMessage') ?>
			<?php
				$form = $this->beginWidget('CActiveForm',
						array(
					'id' => 'goodsForm',
					'enableAjaxValidation' => false,
					'clientOptions' => array(
						'validateOnSubmit' => true,
						'hideErrorMessage'=>true,
					),
					'htmlOptions' => array('class' => 'main'),
					'focus' => array($model, 'Goods_name'),
						));
			?>
			<div class="widget fluid">
				<div class="whead">
					<h6><?php
						echo $model->isNewRecord ? 'Регистрация нового груза' : 'Редактирование груза "'
								. '№' . $model->id . ' - ' . $model->name . '"'
						?>
					</h6>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<?php echo $form->errorSummary($model) ?>
				</div>
				<div class="formRow">
					<div class="grid1"><label>Дата:<span class="req">*</span></label></div>
					<div class="grid3">
						<ul class="datesRange">
							<li>
								<?php echo $form->textField($model, 'date_from', array('id' => 'fromDate', 'placeholder' => 'С')) ?>
							</li>
							<li class="sep" style="margin-top: 7px; font-weight: bold">-</li>
							<li>
								<?php echo $form->textField($model, 'date_to', array('id' => 'toDate', 'placeholder' => 'По')) ?>
							</li>
						</ul>
					</div>
					<div class="grid1">
						<?php echo $form->error($model, 'date_from', array('class' => 'error')); ?>
						<?php echo $form->error($model, 'date_to', array('class' => 'error')); ?>
					</div>
					<div class="grid3"><label>Короткое название:<span class="req">*</span></label></div>
					<div class="grid3">
						<?php echo $form->textField($model, 'name') ?>
						<?php echo $form->error($model, 'name', array('class' => 'error')); ?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<div class="grid2"><label>Отправление из:<span class="req">*</span></label></div>
					<div class="grid3">
						<?php
							echo CHtml::activeDropDownList($model, 'country_id_from', $countries,
									array('empty' => 'Выберите страну', 'class' => 'countryFrom'), array());
							?>
						<?php echo $form->error($model, 'country_id_from', array('class' => 'error')); ?>
					</div>
					<div class="grid3">
						<?php echo CHtml::activeDropDownList($model, 'region_id_from', 
								$regions,
								array('empty' => 'Выберите регион', 'class' => 'regionFrom'), 
								array());
						?>
						<?php echo $form->error($model, 'region_id_from', array('class' => 'error')); ?>
					</div>
					<div class="grid4">
						<?php echo CHtml::activeDropDownList($model, 'city_id_from', 
								$cities,
								array('empty' => 'Выберите населенный пункт', 'class' => 'cityFrom'), 
								array());
						?>
						<?php echo $form->error($model, 'city_id_from', array('class' => 'error')); ?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<div class="grid2"><label>Прибытие в:<span class="req">*</span></label></div>
					<div class="grid3">
						<?php
							echo CHtml::activeDropDownList($model, 'country_id_to', $countries,
									array('empty' => 'Выберите страну', 'class' => 'countryTo'), array());
							?>
						<?php echo $form->error($model, 'country_id_to', array('class' => 'error')); ?>
					</div>
					<div class="grid3">
						<?php echo CHtml::activeDropDownList($model, 'region_id_to', 
								$regions,
								array('empty' => 'Выберите регион', 'class' => 'regionTo'), 
								array());
						?>
						<?php echo $form->error($model, 'region_id_to', array('class' => 'error')); ?>
					</div>
					<div class="grid4">
						<?php echo CHtml::activeDropDownList($model, 'city_id_to', 
								$cities,
								array('empty' => 'Выберите населенный пункт', 'class' => 'cityTo'), 
								array());
						?>
						<?php echo $form->error($model, 'city_id_to', array('class' => 'error')); ?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<div class="grid3"><label>Тип транспорта:<span class="req">*</span></label></div>
					<div class="grid9 check">
						<?php foreach ($vehicleTypes as $type): ?>
							<input type="checkbox" id="vehicleType_<?php echo $type->id ?>" <?php if (in_array($type->id,
								$vehicleTypesChecked)) echo 'checked' ?> name="Goods[vehicle_types][<?php echo $type->id ?>]" />
							<label for="vehicleType_<?php echo $type->id ?>" class="mr20"><?php echo $type->name_ru ?></label>
						<?php endforeach; ?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<div class="grid3"><label>Тип кузова:<span class="req">*</span></label></div>
					<div class="grid9">
						<select multiple="multiple" class="fullwidth select" data-placeholder="Выберите из списка кликнув сюда" name="Goods[body_types][]">
							<option value=""></option>
							<?php foreach ($bodyTypes as $bodyType): ?>
									<option value="<?php echo $bodyType->id ?>"><?php echo $bodyType->name_ru ?></option>
							<?php endforeach; ?>
						</select>
						<?php echo $form->error($model, 'body_types', array('class' => 'error')); ?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<div class="grid3"><label>Вид загрузки:<span class="req">*</span></label></div>
					<div class="grid9 check">
						<?php foreach ($shipments as $shipment): ?>
							<input type="checkbox" id="shipment_<?php echo $shipment->id ?>" <?php if (in_array($shipment->id,
								$shipmentsChecked)) echo 'checked' ?> name="Goods[shipments][<?php echo $shipment->id ?>]" />
							<label for="shipment_<?php echo $shipment->id ?>" class="mr20"><?php echo $shipment->name_ru ?></label>
						<?php endforeach; ?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<div class="grid2"><label>Вес груза (т.):<span class="req">*</span></label></div>
					<div class="grid1"><label>От:</label></div>
					<div class="grid2 goods">
						<?php echo $form->textField($model, 'weight_from', array('id' => 'weightFrom', 'style' => 'margin 0;')) ?>
						<?php echo $form->error($model, 'weight_from', array('class' => 'error')); ?>
					</div>
					<div class="grid1">&nbsp;</div>
					<div class="grid1"><label>До:</label></div>
					<div class="grid2">
						<?php echo $form->textField($model, 'weight_to', array('id' => 'weightTo')) ?>
						<?php echo $form->error($model, 'weight_to', array('class' => 'error')); ?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<div class="grid2"><label>Объем груза (м&sup3;):<span class="req">*</span></label></div>
					<div class="grid1"><label>От:</label></div>
					<div class="grid2 goods">
						<?php echo $form->textField($model, 'capacity_from', array('id' => 'capacityFrom')) ?>
						<?php echo $form->error($model, 'capacity_from', array('class' => 'error')); ?>
					</div>
					<div class="grid1">&nbsp;</div>
					<div class="grid1"><label>До:</label></div>
					<div class="grid2">
						<?php echo $form->textField($model, 'capacity_to', array('id' => 'capacityTo')) ?>
						<?php echo $form->error($model, 'capacity_to', array('class' => 'error')); ?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<div class="grid3"><label>Разрешения:<span class="req">*</span></label></div>
					<div class="grid9 check">
						<?php foreach ($permissions as $permission): ?>
							<input type="checkbox" id="permission_<?php echo $permission->id ?>" <?php if (in_array($permission->id,
								$permissionsChecked)) echo 'checked' ?> name="Goods[permissions][<?php echo $permission->id ?>]" />
							<label for="permission_<?php echo $permission->id ?>" class="mr20"><?php echo $permission->name_ru ?></label>
						<?php endforeach; ?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<div class="grid2"><label>Стоимость:<span class="req">*</span></label></div>
					<div class="grid2 onlyNums">
						<?php echo $form->textField($model, 'cost') ?>
						<?php echo $form->error($model, 'cost'); ?>
					</div>
					<div class="grid3">
						<?php
							echo CHtml::activeDropDownList($model, 'currency_id', $currencies,
									array('empty' => 'Валюта'), array());
							?>
						<?php echo $form->error($model, 'currency_id', array('class' => 'error')); ?>
					</div>
					<div class="grid3">
						<?php
							echo CHtml::activeDropDownList($model, 'payment_type_id', $payments,
									array('empty' => 'Вид оплаты'), array());
							?>
						<?php echo $form->error($model, 'payment_type_id', array('class' => 'error')); ?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<div class="grid2"><label>Описание:</label></div>
					<div class="grid9">
						<?php echo $form->textArea($model, 'description') ?>
						<?php echo $form->error($model, 'description'); ?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<?php
					echo CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить',
							array(
						'class' => 'buttonM bBlack formSubmit',
					));
					?>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
			</div>
			<?php $this->endWidget(); ?>
	</div>
	<!-- Content ends -->
<?php /*$this->renderPartial('/blocks/popups/goods', array(
			'vehicleTypes' => $vehicleTypes,
			'countries' => $countries,
			'regions' => $regions,
			'cities' => $cities,
			'bodyTypes' => $bodyTypes,
			'shipments' => $shipments,
			'permissions' => $permissions,
			'shipmentsChecked' => $shipmentsChecked,
			'permissionsChecked' => $permissionsChecked,
			'vehicleTypesChecked' => $vehicleTypesChecked,
			'bodyTypesChecked' => $bodyTypesChecked,
			'currencies' => $currencies,
			'payments' => $payments,
			'model' => $model,
		)) */?>