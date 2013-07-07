<table cellpadding="0" cellspacing="0" width="100%" class="tDefault tMedia">
	<thead>
		<tr>
			<td width="60%">Предложение</td>
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
					Пользователь 
					<a href="/user/view/<?php echo $offer->receivingUser->id ?>" title="Перейти на страницу пользователя" class="tipS">
						<?php echo $offer->author->profiles->fullName(); ?>
					</a> 
					предлагает 
					<?php if ($offer->good_id): ?>
						свой <span class="label label-info">транспорт</span> для Вашего груза 
						<a href="/good/view/<?php echo $offer->good->slug; ?>" title="Перейти на страницу груза" class="tipS">
							"<?php echo $offer->good->name; ?>"
						</a> 
					<?php else: ?>
						свой <span class="label">груз</span> для Вашего транспорта 
						<a href="/vehicle/view/<?php echo $offer->vehicle->slug; ?>" title="Перейти на страницу траспорта" class="tipS">
							"<?php echo $offer->vehicle->shortName(); ?>"
						</a> 
					<?php endif; ?>
				</td>
				<td>
					<?php echo Yii::app()->dateFormatter->format('dd.MM.yyyy', $offer->created_at); ?><br/>
					<?php echo Yii::app()->dateFormatter->format('HH:mm', $offer->created_at); ?>
				</td>
				<td class="tableActs">
					<label id="refuseOffer" <?php if ($offer->result != Offers::RESULT_IN_REFUSE): ?>style="display: none;"<?php endif; ?>>
						Вы <span class="label label-important">отклонили</span> предложение пользователя
					</label>
					<label id="acceptOffer" <?php if ($offer->result != Offers::RESULT_IN_ACCEPT): ?>style="display: none;"<?php endif; ?>>
						Вы <span class="label label-success">приняли</span> предложение пользователя
					</label>
					<div id="noOffer" <?php if ($offer->result != Offers::RESULT_IN_PROCESS): ?>style="display: none;"<?php endif; ?>>
						<a href="javascript:void(0)" class="buttonS bGreen">Принять</a>
						<a href="javascript:void(0)" class="buttonS bRed">Отклонить</a>
					</div>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>