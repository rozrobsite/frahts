<div class="secWrapper">
	
	<?php $this->renderPartial('/blocks/secTop') ?>

	<!-- Tabs container -->
	<div id="tab-container" class="tab-container">
		<ul class="iconsLine ic1 etabs">
			<li class="user_profile_tab"><a href="#vehicle" class="exp subClosed">Мой транспорт</a></li>
			<!--<li><a href="#vehicle_disabled" title="Личный транспорт не учавствующий в поиске" class="tipN" original-title="Личный транспорт не учавствующий в поиске"><span class="icos-truckRed"></span></a></li>-->
			<!--<li><a href="#user_profile" title="Настройки пользователя" class="tipN" original-title="Настройки пользователя"><span class="icos-user"></span></a></li>-->
		</ul>

		<div class="divider"><span></span></div>

<!--		<div id="user_profile">
			<ul class="subNav">
				<li><a href="/user/" title=""><span class="icos-admin2"></span>Личные настройки</a></li>
				<li><a href="/user/organization" title=""><span class="icos-users"></span>Организация</a></li>
				<li><a href="/vehicle/active" title="" class="this"><span class="icos-truck"></span>Мой транспорт</a></li>
				<li><a href="/vehicleSearch" title=""><span class="icos-dropbox"></span>Поиск грузов</a></li>
			</ul>
		</div>-->
		
		<div id="vehicle">
			<div class="sidePad">
				<a href="/vehicle/new" title="" class="sideB bGreen">Добавить</a>
				<a href="/vehicle/search" title="" class="sideB bSea mt10">Поиск грузов</a>
			</div>

			<div class="divider"><span></span></div>
			<ul class="userList">
				<li <?php if ($is_active == 1): ?>class="this"<?php endif; ?>>
					<a href="/vehicle/active" title="" class="this">
						<span class="icos-truck-black-gold"></span>
						Учавствующие в поиске
					</a>
				</li>
				<li <?php if ($is_active == 2): ?>class="this"<?php endif; ?>>
					<a href="/vehicle/inactive" title="" class="this">
						<span class="icos-truckRed"></span>
						Удаленные из поиска
					</a>
				</li>
			</ul>
		</div>
		
	</div>

</div>
<div class="clear"></div>