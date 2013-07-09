<script type="text/javascript">
	var myMap;
	var cityname = "<?php echo $model->profiles->city->name_ru ?>";
	var address = "<?php echo $model->profiles->address ?>";
</script>

<?php

Yii::app()->clientScript->registerScriptFile('http://api-maps.yandex.ru/2.0/?load=package.full&lang=ru-RU');
//Yii::app()->clientScript->registerScriptFile('/js/files/userMap.js'); //включить карту

$this->pageTitle = Yii::app()->name . ' - Данные о пользователе "' . $model->profiles->last_name . ' ' . $model->profiles->first_name . ' ' . $model->profiles->middle_name . '"';
$this->breadcrumbs = array(
	'Данные о пользователе',
);

?>
<!-- Sidebar begins -->
<div id="sidebar">
	<?php $this->renderPartial('/blocks/mainNav') ?>
    <!-- Secondary nav -->
    <div class="secNav">
		<?php
		//$this->renderPartial('_secWrapperDetail', array());
		?>
	</div>
</div>
<!-- Sidebar ends -->
<div id="content">
<!-- 	<?php $this->renderPartial('/blocks/contentTop') ?> -->

    <!-- Breadcrumbs line -->
    <div class="breadLine">
        <div class="bc">
            <ul id="breadcrumbs" class="breadcrumbs">
                <li><a href="/">Главная</a></li>
                <li><a href="<?php echo Yii::app()->session['redirectUrl']; ?>">Поиск груза</a></li>
                <li class="current">
					<a title="">
						<?php echo 'Данные о пользователе "' . $model->profiles->last_name . ' ' . $model->profiles->first_name . ' ' . $model->profiles->middle_name . '"'; ?>
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
                    <div class="inInfo">
                        <span class="invoiceNum">Данные о пользователе</span>
                     </div>
                    <div class="clear"></div>
                </div> 

                <div class="inContainer">
                    <div class="inFrom" >                        					
						<h5><?php echo $model->profiles->last_name . ' ' . $model->profiles->first_name . ' ' . $model->profiles->middle_name; ?></h5>
					
						<span><strong><?php echo $model->profiles->userType->name_ru; ?></strong></span>
						
						<span>На сайте с <?php echo Yii::app()->dateFormatter->format('dd.MM.yyyy', $model->profiles->created_at); ?></span> 
						<span class="number">Рейтинг: <?php echo $model->profiles->rating; ?></span>
						<strong>Расположение</strong>
						<span><?php echo $model->profiles->country->name_ru .", ". $model->profiles->region->name_ru .", ". $model->profiles->city->name_ru; ?></span>
						<span><?php echo $model->profiles->address; ?></span>
						<strong>Контакты</strong>
						<span class="number">Мобильный телефон: <strong class="red"><?php echo $model->profiles->mobile ?></strong></span>
						<span>Skype: <?php echo $model->profiles->skype; ?></span>
						<span>ICQ: <?php echo $model->profiles->icq; ?></span>
						<br />	
						<h5><?php echo $model->organizations->name_org; ?></h5>
						<span><?php echo $model->organizations->typeOrg->name_ru; ?></span>
						<span>Форма: <?php echo $model->organizations->formOrganizations->name_ru; ?></span>
						<span>Форма налогообложения: <?php echo $model->organizations->form_tax; ?></span>
						<span>Лицензия: <?php echo $model->organizations->license; ?></span>
						<span>Сертификат: <?php echo $model->organizations->certificate; ?></span>
						
						<strong>Реквизиты</strong>
						<span>ИНН: <?php echo $model->organizations->inn; ?></span>
						<span>ЕДРПОУ: <?php echo $model->organizations->edrpou; ?></span>
						<span>Р. счет: <?php echo $model->organizations->account_number; ?></span>
						<span>Банк: <?php echo $model->organizations->bank; ?></span>
						<span>МФО: <?php echo $model->organizations->mfo; ?></span>
						
						<strong>Контакты</strong>
						<span><?php echo $model->organizations->city .", ". $model->organizations->address; ?></span>
						<span class="number">Телефон: <strong class="red"><?php echo $model->organizations->phone ?></strong></span>
						
					</div>
					<div class="floatR" style="width:50%;height:430px; margin:10px; border:1px solid;">
						<div id="map" style="width:100%;height:430px;"></div> 
					</div>					
								
                    <div class="clear"></div>
                </div>
				
				<div class="inContainer">
					<div class="widget grid6">       
						<ul class="tabs">
							<?php 
								switch ($model->profiles->userType->id) {
									case 1:
										$printVehicles = true;
										$printGoods = false;
										break;
									case 2:
										$printVehicles = false;
										$printGoods = true;
										break;
									default:
										$printVehicles = true;
										$printGoods = true;
								}							
							?>
						
						
							<li class="activeTab" style=""><a href="#tab_comments">Отзывы</a></li>
							<?php  if ($printGoods): ?> <li class=""><a href="#tab_goods">Грузы</a></li> <?php endif; ?>
							<?php  if ($printVehicles): ?> <li class=""><a href="#tab_vehicles">Транспорт</a></li> <?php endif; ?>
						</ul>
						
						<div class="tab_container">
							<div id="tab_comments" class="tab_content" style="display: block;">
									<!-- Enter messages field -->
									<div class="enterMessage">
										<input type="text" name="enterMessage" placeholder="Enter your message..." />
										<div class="sendBtn">
											<a href="#" title="" class="attachPhoto"></a>
											<a href="#" title="" class="attachLink"></a>
											<input type="submit" name="sendMessage" class="buttonS bLightBlue" value="Send" />
										</div>
									</div>										
								
									<div class="widget">
										<ul class="messagesTwo">
											<li class="by_user">
												<a href="#" title=""><img src="images/live/face1.png" alt="" /></a>
												<!--<div class="rating" style="display:inline-block; position:relative; left:10px; top:50px;">Оценка</div>-->
												<div class="messageArea">
													<div class="infoRow">
														<span class="name"><strong>Jonathan</strong> says:</span>
														<span class="time">3 hours ago</span>
														<div class="clear"></div>
													</div>
													Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam vel est enim, vel eleifend felis. Ut volutpat, leo eget euismod scelerisque, eros purus lacinia velit, nec rhoncus mi dui eleifend orci. 
													Phasellus ut sem urna, id congue libero. Nulla eget arcu vel massa suscipit ultricies ac id velit
												</div>
												<div class="clear"></div>
											</li>
										
											<li class="by_user">
												<a href="#" title=""><img src="images/live/face2.png" alt="" /></a>
												<div class="messageArea">
													<div class="infoRow">
														<span class="name"><strong>Eugene</strong> says:</span>
														<span class="time">3 hours ago</span>
														<div class="clear"></div>
													</div>
													Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam vel est enim, vel eleifend felis. Ut volutpat, leo eget euismod scelerisque, eros purus lacinia velit, nec rhoncus mi dui eleifend orci. 
													Phasellus ut sem urna, id congue libero. Nulla eget arcu vel massa suscipit ultricies ac id velit
												</div>
												<div class="clear"></div>
											</li>										
										</ul>
									</div>									
								</div>

		
							</div>
