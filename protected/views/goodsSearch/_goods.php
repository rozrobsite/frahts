<?php
/* @var $this UserController */
/* @var $model Users */

$this->pageTitle = Yii::app()->name . ' - ' . ($model->isNewRecord ? 'Регистрация нового груза' : 'Редактирование груза "' . $model->name . '"');
$this->breadcrumbs = array(
	'Действия с грузами',
);
?>
<!-- Sidebar begins -->
<div id="sidebar">
	<?php $this->renderPartial('/blocks/mainNav') ?>
    <!-- Secondary nav -->
    <div class="secNav">
		<?php
		$this->renderPartial('_secWrapper', array(
			'goodsActive' => $goodsActive,
			'vehicles' => $vehicles,
		));
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
					<a title="">
						<?php echo $model->isNewRecord ? 'Регистрация нового груза' : 'Редактирование груза' ?>
					</a>
				</li>
            </ul>
        </div>

    </div>

    <!-- Main content -->
    <div class="wrapper">
	<?php $this->renderPartial('/blocks/_notify') ?>
	<?php $this->renderPartial('/blocks/_middleNavR') ?>
			<?php if ($model->id): ?>
				<div class="widget fluid">
					<div class="formRow">
						<div class="grid10">
							<label>
								Если Ваш груз доставлен к месту назначения или Вы по какой то причине не хотите чтобы он показывался грузоперевозчикам,
								удалите его из поиска.<br/>
								Также, Ваш груз автоматически будет удален из поиска если у него истекла дата доставки.
							</label>
						</div>
						<div class="grid2" style="text-align: right">
							<a href="/goods/delete/<?php echo $model->id ?>" class="buttonM bGold">Удалить из поиска</a>
						</div>
						<div class="clear"></div>
					</div>
				</div>
			<?php endif; ?>
			<?php
				$form = $this->beginWidget('CActiveForm',
						array(
					'id' => 'goodsSearchForm',
					'enableAjaxValidation' => false,
					'clientOptions' => array(
						'validateOnSubmit' => true,
						'hideErrorMessage'=>false,
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
				<?php $this->renderPartial('/blocks/_atention'); ?>
				<div class="formRow">
					<div class="grid2"><label>Дата загрузки:<span class="req">*</span></label></div>
					<div class="grid3">
						<ul class="datesRange">
							<li>
								<?php if ($model->date_from) $model->date_from = date('d.m.Y', $model->date_from); echo $form->textField($model, 'date_from', array('id' => 'fromDate', 'placeholder' => 'С')) ?>
							</li>
							<li class="sep" style="font-weight: bold">-</li>
							<li>
								<?php if ($model->date_to) $model->date_to = date('d.m.Y', $model->date_to); echo $form->textField($model, 'date_to', array('id' => 'toDate', 'placeholder' => 'По')) ?>
							</li>
						</ul>
						<br/><br/>
						<?php echo $form->error($model, 'date_from', array('class' => 'error')); ?>
						<?php echo $form->error($model, 'date_to', array('class' => 'error')); ?>
					</div>
					<div class="grid4"><label>Короткое название груза (не более 30 символов):<span class="req">*</span></label></div>
					<div class="grid3">
						<?php echo $form->textField($model, 'name', array('maxlength' => 24)) ?>
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
								$regionsFrom,
								array('empty' => 'Выберите регион', 'class' => 'regionFrom'),
								array());
						?>
						<?php echo $form->error($model, 'region_id_from', array('class' => 'error')); ?>
					</div>
					<div class="grid4">
						<?php echo CHtml::activeDropDownList($model, 'city_id_from',
								$citiesFrom,
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
								$regionsTo,
								array('empty' => 'Выберите регион', 'class' => 'regionTo'),
								array());
						?>
						<?php echo $form->error($model, 'region_id_to', array('class' => 'error')); ?>
					</div>
					<div class="grid4">
						<?php echo CHtml::activeDropDownList($model, 'city_id_to',
								$citiesTo,
								array('empty' => 'Выберите населенный пункт', 'class' => 'cityTo'),
								array());
						?>
						<?php echo $form->error($model, 'city_id_to', array('class' => 'error')); ?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<div class="grid3"><label>Тип транспорта:</label></div>
					<div class="grid9 check">
						<?php foreach ($vehicleTypes as $type): ?>
							<input type="checkbox" id="vehicleType_<?php echo $type->id ?>" <?php if (in_array($type->id,
								$vehicleTypesChecked)) echo 'checked' ?> name="Goods[vehicle_types][<?php echo $type->id ?>]" />
							<label for="vehicleType_<?php echo $type->id ?>" class="mr20"><?php echo $type->name_ru ?></label>
						<?php endforeach; ?>
						<?php echo $form->error($model, 'vehicle_types', array('class' => 'error')); ?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<div class="grid3"><label>Тип кузова:<span class="req">*</span></label></div>
					<div class="grid9">
						<select multiple="multiple" class="fullwidth select" data-placeholder="Выберите из списка кликнув сюда" name="Goods[body_types][]">
							<option value=""></option>
							<?php foreach ($bodyTypes as $bodyType): ?>
									<option value="<?php echo $bodyType->id ?>" <?php if (in_array($bodyType->id, $bodyTypesChecked)): ?>selected="selected"<?php endif; ?>>
										<?php echo $bodyType->name_ru ?>
									</option>
							<?php endforeach; ?>
						</select>
						<?php echo $form->error($model, 'body_types', array('class' => 'error')); ?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<div class="grid2"><label>Вид загрузки:<span class="req">*</span></label></div>
					<div class="grid10 check">
						<?php foreach ($shipments as $shipment): ?>
							<input type="checkbox" id="shipment_<?php echo $shipment->id ?>" <?php if (in_array($shipment->id,
								$shipmentsChecked)) echo 'checked' ?> name="Goods[shipments][<?php echo $shipment->id ?>]" />
							<label for="shipment_<?php echo $shipment->id ?>" class="mr20"><?php echo $shipment->name_ru ?></label>
						<?php endforeach; ?>
						<br/><br/>
						<?php echo $form->error($model, 'shipments', array('class' => 'error')); ?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<div class="grid2"><label>Вес груза (т.):<span class="req">*</span></label></div>
					<div class="grid1"><label>От:</label></div>
					<div class="grid1 goods">
						<?php echo $form->textField($model, 'weight_from', array('id' => 'weightFrom', 'style' => 'margin 0;')) ?>
						<?php echo $form->error($model, 'weight_from', array('class' => 'error')); ?>
					</div>
					<div class="grid1"><label>До:</label></div>
					<div class="grid1">
						<?php echo $form->textField($model, 'weight_to', array('id' => 'weightTo')) ?>
						<?php echo $form->error($model, 'weight_to', array('class' => 'error')); ?>
					</div>
					<div class="grid2">&nbsp;</div>
					<div class="grid2"><label>Точное значение (т.):</label></div>
					<div class="grid2">
						<?php echo $form->textField($model, 'weight_exact_value', array('id' => 'weightExactValue', 'class' => 'goods')) ?>
						<?php echo $form->error($model, 'weight_exact_value', array('class' => 'error')); ?>
					</div>

					<div class="clear"></div>
				</div>
				<div class="formRow">
					<div class="grid2"><label>Объем груза (м&sup3;):<span class="req">*</span></label></div>
					<div class="grid1"><label>От:</label></div>
					<div class="grid1 goods">
						<?php echo $form->textField($model, 'capacity_from', array('id' => 'capacityFrom')) ?>
						<?php echo $form->error($model, 'capacity_from', array('class' => 'error')); ?>
					</div>
					<div class="grid1"><label>До:</label></div>
					<div class="grid1">
						<?php echo $form->textField($model, 'capacity_to', array('id' => 'capacityTo')) ?>
						<?php echo $form->error($model, 'capacity_to', array('class' => 'error')); ?>
					</div>
					<div class="grid2">&nbsp;</div>
					<div class="grid2"><label>Точное значение (м&sup3;):</label></div>
					<div class="grid2">
						<?php echo $form->textField($model, 'capacity_exact_value', array('id' => 'capacityExactValue')) ?>
						<?php echo $form->error($model, 'capacity_exact_value', array('class' => 'error')); ?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<div class="grid3"><label>Разрешения:</label></div>
					<div class="grid9 check">
						<?php foreach ($permissions as $permission): ?>
							<input type="checkbox" id="permission_good_<?php echo $permission->id ?>" <?php if (in_array($permission->id,
								$permissionsChecked)) echo 'checked' ?> name="Goods[permissions][<?php echo $permission->id ?>]" />
							<label for="permission_<?php echo $permission->id ?>" class="mr20"><?php echo $permission->name_ru ?></label>
							<?php if ($permission->id == 4) {
									echo CHtml::activeDropDownList($model, 'adr',
										array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9'),
										array('class' => 'bodyType'), array());
									echo '<br/><br/>';
								}
							?>
						<?php endforeach; ?>

						<?php echo $form->error($model, 'permissions', array('class' => 'error')); ?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<div class="grid2"><label>Стоимость:<span class="req">*</span></label></div>
					<div class="grid2 onlyNums">
						<?php echo $form->textField($model, 'cost') ?>
						<?php echo $form->error($model, 'cost', array('class' => 'error')); ?>
					</div>
					<div class="grid2">
						<?php
							echo CHtml::activeDropDownList($model, 'currency_id', $currencies,
									array('empty' => 'Валюта'), array());
							?>
						<?php echo $form->error($model, 'currency_id', array('class' => 'error')); ?>
					</div>
					<div class="grid2">
						<?php
							echo CHtml::activeDropDownList($model, 'payment_type_id', $payments,
									array('empty' => 'Вид оплаты'), array());
							?>
						<?php echo $form->error($model, 'payment_type_id', array('class' => 'error')); ?>
					</div>
					<div class="clear"></div>
				</div>
				<?php if ($this->user->profiles->user_type_id == UserTypes::DISPATCHER): ?>
				<div class="formRow">

					<div class="grid3"><label>Комиссия за перевозку:<span class="req">*</span></label></div>

					<div class="grid2 onlyNums">
						<?php echo $form->textField($model, 'fee') ?>
						<?php echo $form->error($model, 'fee', array('class' => 'error')); ?>
					</div>
					<div class="clear"></div>
				</div>
				<?php endif; ?>
				<div class="formRow">

					<div class="grid3"><label>Дополнительное описание груза:</label></div>

					<div class="grid8">

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
</div>
	<!-- Content ends -->