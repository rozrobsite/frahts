<table cellpadding="0" cellspacing="0" width="100%" class="tDefault tMedia">
	<thead>
		<tr>
			<td width="50%">Предложение</td>
			<td width="15%"><div>Дата</div></td>
			<td width="25%"><div>Результат</div></td>
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
				<td class="textL">
					Вы предложили пользователю 
					<a href="/user/view/<?php echo $offer->receivingUser->id ?>" title="Перейти на страницу пользователя" class="tipS">
						<?php echo $offer->receivingUser->profiles->fullName(); ?>
					</a> 
					<?php if ($offer->good_id): ?>
						свой <span class="label label-info">транспорт</span> для груза 
						<a href="/good/view/<?php echo $offer->good->slug; ?>" title="Перейти на страницу груза" class="tipS">
							"<?php echo $offer->good->name; ?>"
						</a> 
					<?php else: ?>
						свой <span class="label">груз</span> для транспорта 
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
					<?php if ($offer->result == Offers::RESULT_IN_REFUSE): ?>
						Пользователь <span class="label label-important">отклонил</span> Ваше предложение
					<?php elseif ($offer->result == Offers::RESULT_IN_ACCEPT): ?>
						Пользователь <span class="label label-success">принял</span> Ваше предложение
					<?php else: ?>
						От пользователя еще <span class="label label-inverse">нет ответа</span>
					<?php endif; ?>
<!--					<a href="javascript:void(0)" class="buttonS bGreen">Принять</a>
					<a href="javascript:void(0)" class="buttonS bRed">Отклонить</a>-->
				</td>
				<td>
					<a href="javascript:void(0)" class="buttonS bRed">Отменить</a>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>