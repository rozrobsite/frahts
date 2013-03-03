<div class="secWrapper">
	
	<?php $this->renderPartial('/blocks/secTop') ?>

	<!-- Tabs container -->
	<div id="tab-container" class="tab-container">
		<ul class="iconsLine ic1 etabs">
			<li class="user_profile_tab"><a href="#user_profile" title="Настройки пользователя" class="exp subClosed">Настройки пользователя</a></li>
		</ul>

		<div class="divider"><span></span></div>

		<div id="user_profile">
			<ul class="subNav">
				<li><a href="/user/" title="" <?php if (isset($selectProfile)): ?>class="this"<?php endif; ?>><span class="icos-admin2"></span>Личные настройки</a></li>
				<li><a href="/user/organization" title="" <?php if (isset($selectOrganization)): ?>class="this"<?php endif; ?>><span class="icos-users"></span>Организация</a></li>
				<?php if (isset($this->user->profiles->user_type_id) && $this->user->profiles->user_type_id == 3): ?>
					<li><a href="/vehicle/active" title=""><span class="icos-truck"></span>Транспорт</a></li>
					<li><a href="/goods/search" title=""><span class="icos-dropbox"></span>Груз</a></li>
				<?php elseif(isset($this->user->profiles->user_type_id) && $this->user->profiles->user_type_id == 2): ?>
					<li><a href="/goods/search" title=""><span class="icos-dropbox"></span>Груз</a></li>
				<?php elseif(isset($this->user->profiles->user_type_id) && $this->user->profiles->user_type_id == 1): ?>
					<li><a href="/vehicle/active" title=""><span class="icos-truck"></span>Транспорт</a></li>
				<?php endif; ?>
			</ul>
		</div>
		
		<div class="divider"><span></span></div>
		
		<div class="sidePad">
			<?php if (isset($this->user->profiles->user_type_id) && $this->user->profiles->user_type_id == 3): ?>
				<a href="/vehicle/search" title="Поиск всех доступных грузов" class="sideB bSea tipS">Поиск грузов</a>
				<a href="/goods/search" title="Поиск всех доступных транспортных средств" class="sideB bSea tipS mt15">Поиск транспорта</a>
			<?php elseif(isset($this->user->profiles->user_type_id) && $this->user->profiles->user_type_id == 2): ?>
				<a href="/goods/search" title="Поиск всех доступных транспортных средств" class="sideB bSea tipS">Поиск транспорта</a>
			<?php elseif(isset($this->user->profiles->user_type_id) && $this->user->profiles->user_type_id == 1): ?>
				<a href="/vehicle/search" title="Поиск всех доступных грузов" class="sideB bSea tipS">Поиск грузов</a>
			<?php endif; ?>
		</div>

	</div>

</div>
<div class="clear"></div>