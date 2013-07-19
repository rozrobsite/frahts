<?php if (count($userOffers)): ?>
<table id="userOffersTable" cellpadding="0" cellspacing="0" width="100%" class="tDefault tMedia">
	<thead>
		<tr>
			<td width="15%">Кому предлагаете</td>
			<td width="20%">Что предлагаете</td>
			<td width="15%">Цель предложения</td>
			<td width="10%">Цена</td>
			<td width="10%"><div>Дата</div></td>
			<td width="20%"><div>Результат</div></td>
			<td width="10%"><div>Действие</div></td>
		</tr>
	</thead>
	<tfoot>
		<tr>
		</tr>
	</tfoot>
	<tbody>
		<?php foreach($userOffers as $offer): ?>
			<tr>
				<td class="textL" style="text-align: center !important;">
					<a href="/user/view/<?php echo $offer->receivingUser->id ?>" title="Перейти на страницу пользователя" class="tipS">
						<?php echo $offer->receivingUser->profiles->fullName(); ?>
					</a>
				</td>
				<td class="textL" style="text-align: center !important">
					<?php if ($offer->offer_good_id): ?>
						Свой <span class="label">груз</span>
						<a href="/goods/view/<?php echo $offer->offerGood->slug; ?>" title="Перейти на страницу груза" class="tipS" style="margin-left: 5px;">
							"<?php echo $offer->offerGood->name; ?>"
						</a>
					<?php else: ?>
						Свой <span class="label label-inverse">транспорт</span>
						<a href="/vehicle/view/<?php echo $offer->offerVehicle->slug; ?>" title="Перейти на страницу траспорта" class="tipS" style="margin-left: 5px;">
							"<?php echo $offer->offerVehicle->shortName(); ?>"
						</a>
					<?php endif; ?>
				</td>
				<td class="textL" style="text-align: center !important;">
					<?php if ($offer->good_id): ?>
						<span class="label">Груз</span>
						<a href="/goods/view/<?php echo $offer->good->slug; ?>" title="Перейти на страницу груза" class="tipS" style="margin-left: 5px;">
							"<?php echo $offer->good->name; ?>"
						</a>
					<?php else: ?>
						<span class="label label-inverse">Транспорт</span>
						<a href="/vehicle/view/<?php echo $offer->vehicle->slug; ?>" title="Перейти на страницу траспорта" class="tipS" style="margin-left: 5px;">
							"<?php echo $offer->vehicle->shortName(); ?>"
						</a>
					<?php endif; ?>
				</td>
				<td class="textL" style="text-align: center !important;">
					<span><?php echo $offer->getCost(); ?></span>
				</td>
				<td>
					<?php echo Yii::app()->dateFormatter->format('dd.MM.yyyy', $offer->created_at); ?><br/>
					<?php echo Yii::app()->dateFormatter->format('HH:mm', $offer->created_at); ?>
				</td>
				<td class="tableActs">
					<?php if ($offer->result == Offers::RESULT_IN_REFUSE): ?>
						Пользователь <span class="label label-important">отклонил</span> Ваше предложение
					<?php elseif ($offer->result == Offers::RESULT_IN_ACCEPT): ?>
						Пользователь <span class="label label-success">принял</span> Ваше предложение<br/>
						<a href="/user/view/<?php echo $offer->receivingUser->id; ?>#tab_comments">Оставить отзыв</a>
					<?php else: ?>
						От пользователя еще <span class="label label-info">нет ответа</span>
					<?php endif; ?>
				</td>
				<td>
					<div class="row_<?php echo $offer->id; ?>">
						<a href="javascript:void(0)" class="buttonS bRed cancelUsersOffer" data-id="<?php echo $offer->id; ?>">Отменить</a>
					</div>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<?php else: ?>
	<strong>Вы еще не делали предложения пользователям.</strong>
<?php endif; ?>