<!-- ********************************************* -->							
							<?php  if ($printGoods): ?>
							<div id="tab_goods" class="tab_content" style="display: none;"> 

								<?php  if ($model->goods && count($model->goods) > 0): ?>
									<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tLight" style="text-align: center;">
										<thead>
											<tr>
												<td width="40%">Маршрут</td>
												<td width="15%">Дата доставки</td>
												<td width="25%">Груз</td>
												<td width="20%">Дата добавления</td>
											</tr>
										</thead>
										<tbody>
											<?php foreach($model->goods as $oneGood): ?>
												<?php if (!$oneGood->is_deleted && $oneGood->date_to >= time() && $oneGood->id != $model->id): ?>
													<tr>
														<td>
															<span>
																<?php echo $oneGood->countryFrom->name_ru . ' - ' .  $oneGood->countryTo->name_ru?>
															</span><br/>
															<span>
																<?php echo $oneGood->regionFrom->name_ru . ' - ' .  $oneGood->regionTo->name_ru?>
															</span><br/>
															<span>
																<?php echo $oneGood->cityFrom->name_ru . ' - ' .  $oneGood->cityTo->name_ru?>
															</span>
															<br/>
															<span>
																<strong>&asymp;&nbsp;<?php echo ((int) FHelper::distance($oneGood->cityFrom->latitude, $oneGood->cityFrom->longitude, $oneGood->cityTo->latitude, $oneGood->cityTo->longitude) + 10) ?> км</strong>
															</span>
														</td>
														<td>
															с
															<?php echo Yii::app()->dateFormatter->format('dd.MM.yyyy', $oneGood->date_from); ?><br/>
															по
															<?php echo Yii::app()->dateFormatter->format('dd.MM.yyyy', $oneGood->date_to); ?>
														</td>
														<td>
															<a href="/goods/view/<?php echo $oneGood->slug ?>" class="tipS" title="Перейти на страницу груза">
																<?php echo $oneGood->name ?><br/>
																<?php
																$weight = 0;
																if (isset($oneGood->weight_exact_value) && $oneGood->weight_exact_value)
																{
																	$weight = $oneGood->weight_exact_value;
																}
																elseif (isset($oneGood->weight_to) && $oneGood->weight_to)
																{
																	$weight = $oneGood->weight_to;
																}
																?>
																Вес до: <?php echo $weight ?> т.<br/>
																<?php
																$capacity = 0;
																if (isset($oneGood->capacity_exact_value) && $oneGood->capacity_exact_value)
																{
																	$capacity = $oneGood->capacity_exact_value;
																}
																elseif (isset($oneGood->capacity_to) && $oneGood->capacity_to)
																{
																	$capacity = $oneGood->capacity_to;
																}
																?>
																Объем до: <?php echo $capacity ?> м&sup3;<br/>
															</a>
														</td>
														<td>
															<?php echo Yii::app()->dateFormatter->format('dd.MM.yyyy', ($oneGood->updated_at ? $oneGood->updated_at : $oneGood->created_at)); ?><br/>
															<?php echo Yii::app()->dateFormatter->format('HH:mm', ($oneGood->updated_at ? $oneGood->updated_at : $oneGood->created_at)); ?>
														</td>
													</tr>
												<?php endif; ?>
											<?php endforeach; ?>
										</tbody>
									</table>
								<?php else: ?>
									<div class="fluid" style="text-align: center;margin-top: 50px;">
										<label style="font-weight: bold; font-size: 16px;">
											Нет грузов.
										</label>
									</div>
								
								<?php endif; ?>
						
							</div>
							<?php endif; ?>
