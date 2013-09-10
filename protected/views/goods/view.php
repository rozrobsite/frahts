<script type="text/javascript">
var myMap, route, incidental_goods = '';
var good_id = <?php echo isset($model->id) ? $model->id : 0 ?>;
var vehicle_id = <?php echo $vid ? $vid : 0 ?>;
var center = [<?php echo $model->cityFrom->latitude ?>, <?php echo $model->cityFrom->longitude ?>];
var start = [<?php echo $model->cityFrom->latitude ?>, <?php echo $model->cityFrom->longitude ?>];
var end = [<?php echo $model->cityTo->latitude ?>, <?php echo $model->cityTo->longitude ?>];
var cost = <?php echo $model->currency->id <= Currency::MAX_CALCULATE_TYPE_ID ? $model->cost : 0; ?>;
var view_calc = <?php echo $model->currency->id <= Currency::MAX_CALCULATE_TYPE_ID ? 1 : 0; ?>
</script>

<?php
Yii::app()->clientScript->registerScriptFile('http://api-maps.yandex.ru/2.0/?load=package.full&lang=ru-RU');
Yii::app()->clientScript->registerScriptFile('/js/files/goodsMap.js');

$this->pageTitle = Yii::app()->name . ' - Данные о грузе "' . $model->name . '"';
$this->breadcrumbs = array(
	'Данные о грузе',
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
                <li><a href="<?php echo Yii::app()->session['redirectUrl']; ?>">Поиск грузов</a></li>
                <li class="current">
					<a title="">
						<?php echo 'Данные о грузе "' . $model->name . '"'; ?>
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
                    <!--<span class="inLogo"><a href="index.html" title="invoice"><img src="images/newLogo.png" alt="logo" /></a></span>-->
                    <div class="inInfo">
                        <span class="invoiceNum"><?php echo $model->name ?></span>
                        <i>Добавлено: <?php echo Yii::app()->dateFormatter->format('dd.MM.yyyy HH:mm', $model->updated_at); ?></i>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="inContainer">
                    <div class="inFrom" style="width:30%">
                        <h5>Данные о грузе</h5>
                        <span><strong>Дата доставки:</strong> с <?php echo Yii::app()->dateFormatter->format('dd.MM.yyyy', $model->date_from); ?>
							по <?php echo Yii::app()->dateFormatter->format('dd.MM.yyyy', $model->date_to); ?></span>
                        <span><strong>Откуда:</strong> <?php echo $model->cityFrom->name_ru ?>, <?php echo $model->regionFrom->name_ru ?>, <?php echo $model->countryFrom->name_ru ?></span>
                        <span><strong>Куда:</strong> <?php echo $model->cityTo->name_ru ?>, <?php echo $model->regionTo->name_ru ?>, <?php echo $model->countryTo->name_ru ?></span>
                        <span><strong>Подходящие типы транспорта:</strong> <?php echo $vehicleTypes; ?></span>
                        <span><strong>Подходящие типы кузовов:</strong> <?php echo $bodyTypes; ?></span>
                        <?php if (!empty($shipments)): ?>
							<span><strong>Подходящие виды загрузки:</strong> <?php echo $shipments; ?></span>
						<?php endif; ?>
                        <span>
							<strong>Вес груза: </strong>
							<?php if ($model->weight_from): ?>
								от <?php echo $model->weight_from; ?> т.
								до <?php echo $model->weight_to; ?> т.
							<?php else: ?>
								<?php echo $model->weight_exact_value; ?> т.
							<?php endif; ?>
						</span>
                        <span>
							<strong>Объем груза: </strong>
							<?php if ($model->capacity_from): ?>
								от <?php echo $model->capacity_from; ?> м&sup3;
								до <?php echo $model->capacity_to; ?> м&sup3;
							<?php else: ?>
								<?php echo $model->capacity_exact_value; ?> м&sup3;
							<?php endif; ?>
						</span>
						<?php if (!empty($permissions)): ?>
							<span><strong>Требуемые разрешения:</strong> <?php echo $permissions; ?></span>
						<?php endif; ?>
							<span><strong>Оплата:</strong> <?php echo $model->cost . ' ' . $model->currency->name_ru; ?> <label id="calculate"></label> <label id="shortNameCost" style="display: none;"><?php echo $model->currency->id <= Currency::MAX_CALCULATE_TYPE_ID ? $model->currency->getShortName() : ''; ?>/км)</label></span>
						<span><strong>Вид платежа:</strong> <?php echo $model->paymentType->name_ru; ?></span>
                    </div>
					<div class="floatR" style="width:55%;height:430px; margin:10px;">
						<div id="map" style="width:100%;height:430px;"></div>
						<div style="float:left;">
							<label><strong>Общая длина маршрута: </strong><span id="total_length_route"></span></label>
						</div>
						<div style="float:right;">
							<label><strong>Среднее время в пути: </strong><span id="total_time_route"></span></label>
						</div>
					</div>
					<?php if ($this->user->profiles): ?>
                    <div class="inFrom" style="width:30%">
						<h5>Владелец груза</h5>
						<span>
							<strong>
								<?php echo $model->user->profiles->userType->name_ru; ?>
								<?php if ($model->user->profiles->userType->id == UserTypes::DISPATCHER): ?>
									(Комиссия: <?php echo $model->fee ?>)
								<?php endif; ?>
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
						<?php if (!$this->user->profiles && !$this->user->vehicles): ?>
							<div class="inFrom" style="width:30%">
								<label>Для того чтобы просмотреть данные о владельце груза Вам необходимо заполнить
									<a href="/user">информацию о себе</a> и добавить хотя бы одно <a href="/vehicle/new">транспортное средство</a>
								</label>
							</div>
						<?php elseif ($this->user->vehicles && !$this->user->profiles): ?>
							<div class="inFrom" style="width:30%">
								<label>Для того чтобы просмотреть данные о владельце груза Вам необходимо заполнить
									<a href="/user">информацию о себе</a>
								</label>
							</div>
						<?php elseif ($this->user->profiles && !$this->user->vehicles): ?>
							<div class="inFrom" style="width:30%">
								<label>Для того чтобы просмотреть данные о владельце груза Вам необходимо добавить хотя бы одно <a href="/vehicle/new">транспортное средство</a></label>
							</div>
						<?php endif; ?>
					<?php */endif; ?>
					<?php if (!empty($model->description)): ?>
                    <div class="inFrom" style="width:100%">
						<h5>Дополнительное описание</h5>
						<p>
							<?php echo $model->description; ?>
						</p>
                    </div>
					<?php endif; ?>
                    <div class="clear"></div>
                </div>
				<?php if ($this->user->profiles && count($this->user->vehicles)): ?>
					<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tLight" style="text-align: center;<?php if (empty($model->description)): ?> margin-top: 20px;<?php endif; ?>">
						<tr>
							<td style="width:25%">
								<a id="messageDialog_open" href="/user/messages/user/<?php echo $model->user->id ?>#users_message" title="Написать сообщение владельцу груза" class="sideB bSea tipS">Сообщение</a>
							</td>
							<td style="width:25%">
								<a id="offer" href="javascript:void(0)"
								   data-receiving-user-id="<?php echo $model->user->id ?>"
								   data-model-id="<?php echo $model->id ?>"
								   data-model-type="<?php echo Offers::TYPE_GOOD ?>"
								   title="Предложить одно или несколько своих транспортных средств владельцу груза"
								   class="sideB bGreyish tipS" <?php if($offer): ?>style="display:none"<?php endif; ?>>Предложить свой транспорт</a>
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
<input id="point_sent" type="hidden" value="Точка отправления: <?php echo $model->cityFrom->name_ru ?>, <?php echo $model->regionFrom->name_ru ?>, <?php echo $model->countryFrom->name_ru ?>" />
<input id="point_arrival" type="hidden" value="Точка прибытия: <?php echo $model->cityTo->name_ru ?>, <?php echo $model->regionTo->name_ru ?>, <?php echo $model->countryTo->name_ru ?>" />

<?php //$this->renderPartial('/blocks/popups/_message', array('model' => $model, 'objectType' => Messages::GOOD)); ?>
<!-- Content ends -->
<?php if (count($this->user->vehicles)): ?>
	<?php $this->renderPartial('/blocks/popups/_offer', array('model' => $model, 'currencies' => $currencies, 'modelType' => Offers::TYPE_GOOD)); ?>
<?php endif; ?>
