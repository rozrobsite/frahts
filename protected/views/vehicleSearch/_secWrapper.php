<div class="secWrapper">
	
	<?php $this->renderPartial('/blocks/secTop') ?>

	<!-- Tabs container -->
	<div id="tab-container" class="tab-container">
		<ul class="iconsLine ic2 etabs">
			<li><a href="#vehicle" title="Мой транспорт" class="tipN" original-title="Мой транспорт"><span class="icos-truck"></span></a></li>
			<!--<li><a href="#vehicle_disabled" title="Личный транспорт не учавствующий в поиске" class="tipN" original-title="Личный транспорт не учавствующий в поиске"><span class="icos-truckRed"></span></a></li>-->
			<li><a href="#user_profile" title="Настройки пользователя" class="tipN" original-title="Настройки пользователя"><span class="icos-user"></span></a></li>
			<!--<li><a href="#soon"></a></li>-->
		</ul>

		<div class="divider"><span></span></div>

		<div id="user_profile">
			<ul class="subNav">
				<li><a href="/user/" title=""><span class="icos-admin2"></span>Личные настройки</a></li>
				<li><a href="/user/organization" title=""><span class="icos-users"></span>Организация</a></li>
				<li><a href="/vehicle/active" title="" class="this"><span class="icos-truck"></span>Транспорт</a></li>
			</ul>
		</div>
		
		<div id="vehicle">
			<div class="sidePad">
				<a href="/vehicle/new" title="" class="sideB bGreen">Добавить</a>
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