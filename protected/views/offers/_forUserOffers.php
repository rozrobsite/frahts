<?php if (count($forUserOffers)): ?>
<table id="forUserOffersTable" cellpadding="0" cellspacing="0" width="100%" class="tDefault tMedia">
	<thead>
		<tr>
			<td width="20%">Кто предлагает</td>
			<td width="20%">Что предлагает</td>
			<td width="20%">Цель предложения</td>
			<td width="10%">Цена</td>
			<td width="10%"><div>Дата</div></td>
			<td width="20%"><div>Действие</div></td>
		</tr>
	</thead>
	<tfoot>
		<tr>
		</tr>
	</tfoot>
	<tbody>
		<?php foreach($forUserOffers as $offer): ?>
			<tr>
				<td class="textL" style="text-align: center !important">
					<a href="/user/view/<?php echo $offer->author->id ?>" title="Перейти на страницу пользователя" class="tipS">
						<?php echo $offer->author->profiles->fullName(); ?>
					</a>
				</td>
				<td class="textL" style="text-align: center !important">
					<?php if ($offer->offer_good_id): ?>
						<span class="label">Груз</span>
						<a href="/goods/view/<?php echo $offer->offerGood->slug; ?>" title="Перейти на страницу груза" class="tipS" style="margin-left: 5px;">
							"<?php echo $offer->offerGood->name; ?>"
						</a>
					<?php else: ?>
						<span class="label label-inverse">Транспорт</span>
						<a href="/vehicle/view/<?php echo $offer->offerVehicle->slug; ?>" title="Перейти на страницу траспорта" class="tipS" style="margin-left: 5px;">
							"<?php echo $offer->offerVehicle->shortName(); ?>"
						</a>
					<?php endif; ?>
				</td>
				<td class="textL" style="text-align: center !important">
					<?php if ($offer->good_id): ?>
						Ваш <span class="label">груз</span>
						<a href="/goods/view/<?php echo $offer->good->slug; ?>" title="Перейти на страницу груза" class="tipS" style="margin-left: 5px;">
							"<?php echo $offer->good->name; ?>"
						</a>
					<?php else: ?>
						Ваш <span class="label label-inverse">транспорт</span>
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
					<div class="row_<?php echo $offer->id; ?>">
						<label class="refuseOffer_<?php echo $offer->id; ?>" <?php if ($offer->result != Offers::RESULT_IN_REFUSE): ?>style="display: none;"<?php endif; ?>>
							Вы <span class="label label-important">отклонили</span> предложение пользователя<br/>
							<a class="cancelForUsersOffer" href="javascript:void(0)" style="color: #a34c4c;" data-id="<?php echo $offer->id; ?>">Отменить</a>
						</label>
						<label class="acceptOffer_<?php echo $offer->id ?>" <?php if ($offer->result != Offers::RESULT_IN_ACCEPT): ?>style="display: none;"<?php endif; ?>>
							Вы <span class="label label-success">приняли</span> предложение пользователя<br/>
							<?php if (!$offer->review_id): ?>
								<a href="/user/view/<?php echo $offer->author->id; ?>/offer/<?php echo $offer->id ?>#tab_comments">Оставить отзыв</a>
								<a class="cancelForUsersOffer" href="javascript:void(0)" style="color: #a34c4c;margin-left: 10px;" data-id="<?php echo $offer->id; ?>">Отменить</a>
							<?php endif; ?>
						</label>
						<div class="noOffer_<?php echo $offer->id ?>" <?php if ($offer->result != Offers::RESULT_IN_PROCESS): ?>style="display: none;"<?php endif; ?>>
							<a href="javascript:void(0)" class="buttonS bGreen offerAccept" data-id="<?php echo $offer->id ?>">Принять</a>
							<a href="javascript:void(0)" class="buttonS bRed offerRefuse" data-id="<?php echo $offer->id ?>">Отклонить</a>
						</div>
					</div>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<?php else: ?>
	<strong>Вам еще не делали предложения пользователи.</strong>
<?php endif; ?>