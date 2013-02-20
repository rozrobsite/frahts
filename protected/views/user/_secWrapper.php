<div class="secWrapper">
	
	<?php $this->renderPartial('/blocks/secTop') ?>

	<!-- Tabs container -->
	<div id="tab-container" class="tab-container">
		<ul class="iconsLine ic1 etabs">
			<li><a href="#user_profile" title="Настройки пользователя" class="exp subClosed">Настройки пользователя</a></li>
		</ul>

		<div class="divider"><span></span></div>

		<div id="user_profile">
			<ul class="subNav">
				<li><a href="/user/" title="" <?php if (isset($selectProfile)): ?>class="this"<?php endif; ?>><span class="icos-admin2"></span>Личные настройки</a></li>
				<li><a href="/user/organization" title="" <?php if (isset($selectOrganization)): ?>class="this"<?php endif; ?>><span class="icos-users"></span>Организация</a></li>
				<?php if (isset($this->user->profiles->user_type_id) && $this->user->profiles->user_type_id == 3): ?>
					<li><a href="/vehicle/active" title=""><span class="icos-truck"></span>Транспорт</a></li>
					<li><a href="/goodsSearch" title=""><span class="icos-trolly"></span>Груз</a></li>
				<?php elseif(isset($this->user->profiles->user_type_id) && $this->user->profiles->user_type_id == 2): ?>
					<li><a href="/goodsSearch" title=""><span class="icos-trolly"></span>Груз</a></li>
				<?php elseif(isset($this->user->profiles->user_type_id) && $this->user->profiles->user_type_id == 1): ?>
					<li><a href="/vehicle/active" title=""><span class="icos-truck"></span>Транспорт</a></li>
				<?php endif; ?>
			</ul>
		</div>

	</div>

</div>
<div class="clear"></div>