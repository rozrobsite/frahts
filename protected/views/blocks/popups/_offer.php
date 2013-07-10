<div id="offer_dialog" title="Предложение" style="display: none">
	<form>
		<?php if ($modelType == Offers::TYPE_GOOD): ?>
			<p>Укажите сумму, за которую вы согласны перевезти груз пользователя</p>
		<?php else: ?>
			<p>Укажите сумму, за которую вы согласны перевезти свой груз транспортом пользователя</p>
		<?php endif; ?>
		<?php
		
		?>
		<input id="offerCost" type="text" name="offerCost" class="clear" placeholder="Введите сумму" style="width:200px;float:left;" />
		<div class="dialogSelect m10" style="margin-top: 0;margin-left: 10px;float:left;">
			<select id="offerCurrency" name="offerCurrency" >
				<?php foreach ($currencies as $currency): ?>
					<option value="<?php echo $currency->id; ?>"><?php echo $currency->name_ru; ?></option>
				<?php endforeach; ?>
			</select>
		</div>
	</form>
</div>