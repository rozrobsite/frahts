<div class="secWrapper">
	
	<?php $this->renderPartial('/blocks/secTop') ?>

	<!-- Tabs container -->
	<div id="tab-container" class="tab-container">
		<ul class="iconsLine ic1 etabs">
			<li class="user_profile_tab"><a href="#goodsSearch" class="exp subClosed">Мой транспорт</a></li>
		</ul>

		<div class="divider"><span></span></div>

		<div id="goodsSearch">
			<div class="sidePad">
				<a href="/vehicle/new" title="" class="sideB bGreen">Добавить транспорт</a>
			</div>
			<?php if ($goods): ?>
				<div class="divider"><span></span></div>
				<div class="sidePad">
					<a href="#" title="Поиск всех доступных грузов" class="sideB bSea tipS">Все грузы</a>
				</div>
			<?php endif; ?>

			<div class="divider"><span></span></div>
			<?php if ($vehicleActive): ?>
			
			<div class="sideUpload">
				<ul class="filesDown">
					<?php foreach ($vehicleActive as $vehicle): ?>
					<li>
						<span class="fileQueue"></span>
						<a href="#" class="tipS" title="Нажмите на это транспортное средство чтобы найти подходящие для него грузы">
							<?php echo ucfirst($vehicle->bodyType->name_ru) . " " . $vehicle->make->name . " " . $vehicle->model->name ?>, 
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