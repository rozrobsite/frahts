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
					<?php if (!$oneGood->is_deleted && $oneGood->date_to >= time()): ?>
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