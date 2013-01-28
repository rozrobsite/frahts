<div class="secWrapper">
	<div class="secTop">
		<div class="balance">
			<div class="balInfo">Баланс:<span><?php echo Yii::app()->dateFormatter->format('dd.MMM.yyyy', time()); ?></span></div>
			<div class="balAmount">
				<span class="balBars"><!--5,10,15,20,18,16,14,20,15,16,12,10--></span>
				<span class="tipN" original-title="Специальная единица сайта"><?php echo $this->user->balance ?> фрахтов</span>
			</div>
		</div>
	</div>

	<!-- Tabs container -->
	<div id="tab-container" class="tab-container">
		<ul class="iconsLine ic3 etabs">
			<li><a href="#vehicle" title="Личный транспорта" class="tipN" original-title="Личный транспорт"><span class="icos-truckGreen"></span></a></li>
			<li><a href="#vehicle_disabled" title="Личный транспорт не учавствующий в поиске" class="tipN" original-title="Личный транспорт не учавствующий в поиске"><span class="icos-truckRed"></span></a></li>
			<li><a href="#user_profile" title="Настройки пользователя" class="tipN" original-title="Настройки пользователя"><span class="icos-user"></span></a></li>
		</ul>

		<div class="divider"><span></span></div>

		<div id="user_profile">
			<ul class="subNav">
				<li><a href="/user/" title=""><span class="icos-admin2"></span>Личные настройки</a></li>
				<li><a href="/user/organization" title=""><span class="icos-users"></span>Организация</a></li>
				<li><a href="/vehicle/new" title="" class="this"><span class="icos-truck"></span>Транспорт</a></li>
			</ul>
		</div>
		
		<div id="vehicle">
			<div class="sidePad">
				<a href="/vehicle/new" title="" class="sideB bGreen">Добавить</a>
			</div>

			<div class="divider"><span></span></div>
			<ul class="userList">
				<?php if (!$activeVehicles): ?>
					<li style="padding-left: 5px; font-weight: bold; text-align: center;">
						<label>У Вас еще нет добавленных транспортных средств</label>
					</li>
				<?php else: ?>
					<?php foreach ($activeVehicles as $vehicle): ?>
						<li <?php if ($model->id == $vehicle->id): ?>class="this" <?php endif; ?>>
							<a href="/vehicle/update/<?php echo $vehicle->id ?>" title="">
                                <!--<img src="/images/live/face2.png" alt="" />-->
                                <span class="contactName">
                                    <strong><?php echo $vehicle->bodyType->name_ru . " " . $vehicle->make->name . " " . $vehicle->model->name ?></strong>
                                    <i><?php echo $vehicle->vehicleType->name_ru ?></i>
                                </span>
                                <span class="status_<?php echo $model->id == $vehicle->id ? 'away' : 'available' ?>"></span>
                                <span class="clear"></span>
                            </a>
							<a class="vehicleDelete" rel="<?php echo $vehicle->id ?>" style="padding:0;text-align: center;font-size: 11px;margin-top: -5px;color:#fff;background: #c57979;line-height: 16px;">Удалить из поиска</a>
						</li>
					<?php endforeach; ?>
				<?php endif; ?>
			</ul>
		</div>
		
		<div id="vehicle_disabled">
			<ul class="userList">
				<?php if (!$noactiveVehicles): ?>
					<li style="padding-left: 5px; font-weight: bold; text-align: center;">
						<label>У Вас нет транспортных средств не учавствующих в поиске</label>
					</li>
				<?php else: ?>
					<?php foreach ($noactiveVehicles as $vehicle): ?>
						<li <?php if ($model->id == $vehicle->id): ?>class="this" <?php endif; ?>>
							<a href="/vehicle/update/<?php echo $vehicle->id ?>#vehicle_disabled" title="">
                                <!--<img src="/images/live/face2.png" alt="" />-->
                                <span class="contactName">
                                    <strong><?php echo $vehicle->bodyType->name_ru . " " . $vehicle->make->name . " " . $vehicle->model->name ?></strong>
                                    <i><?php echo $vehicle->vehicleType->name_ru ?></i>
                                </span>
                                <span class="status_<?php echo $model->id == $vehicle->id ? 'away' : 'off' ?>"></span>
                                <span class="clear"></span>
                            </a>
							<a class="vehicleReturn" rel="<?php echo $vehicle->id ?>" style="padding:0;text-align: center;font-size: 11px;margin-top: -5px;color:#fff;background: #68a341;line-height: 16px;">Вернуть в поиск</a>
						</li>
					<?php endforeach; ?>
				<?php endif; ?>
			</ul>
		</div>
	</div>

</div>
<div class="clear"></div>