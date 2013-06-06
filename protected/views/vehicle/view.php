<?php
$this->pageTitle = Yii::app()->name . ' - Данные о транспортном средстве "' . $model->name . '"';
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
                <li><a href="/">Главная</a></li>
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
		<div class="widget">
            <div class="invoice">
                <div class="inHead">
                    <!--<span class="inLogo"><a href="index.html" title="invoice"><img src="images/newLogo.png" alt="logo" /></a></span>-->
                    <div class="inInfo">
                        <span class="invoiceNum"><?php echo $model->name ?></span>
                        <i>Зарегистрирован: <?php echo Yii::app()->dateFormatter->format('dd.MM.yyyy H:m', $model->created_at); ?></i>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="inContainer">
                    <div class="inFrom" style="width:30%">
                        <h5>Данные о транспортном средстве</h5>
                        <span><strong>Транспорт свободен:</strong> с <?php echo Yii::app()->dateFormatter->format('dd.MM.yyyy', $model->date_from); ?>
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
						<span><strong>Вид загрузки:</strong> <?php echo $shipments; ?></span>
						<span><strong>Разрешения:</strong> <?php echo $permissions; ?></span>
                    </div>
					<div class="floatR" style="width:50%;height:430px; margin:10px;">
						<div id="map" style="width:100%;height:430px;">

						</div>
						<div>
							<label><strong>Общая длина маршрута: </strong><span id="total_length_route"></span></label>
						</div>
					</div>
                    <div class="inFrom" style="width:30%">
						<h5>Владелец транспортного средства</h5>
						<span>
							<?php echo $model->user->profiles->last_name . ' ' . $model->user->profiles->first_name . ' ' . $model->user->profiles->middle_name; ?>
						</span>
						<span><?php echo $model->user->profiles->userType->name_ru; ?></span>
						<span><?php echo $model->user->organizations->name_org; ?></span>
						<span class="number">Мобильный телефон: <strong class="red"><?php echo $model->user->profiles->mobile ?></strong></span>
						<span>На сайте с <?php echo Yii::app()->dateFormatter->format('dd.MM.yyyy', $model->date_from); ?></span>
                    </div>
                    <div class="clear"></div>
                </div>

                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tLight">
                    <thead>
                        <tr>
                            <td width="30%">Product</td>
                            <td width="42%">Descrition</td>
                            <td width="19%">Discount</td>
                            <td width="9%">Total</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Concept</td>
                            <td>Creating project concept and logic</td>
                            <td>0</td>
                            <td><strong>$1100</strong></td>
                        </tr>
                        <tr>
                            <td>General design</td>
                            <td>Design prototype</td>
                            <td>0</td>
                            <td><strong>$2000</strong></td>
                        </tr>
                        <tr>
                            <td>Front end development</td>
                            <td>Coding and connecting front end</td>
                            <td>0</td>
                            <td><strong>$1600</strong></td>
                        </tr>
                        <tr>
                            <td>Database</td>
                            <td>Creating and connecting database</td>
                            <td>0</td>
                            <td><strong>$890</strong></td>
                        </tr>
                    </tbody>
                </table>

                <div>
                    <div class="inFrom">
                        <h5>Payment method: <i class="red">Wire transfer</i></h5>
                        <span>Bank account #</span>
                        <span>SWIFT code</span>
                        <span>IBAN</span>
                        <span>Billing address</span>
                        <span>Name</span>
                    </div>

                    <div class="total">
                        <span>Amount Due</span>
                        <strong class="red">$00.00</strong>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="inFooter">
                    <div class="footnote">Thank you very much for choosing us. It was pleasure to work with you.</div>
                    <ul class="cards">
                        <li class="discover"><a href="#"></a></li>
                         <li class="visa"><a href="#"></a></li>
                         <li class="mc"><a href="#"></a></li>
                         <li class="pp"><a href="#"></a></li>
                         <li class="amex"><a href="#"></a></li>
                    </ul>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
	</div>
</div>
<!-- Content ends -->