<!-- ********************************************* -->	
<!-- ============================================= -->	
							<?php  if ($printVehicles): ?>
							<div id="tab_vehicles" class="tab_content" style="display: none;"> 


								<?php if ($model->vehicles && count($model->vehicles) > 1): ?>
									<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tLight" style="text-align: center;">
										<thead>
											<tr>
												<td width="10%">Фото</td>
												<td width="25%">Название</td>
												<td width="40%">Расположение</td>
												<td width="25%">Характеристики</td>
											</tr>
										</thead>
										<tbody>
											<?php foreach($model->vehicles as $vehicle): ?>
												<?php if (!$vehicle->is_deleted && $vehicle->id != $model->id): ?>
													<tr>
														<td>
															<a href="/vehicle/view/<?php echo $vehicle->slug; ?>" class="tipS" title="Перейти на страницу транспортного средства" style="display: block;">
																<?php $image = isset($vehicle->photos[0])
																	? '/' . Yii::app()->params['files']['photos'] . '/' . $vehicle->photos[0]->size_middle
																	: '/images/nophoto.jpg' ?>
																<img src="<?php echo $image; ?>" alt="" />
															</a>
														</td>
														<td>
															<a href="/vehicle/view/<?php echo $vehicle->slug; ?>" class="tipS" title="Перейти на страницу транспортного средства">
																<?php echo ucfirst($vehicle->vehicleType->name_ru) . " " . $vehicle->marka->name . " " . $vehicle->modeli->name ?>
															</a><br/>
															<strong>Добавлен:</strong><br/>
															<span>
																<?php echo Yii::app()->dateFormatter->format('dd.MM.yyyy', $vehicle->updated_at); ?>&nbsp;
																<?php echo Yii::app()->dateFormatter->format('HH:mm', $vehicle->updated_at); ?>
															</span>
														</td>
														<td>
															<?php if ($vehicle->city_id): ?>
															<span>
																<?php echo $vehicle->countries->name_ru . ' - ' . (!empty($vehicle->countriesTo->name_ru) ? $vehicle->countriesTo->name_ru : 'Любая'); ?>
															</span>
															<span>
																<?php echo $vehicle->regions->name_ru . ' - ' . (!empty($vehicle->regionsTo->name_ru) ? $vehicle->regionsTo->name_ru : 'Любая'); ?>
															</span>
															<span>
																<?php echo $vehicle->cities->name_ru . ' - ' . (!empty($vehicle->citiesTo->name_ru) ? $vehicle->citiesTo->name_ru : 'Любой'); ?>
															</span>
															<span>
																<?php if ($vehicle->date_from && $vehicle->date_to): ?>
																	c <?php echo Yii::app()->dateFormatter->format('dd.MM.yyyy', $vehicle->date_from); ?> по <?php echo Yii::app()->dateFormatter->format('dd.MM.yyyy', $vehicle->date_to); ?>
																<?php endif; ?>
															</span>
															<?php endif; ?>
														</td>
														<td>
															<span><strong>Тип кузова: </strong>
																<?php echo $vehicle->bodyType->name_ru ?>
															</span>
															<span><strong>Вид загрузки: </strong>
																<?php echo $vehicle->shipmentsNames ?>
															</span>
															<span><strong>Объем кузова: </strong>
																<?php echo $vehicle->body_capacity ?> м&sup3;
															</span>
														</td>
													</tr>
												<?php endif; ?>
											<?php endforeach; ?>
										</tbody>
									</table>
								<?php else: ?>
										<div class="fluid" style="text-align: center;margin-top: 50px;">
											<label style="font-weight: bold; font-size: 16px;">
												Нет транспорта.
											</label>
										</div>
							
								<?php endif; ?>


							</div>		
							<?php endif; ?>
<!-- ============================================= -->								
						</div>	
						<div class="clear"></div>		 
					</div>	
					<div class="clear"></div>
				</div>

            </div>
        </div>
	</div>
</div>
<!-- Content ends -->
