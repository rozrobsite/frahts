<div id="offer_dialog" title="Предложение" style="display: none">
	<form>
		<?php if ($modelType == Offers::TYPE_GOOD): ?>
			<p>Укажите какое из своих транспортных средств Вы предлагаете:</p>
			<div class="dialogSelect m10" style="margin-top: 0;margin-left: 10px;">
				<select id="offerVehicle" name="offerVehicle" >
					<?php foreach ($this->user->vehicles as $vehicle): ?>
						<option value="<?php echo $vehicle->id; ?>"><?php echo $vehicle->shortName(); ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		<?php else: ?>
			<p>Укажите какой из своих грузов Вы предлагаете:</p>
			<div class="dialogSelect m10" style="margin-top: 0;margin-left: 10px;">
				<select id="offerGood" name="offerVehicle" >
					<?php foreach ($this->user->goods as $good): ?>
						<option value="<?php echo $good->id; ?>" data-cost="<?php echo $good->cost; ?>" data-currency="<?php echo $good->currency->id ?>"><?php echo $good->name; ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		<?php endif; ?>
		<?php if ($modelType == Offers::TYPE_GOOD): ?>
			<p>Укажите сумму, за которую вы согласны перевезти груз пользователя:</p>
		<?php else: ?>
			<p>Укажите сумму, за которую вы согласны перевезти свой груз транспортом пользователя:</p>
		<?php endif; ?>
		<?php
			$cost = '';
			$currencyId = 0;
			if ($modelType == Offers::TYPE_GOOD)
			{
				$cost = $model->cost;
				$currencyId = $model->currency->id;
			}
		?>
		<input id="offerCost" type="text" name="offerCost" class="clear" placeholder="Введите сумму" style="width:100px;float:left;" value="<?php echo $cost; ?>"/>
		<div class="dialogSelect m10" style="margin-top: 0;margin-left: 10px;float:left;">
			<select id="offerCurrency" name="offerCurrency" >
				<?php foreach ($currencies as $currency): ?>
					<option value="<?php echo $currency->id; ?>" <?php if ($currency->id == $currencyId): ?>selected="selected"<?php endif; ?>><?php echo $currency->name_ru; ?></option>
				<?php endforeach; ?>
			</select>
		</div>
	</form>
</div>