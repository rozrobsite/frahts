<table cellpadding="0" cellspacing="0" width="100%" class="tDefault tMedia">
	<thead>
		<tr>
			<td width="35%">От кого</td>
			<td width="25%">Цель</td>
			<td width="15%"><div>Дата</div></td>
			<td width="25%"><div>Действие</div></td>
		</tr>
	</thead>
	<tfoot>
		<tr>
		</tr>
	</tfoot>
	<tbody>
		<?php foreach($forUserOffers as $offer): ?>
			<tr>
				<td class="textL">
					<a href="/user/view/<?php echo $offer->receivingUser->id ?>" title="Перейти на страницу пользователя" class="tipS">
						<?php echo $offer->author->profiles->fullName(); ?>
					</a>
				</td>
				<td class="textL" style="text-align: center !important">
					<?php if ($offer->good_id): ?>
						<span class="label">Груз</span>
						<a href="/good/view/<?php echo $offer->good->slug; ?>" title="Перейти на страницу груза" class="tipS" style="margin-left: 5px;">
							"<?php echo $offer->good->name; ?>"
						</a>
					<?php else: ?>
						<span class="label label-inverse">Транспорт</span>
						<a href="/vehicle/view/<?php echo $offer->vehicle->slug; ?>" title="Перейти на страницу траспорта" class="tipS" style="margin-left: 5px;">
							"<?php echo $offer->vehicle->shortName(); ?>"
						</a>
					<?php endif; ?>
				</td>
				<td>
					<?php echo Yii::app()->dateFormatter->format('dd.MM.yyyy', $offer->created_at); ?><br/>
					<?php echo Yii::app()->dateFormatter->format('HH:mm', $offer->created_at); ?>
				</td>
				<td class="tableActs">
					<label class="refuseOffer_<?php echo $offer->id ?>" <?php if ($offer->result != Offers::RESULT_IN_REFUSE): ?>style="display: none;"<?php endif; ?>>
						Вы <span class="label label-important">отклонили</span> предложение пользователя<br/>
						<a href="javascript:void(0)" class="buttonS bRed">Отменить</a>
					</label>
					<label class="acceptOffer_<?php echo $offer->id ?>" <?php if ($offer->result != Offers::RESULT_IN_ACCEPT): ?>style="display: none;"<?php endif; ?>>
						Вы <span class="label label-success">приняли</span> предложение пользователя
					</label>
					<div class="noOffer_<?php echo $offer->id ?>" <?php if ($offer->result != Offers::RESULT_IN_PROCESS): ?>style="display: none;"<?php endif; ?>>
						<a href="javascript:void(0)" class="buttonS bGreen offerAccept" data-id="<?php echo $offer->id ?>">Принять</a>
						<a href="javascript:void(0)" class="buttonS bRed offerRefuse" data-id="<?php echo $offer->id ?>">Отклонить</a>
					</div>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>