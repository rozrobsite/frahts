<div class="secWrapper">
	<?php $this->renderPartial('/blocks/secTop') ?>
	<!-- Tabs container -->
	<div id="tab-container" class="">
		<ul class="iconsLine ic1">
			<li class=""><a href="/vehicle/active" class="subClosed">Мой транспорт</a></li>
		</ul>
		<div class="divider"><span></span></div>
		<div id="goodsSearch">
			<?php if (isset($vehicleActive) && count($vehicleActive)): ?>
                <div style="display: block; position: static; visibility: visible;" class="active">
                    <div class="widget">
                        <div class="whead">
                            <h6 style="font-size: 11px;">Подберите груз для Вашего транспорта одним нажатием на него</h6>
                            <div class="clear"></div>
                        </div>
                        <div class="filetree wait"></div>
                    </div>
                </div>
                <div class="divider"><span></span></div>
				<div class="sideUpload">
					<ul class="filesDown">
						<?php foreach ($vehicleActive as $vehicle): ?>
						<li <?php if (isset($vid) && $vid == $vehicle->id): ?> class="selected" <?php endif; ?>>
							<span class="fileQueue"></span>
							<a href="/vehicle/search?vid=<?php echo $vehicle->id ?>&fs=1" class="tipS" title="Нажмите на это транспортное средство чтобы найти подходящие для него грузы" style="margin-left: 5px;">
								<?php echo ucfirst($vehicle->vehicleType->name_ru) . " " . $vehicle->marka->name . (isset($vehicle->modeli->name) ? ' ' . $vehicle->modeli->name : '') ?>,
												номер: <?php echo $vehicle->license_plate ?>
							</a>
							<a href="/vehicle/update/<?php echo $vehicle->id ?>" class="edit tipS" style="width: 10px;height: 9px;" original-title="Редактировать" title="Редактировать"></a>
						</li>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php else: ?>
				<div style="text-align: center">
					<span class="label label-important">Вы не добавили транспорт</span><br/>
				</div>
				<div style="margin: 20px 5px 5px 5px;">
					<strong style="font-size: 14px;">Важно!</strong>
					<p>Особенностью системы Фрахты.com является вывод только актуальных заявок от перевозчиков и грузоотправителей.</p>
					<p>Владельцы грузов не всегда размещают свои грузы, а чаще самостоятельно просматривают базу транспорта и выбирают подходящий транспорт.</p>
					<p>Не добавив транспортное средство Вы лишаетесь шанса, что его увидят владельцы грузов.</p>
					<p style="font-weight: bold;">Обязательно добавте транспортное средство.</p>
				</div>
				<div style="text-align: center; margin-top: 20px;">
					<a class="buttonM bBlue" href="/vehicle/new"><span class="icol-add"></span><span>Добавить транспорт</span></a>
				</div>
				<div style="text-align: center; margin-top: 20px;">
					<a class="buttonM bBlue" href="/vehicle/active" style="width: 137px"><span>Мой транспорт</span></a>
				</div>
			<?php endif; ?>
		</div>

		<div class="divider"><span></span></div>

		<div class="clear"></div>
	</div>
</div>
<div class="clear"></div>