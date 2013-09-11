<?php
/* @var $this MainController */
/* @var $model Users */
/* @var $form CActiveForm  */

$this->pageTitle = Yii::app()->name . ' - Главная';
$this->breadcrumbs = array(
	'Главная',
);
?>
<!--<div id="content" class="mainMaps">
	<div class="wrapper" style="text-align: center;">
		<img src="/images/maps.png" alt="frahts.com - Мир грузоперевозок!" />
	</div>
</div>-->

<div id="content">
	<div id="right-block">                    
		<div class="light-grey width400">
			<p class="center turquoise">Грузы ожидающие отправки:</p>
			<table class="turquoise" style="text-align: center;">
				<colgroup>
					<col width="115" />
					<col width="70" />
					<col width="70" />
					<col width="145" />
				</colgroup>
				<?php foreach ($this->mainGoods as $oneGood): ?>
				<tr>
					<td>
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
						<?php echo $weight ?> т.,
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
						<?php echo $capacity ?> м&sup3;
					</td>
					<td><?php echo $oneGood->cost . ' ' . $oneGood->currency->name_ru ?></td>
					<td nowrap="nowrap">
						<?php echo Yii::app()->dateFormatter->format('dd.MM', $oneGood->date_from); ?>
						- 
						<?php echo Yii::app()->dateFormatter->format('dd.MM', $oneGood->date_to); ?>
					</td>
					<td><?php echo $oneGood->cityFrom->name_ru . ' - ' .  $oneGood->cityTo->name_ru?></td>
				</tr>
				<?php endforeach; ?>
			</table>
		</div> 
		<div class="light-grey width400">
			<p class="center turquoise">Транспорт ожидающий загрузки:</p>
			<table class="turquoise" style="text-align: center;">
				<colgroup>
					<col width="115" />
					<col width="70" />
					<col width="70" />
					<col width="145" />
				</colgroup>
				<?php foreach ($this->mainVehicles as $vehicle): ?>
				<tr>
					<td><?php echo $vehicle->marka->name; ?><br/><?php echo $vehicle->bearing_capacity ?> т., <?php echo $vehicle->body_capacity ?> м&sup3;</td>
					<td><?php echo $vehicle->bodyType->name_ru ?></td>
					<td nowrap="nowrap">
						<?php echo Yii::app()->dateFormatter->format('dd.MM', $vehicle->date_from); ?> 
						- 
						<?php echo Yii::app()->dateFormatter->format('dd.MM', $vehicle->date_to); ?>
					</td>
					<td><?php echo $vehicle->cities->name_ru . ' - ' . (!empty($vehicle->citiesTo->name_ru) ? $vehicle->citiesTo->name_ru : 'Любой'); ?></td>
				</tr>
				<?php endforeach; ?>
			</table>
		</div>
		<div class="light-grey right">                        
			<p class="turquoise">Используя инструменты и сервисы Frahts.com Вы сможете получать оперативную и качественную информацию о состоянии рынка грузоперевозок, как Украины, так и мира.</p>                                                            
		</div>
	</div> 
</div>