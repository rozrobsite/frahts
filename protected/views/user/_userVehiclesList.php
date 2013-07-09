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
								</span><br />
								<span>
									<?php echo $vehicle->regions->name_ru . ' - ' . (!empty($vehicle->regionsTo->name_ru) ? $vehicle->regionsTo->name_ru : 'Любая'); ?>
								</span><br />
								<span>
									<?php echo $vehicle->cities->name_ru . ' - ' . (!empty($vehicle->citiesTo->name_ru) ? $vehicle->citiesTo->name_ru : 'Любой'); ?>
								</span><br />
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
								</span><br />
								<span><strong>Вид загрузки: </strong>
									<?php echo $vehicle->shipmentsNames ?>
								</span><br />
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