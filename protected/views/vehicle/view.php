<script type="text/javascript">
	var myMap, route;

	var center = [<?php echo $model->cities->latitude ?>, <?php echo $model->cities->longitude ?>];
	var start = [<?php echo $model->cities->latitude ?>, <?php echo $model->cities->longitude ?>];
	<?php if ($model->citiesTo->latitude): ?>
		var end = [<?php echo $model->citiesTo->latitude ?>, <?php echo $model->citiesTo->longitude ?>];
	<?php endif; ?>
</script>

<?php
Yii::app()->clientScript->registerScriptFile('http://api-maps.yandex.ru/2.0/?load=package.full&lang=ru-RU');
Yii::app()->clientScript->registerScriptFile('/js/files/vehicleMap.js');

$this->pageTitle = Yii::app()->name . ' - Данные о транспортном средстве "' . ucfirst($model->bodyType->name_ru) . " " . $model->marka->name . " " . $model->modeli->name
								. ', номер: ' . $model->license_plate . '"';
$this->breadcrumbs = array(
	'Данные о транспортном средстве',
);
?>
<!-- Sidebar begins -->
<div id="sidebar">
	<?php $this->renderPartial('/blocks/mainNav') ?>
    <!-- Secondary nav -->
    <div class="secNav">
		<?php
		$this->renderPartial('_secWrapperDetail', array());
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
                <li><a href="<?php echo isset($this->headerUrl) ? $this->headerUrl : '/user'; ?>">Главная</a></li>
                <li><a href="<?php echo Yii::app()->session['redirectUrl']; ?>">Поиск транспорта</a></li>
                <li class="current">
					<a title="">
						<?php echo 'Данные о транспорте "' . ucfirst($model->bodyType->name_ru) . " " . $model->marka->name . " " . $model->modeli->name
								. ', номер: ' . $model->license_plate . '"'; ?>
					</a>
				</li>
            </ul>
        </div>
    </div>

    <!-- Main content -->
    <div class="wrapper">
	<?php $this->renderPartial('/blocks/_notify') ?>
	<?php $this->renderPartial('/blocks/_middleNavR') ?>
		<div class="widget">
            <div class="invoice">
                <div class="inHead">
                    <!--<a href="#" class="buttonS bBrown" style="margin-top: 15px;margin-left: 15px;">Назад</a>-->
                    <div class="inInfo">
                        <span class="invoiceNum"><?php echo ucfirst($model->bodyType->name_ru) . " " . $model->marka->name . " " . $model->modeli->name ?></span>
                        <i>Зарегистрирован: <?php echo Yii::app()->dateFormatter->format('dd.MM.yyyy H:m', $model->created_at); ?></i>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="inContainer">
                    <div class="inFrom" style="width:30%">
                        <h5>Данные о транспортном средстве</h5>
                        <span><strong>Срок загрузки:</strong> с <?php echo Yii::app()->dateFormatter->format('dd.MM.yyyy', $model->date_from); ?>
							по <?php echo Yii::app()->dateFormatter->format('dd.MM.yyyy', $model->date_to); ?></span>
                        <span><strong>Текущее расположение:</strong> <?php echo $model->cities->name_ru ?>, <?php echo $model->regions->name_ru ?>, <?php echo $model->countries->name_ru ?></span>
                        <?php if (!empty($model->citiesTo->name_ru) || !empty($model->regionsTo->name_ru) || !empty($model->countriesTo->name_ru)): ?>
						<span><strong>Готов ехать в:</strong>
							<?php
								$location = array();
								if (!empty($model->citiesTo->name_ru))
									$location[] = $model->citiesTo->name_ru;
								if (!empty($model->regionsTo->name_ru))
									$location[] = $model->regionsTo->name_ru;
								if (!empty($model->countriesTo->name_ru))
									$location[] = $model->countriesTo->name_ru;
							?>
							<?php echo join(', ', $location) ?>
							</span>
						<?php endif; ?>
                        <span><strong>Тип транспорта:</strong> <?php echo $model->vehicleType->name_ru; ?></span>
                        <span><strong>Вид транспорта:</strong> <?php echo $model->categories->name; ?></span>
                        <span><strong>Марка:</strong> <?php echo $model->marka->name; ?></span>
                        <span><strong>Модель:</strong> <?php echo $model->modeli->name; ?></span>
                        <span><strong>Тип кузова:</strong> <?php echo $model->bodyType->name_ru; ?></span>
                        <span><strong>Номер транспорта:</strong> <?php echo $model->license_plate; ?></span>
						<?php if ($model->number_trailer): ?>
							<span><strong>Номер прицепа:</strong> <?php echo $model->number_trailer; ?></span>
						<?php endif; ?>
						<?php if ($model->number_semitrailer): ?>
							<span><strong>Номер полуприцепа:</strong> <?php echo $model->number_semitrailer; ?></span>
						<?php endif; ?>
                        <span><strong>Грузоподъемность:</strong> <?php echo $model->bearing_capacity; ?> т.</span>
                        <span><strong>Объем кузова:</strong> <?php echo $model->body_capacity; ?> м&sup3;</span>
						<?php if (count($shipments)): ?>
							<span><strong>Вид загрузки:</strong> <?php echo join(', ', $shipments); ?></span>
						<?php endif; ?>
						<?php if (count($permissions)): ?>
							<span><strong>Разрешения:</strong> <?php echo join(', ', $permissions); ?></span>
						<?php endif; ?>
                    </div>
					<div class="floatR" style="width:55%; margin:10px;">
							<?php if (count($model->photos)): ?>
								<div class="body" align="center">
									<?php for($i = 0; $i < count($model->photos); $i++): ?>
										<a href="<?php echo '/' . Yii::app()->params['files']['photos'] . $model->photos[$i]->size_superbig; ?>" class="lightbox" rel="group">
											<img width="80" height="80" src="<?php echo '/' . Yii::app()->params['files']['photos'] . $model->photos[$i]->size_middle; ?>" alt="<?php echo ucfirst($model->bodyType->name_ru) . " " . $model->marka->name . " " . $model->modeli->name ?>" />
										</a>
									<?php endfor; ?>
								</div>
							<?php endif; ?>
							<div id="map" style="width:100%;height:340px;margin-top: 25px;"></div>
							<div style="float:left;">
								<?php if (!empty($model->citiesTo->id)): ?>
									<label><strong>Общая длина маршрута: </strong><span id="total_length_route"><?php if ($model->citiesTo->latitude) echo 0; ?></span></label>
								<?php endif; ?>
							</div>
							<div style="float:right;">
								<?php if (!empty($model->citiesTo->id)): ?>
									<label><strong>Среднее время в пути: </strong><span id="total_time_route"><?php if ($model->citiesTo->latitude) echo 0; ?></span></label>
								<?php endif; ?>
							</div>
					</div>
					<?php if ($this->user->profiles): ?>
                    <div class="inFrom" style="width:100%">
						<h5>Владелец транспортного средства</h5>
						<span>
							<strong>
								<?php echo $model->user->profiles->userType->name_ru; ?>
							</strong>
						</span>
						<span>
							<a href="/user/view/<?php echo $model->user->id; ?>">
								<?php echo $model->user->profiles->last_name . ' ' . $model->user->profiles->first_name . ' ' . $model->user->profiles->middle_name; ?>
							</a>
						</span>
						<span><?php echo $model->user->organizations->name_org; ?></span>
						<span class="number">Мобильный телефон: <strong class="red"><?php echo $model->user->profiles->mobile ?></strong></span>
						<span>На сайте с <?php echo Yii::app()->dateFormatter->format('dd.MM.yyyy', $model->date_from); ?></span>
                    </div>
					<?php /*else: ?>
						<?php if (!$this->user->profiles && !$this->user->goods): ?>
							<div class="inFrom" style="width:100%">
								<label>Для того чтобы просмотреть данные о владельце транспортного средства Вам необходимо заполнить
									<a href="/user">информацию о себе</a> и добавить хотя бы один <a href="/goods/new">груз</a>
								</label>
							</div>
						<?php elseif ($this->user->goods && !$this->user->profiles): ?>
							<div class="inFrom" style="width:100%">
								<label>Для того чтобы просмотреть данные о владельце транспортного средства Вам необходимо заполнить
									<a href="/user">информацию о себе</a>
								</label>
							</div>
						<?php elseif ($this->user->profiles && !$this->user->goods): ?>
							<div class="inFrom" style="width:100%">
								<label>Для того чтобы просмотреть данные о владельце транспортного средства Вам необходимо добавить хотя бы один <a href="/goods/new">груз</a></label>
							</div>
						<?php endif; ?>
					<?php */endif; ?>

                    <?php /*
					<div class="inFrom" style="width:100%">
						<h5>Дополнительное описание</h5>
						<p>
							<?php echo $model->description; ?>
						</p>
                    </div>
					 *
					 */?>
                    <div class="clear"></div>
                </div>
				<?php if ($this->user->profiles && count($this->user->goods)): ?>
					<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tLight" style="text-align: center;">
						<tr>
							<td style="width:25%">
								<a id="messageDialog_open" href="/user/messages/user/<?php echo $model->user->id ?>#users_message" title="Написать сообщение владельцу транспортного средства" class="sideB bSea tipS">Сообщение</a>
							</td>
							<td style="width:25%">
								<a id="offer" href="javascript:void(0)"
								   data-receiving-user-id="<?php echo $model->user->id ?>"
								   data-model-id="<?php echo $model->id ?>"
								   data-model-type="<?php echo Offers::TYPE_VEHICLE ?>"
								   title="Предложить один или несколько своих грузов владельцу транспортного средства"
								   class="sideB bGreyish tipS" <?php if($offer): ?>style="display:none"<?php endif; ?>>Предложить свой груз</a>
								<span id="offer_refuse_message" <?php if(!$offer): ?>style="display:none"<?php endif; ?>>
									Вы сделали предложение.<br/>
									<a id="offer_cancel" herf="javascript:void(0)" data-id="<?php echo $offer ? $offer->id : ''; ?>">Отменить</a>
								</span>
							</td>
							<td style="width:25%"></td>
							<td style="width:25%"></td>
						</tr>
					</table>
				<?php endif; ?>
            </div>
        </div>
	</div>
</div>
<!-- Content ends -->
<input id="point_sent" type="hidden" value="Текущее положение: <?php echo $model->cities->name_ru ?>, <?php echo $model->regions->name_ru ?>, <?php echo $model->countries->name_ru ?>" />
<input id="point_arrival" type="hidden" value="Готов ехать: <?php echo $model->citiesTo->name_ru ?>, <?php echo $model->regionsTo->name_ru ?>, <?php echo $model->countriesTo->name_ru ?>" />

<?php if (count($this->user->goods)): ?>
	<?php $this->renderPartial('/blocks/popups/_offer', array('model' => $model, 'currencies' => $currencies, 'modelType' => Offers::TYPE_VEHICLE)); ?>
<?php endif; ?>