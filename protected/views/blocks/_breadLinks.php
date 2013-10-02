<div class="breadLinks">
	<ul>
		<?php if ($this->user->profiles->userType->id == UserTypes::SHIPPER || $this->user->profiles->userType->id == UserTypes::DISPATCHER): ?>
			<li><a href="/vehicle/new" title=""><i class="icos-truck"></i><span>Добавить транспорт</span></a></li>
		<?php endif; ?>
		<?php if ($this->user->profiles->userType->id == UserTypes::FREIGHTER || $this->user->profiles->userType->id == UserTypes::DISPATCHER): ?>
			<li><a href="/goods/new" title=""><i class="icos-dropbox"></i><span>Добавить груз</span></a></li>
		<?php endif; ?>
		<li class="has">
			<a title="">
				<i class="icos-admin"></i>
				<span>Личный кабинет</span>
				<span><img src="/images/elements/control/hasddArrow.png" alt="" /></span>
			</a>
			<ul style="width: 200px;">
				<li><a href="/user" title=""><span class="icos-admin2"></span>Личная информация</a></li>
				<li><a href="/user/organization" title=""><span class="icos-users"></span>Организация</a></li>
				<?php if (isset($this->user->profiles->user_type_id) && $this->user->profiles->user_type_id == UserTypes::DISPATCHER): ?>
					<li><a href="/vehicle/active" title=""><span class="icos-truck"></span>Мой транспорт</a></li>
					<li><a href="/goods/search" title=""><span class="icos-dropbox"></span>Мой груз</a></li>
				<?php elseif (isset($this->user->profiles->user_type_id) && $this->user->profiles->user_type_id == UserTypes::FREIGHTER): ?>
					<li><a href="/goods/search" title=""><span class="icos-dropbox"></span>Мой груз</a></li>
				<?php elseif (isset($this->user->profiles->user_type_id) && $this->user->profiles->user_type_id == UserTypes::SHIPPER): ?>
					<li><a href="/vehicle/active" title=""><span class="icos-truck"></span>Мой транспорт</a></li>
				<?php endif; ?>
				<li><a href="/partners" title=""><span class="icos-users2"></span>Мои партнеры</a></li>
				<li><a href="/partners/search" title=""><span class="icos-search"></span>Поиск пользователей</a></li>
				<li><a href="/user/reviews" title=""><span class="icos-notes"></span>Отзывы</a></li>
			</ul>
		</li>
	</ul>
	<div class="clear"></div>
</div>