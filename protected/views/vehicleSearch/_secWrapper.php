<div class="secWrapper">

	<?php $this->renderPartial('/blocks/secTop') ?>

	<!-- Tabs container -->
	<div id="tab-container" class="tab-container">
		<ul class="iconsLine ic1 etabs">
			<li class="user_profile_tab"><a href="#goodsSearch" class="exp subClosed">Мой транспорт</a></li>
		</ul>

		<div class="divider"><span></span></div>

		<div id="goodsSearch">
			<?php if ($this->user->profiles): ?>
				<div class="sidePad">
					<a href="/vehicle/new" title="" class="sideB bGreen">Добавить транспорт</a>
				</div>
			<?php endif; ?>
			<?php if ($this->user->vehicles): ?>
				<div class="divider"><span></span></div>
				<div class="sidePad">
					<a href="/vehicle/search" title="Поиск всех доступных грузов" class="sideB bSea tipS">Показать все грузы</a>
				</div>
			<?php endif; ?>

			<div class="divider"><span></span></div>
			<?php if ($vehicleActive): ?>

			<div class="sideUpload">
				<ul class="filesDown">
					<?php foreach ($vehicleActive as $vehicle): ?>
					<li <?php if (isset($vid) && $vid == $vehicle->id): ?> class="selected" <?php endif; ?>>
						<span class="fileQueue"></span>
						<a href="/vehicle/search?vid=<?php echo $vehicle->id ?>&fs=1" class="tipS" title="Нажмите на это транспортное средство чтобы найти подходящие для него грузы">
							<?php echo ucfirst($vehicle->vehicleType->name_ru) . " " . $vehicle->marka->name . (isset($vehicle->modeli->name) ? ' ' . $vehicle->modeli->name : '') ?>,
											номер: <?php echo $vehicle->license_plate ?>
						</a>
						<a href="/vehicle/update/<?php echo $vehicle->id ?>" class="edit tipS" style="width: 10px;height: 9px;" original-title="Редактировать" title="Редактировать"></a>
					</li>
					<?php endforeach; ?>
				</ul>
			</div>

			<?php endif; ?>
		</div>
		<div class="clear"></div>
	</div>

</div>
<div class="clear"></div>