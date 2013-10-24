<div class="wrapper">
	<?php $this->renderPartial('/blocks/_notify') ?>
	<?php $this->renderPartial('/blocks/_middleNavR') ?>
	<div class="widget">
		<div class="invoice">

			<div class="inHead mytasks">
				<div class="btn-group" style="display: inline-block; margin-bottom: -4px;padding: 14px;">
					<a class="buttonM bBlue" data-toggle="dropdown" href="#"><span class="icon-cog"></span><span>Действие</span><span class="caret"></span></a>
					<ul class="dropdown-menu" style="left: 13px; top: 76%;">
						<li><a href="/user/messages/user/<?php echo $model->id ?>#users_message"><span class="icos-speech"></span>Написать сообщение</a></li>
						<?php if (!$this->user->isPartner($model)): ?>
							<li><a href="javascript:void(0);" class="add-partner" data-id="<?php echo $model->id; ?>"><span class="icos-users2"></span>Добавить в партнеры</a></li>
						<?php else: ?>
							<li><a href="javascript:void(0);" class="remove-partner" data-id="<?php echo $model->id; ?>"><span class="icos-users2"></span>Удалить из партнеров</a></li>
						<?php endif; ?>
					</ul>
				</div>
				<div class="inInfo">
					<span class="invoiceNum">Данные о пользователе</span>
					<i>На сайте с: <?php echo Yii::app()->dateFormatter->format('dd.MM.yyyy HH:mm', $model->profiles->created_at); ?></i>
				</div>
				<div class="clear"></div>
			</div>

			<div class="inContainer">
				<div class="inFrom" >
					<h5 class="partnerTitle"><?php echo $model->profiles->last_name . ' ' . $model->profiles->first_name . ' ' . $model->profiles->middle_name; ?>
					<?php if ($this->user->isPartner($model)): ?>
						<label style="margin-left: 10px;background: #468847; color: #fff;padding: 0 6px; font-size: 12px;">Ваш партнер</label>
					<?php endif; ?>
					</h5>

					<span><strong><?php echo $model->profiles->userType->name_ru; ?></strong></span>

						<!--<span class="number">Рейтинг: <?php // echo $model->profiles->rating;  ?></span>-->
					<strong class="title">Расположение</strong>
					<span><?php echo $model->profiles->country->name_ru . ", " . $model->profiles->region->name_ru . ", " . $model->profiles->city->name_ru; ?></span>
					<span><?php echo $model->profiles->address; ?></span>
					<strong class="title">Контакты</strong>
					<span class="number"><strong>Мобильный телефон:</strong> <strong class="red"><?php echo $model->profiles->mobile ?></strong></span>
					<?php if ($model->profiles->phone): ?>
						<span><strong>Телефон/Факс:</strong> <?php echo $model->profiles->skype; ?></span>
					<?php endif; ?>
					<?php if ($model->profiles->skype): ?>
						<span><strong>Skype:</strong> <?php echo $model->profiles->skype; ?></span>
					<?php endif; ?>
					<?php if ($model->profiles->icq): ?>
						<span><strong>ICQ:</strong> <?php echo $model->profiles->icq; ?></span>
					<?php endif; ?>
					<br />
					<?php if ($model->organizations): ?>
						<h5><?php echo $model->organizations->name_org; ?></h5>
						<span><?php echo $model->organizations->typeOrg->name_ru; ?></span>
						<span><strong>Форма:</strong> <?php echo $model->organizations->formOrganizations->name_ru; ?></span>
						<?php if ($model->organizations->form_tax): ?>
							<span><strong>Форма налогообложения:</strong> <?php echo $model->organizations->form_tax; ?></span>
						<?php endif; ?>
						<?php if ($model->organizations->license): ?>
							<span><strong>Лицензия:</strong> <?php echo $model->organizations->license; ?></span>
						<?php endif; ?>
						<?php if ($model->organizations->certificate): ?>
							<span><strong>Сертификат:</strong> <?php echo $model->organizations->certificate; ?></span>
						<?php endif; ?>

						<strong class="title">Реквизиты</strong>
						<?php if ($model->organizations->inn): ?>
							<span><strong>ИНН:</strong> <?php echo $model->organizations->inn; ?></span>
						<?php endif; ?>
						<?php if ($model->organizations->edrpou): ?>
							<span><strong>ЕДРПОУ:</strong> <?php echo $model->organizations->edrpou; ?></span>
						<?php endif; ?>
						<?php if ($model->organizations->account_number): ?>
							<span><strong>Расчетный счет:</strong> <?php echo $model->organizations->account_number; ?></span>
						<?php endif; ?>
						<?php if ($model->organizations->bank): ?>
							<span><strong>Банк:</strong> <?php echo $model->organizations->bank; ?></span>
						<?php endif; ?>
						<?php if ($model->organizations->mfo): ?>
							<span><strong>МФО:</strong> <?php echo $model->organizations->mfo; ?></span>
						<?php endif; ?>

						<strong class="title">Контакты</strong>
						<?php if ($model->organizations->mfo): ?>
							<span><?php echo $model->organizations->address . ", " . $model->organizations->address; ?></span>
						<?php endif; ?>
						<?php if ($model->organizations->phone): ?>
							<span class="number"><strong>Телефон:</strong> <strong class="red"><?php echo $model->organizations->phone ?></strong></span>
						<?php endif; ?>
					<?php else: ?>
						<strong class="title">Пользователь не предоставил данных о своей организации.</strong>
					<?php endif; ?>

				</div>
				<div class="floatR" style="width:50%;height:430px; margin:10px; border:1px solid;">
					<div id="map" style="width:100%;height:430px;"></div>
				</div>

				<div class="clear"></div>
			</div>

			<div class="inContainer">
				<div class="widget grid6">
					<ul class="tabs">
						<?php
						switch ($model->profiles->userType->id) {
							case UserTypes::FREIGHTER:
								$printVehicles = true;
								$printGoods = false;
								break;
							case UserTypes::SHIPPER:
								$printVehicles = false;
								$printGoods = true;
								break;
							default:
								$printVehicles = true;
								$printGoods = true;
						}
						?>
						<li class="activeTab" style=""><a href="#tab_comments">Отзывы</a></li>
						<?php if ($printGoods): ?> <li class=""><a href="#tab_goods">Грузы</a></li> <?php endif; ?>
						<?php if ($printVehicles): ?> <li class=""><a href="#tab_vehicles">Транспорт</a></li> <?php endif; ?>
					</ul>
					<?php $this->renderPartial('/user/_reviewsList', array('model' => $model, 'canWrite' => $canWrite, 'offer' => $offer, 'offer_id' => $offer_id)); ?>
					<?php $this->renderPartial('/user/_userGoodsList', array('printGoods' => $printGoods, 'model' => $model)); ?>
					<?php $this->renderPartial('/user/_userVehiclesList', array('printVehicles' => $printVehicles, 'model' => $model)); ?>
				</div>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
</div>