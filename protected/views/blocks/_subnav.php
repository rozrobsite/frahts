<ul class="subNav">
	<li><a href="/user/" title="" <?php if (isset($selectProfile) && $selectProfile): ?>class="this"<?php endif; ?>><span class="icos-admin2"></span>Личный кабинет</a></li>
	<li><a href="/user/organization" title="" <?php if (isset($selectOrganization) && $selectOrganization): ?>class="this"<?php endif; ?>><span class="icos-users"></span>Организация</a></li>
    <?php if (isset($this->user->profiles->user_type_id) && $this->user->profiles->user_type_id): ?>
        <li><a href="/vehicle/active" title=""><span class="icos-truck"></span>Мой транспорт</a></li>
        <li><a href="/goods/active" title=""><span class="icos-dropbox"></span>Мои грузы</a></li>
    <?php endif; ?>
	<?php /*if (isset($this->user->profiles->user_type_id) && $this->user->profiles->user_type_id == UserTypes::DISPATCHER): ?>
		<li><a href="/vehicle/active" title=""><span class="icos-truck"></span>Мой транспорт</a></li>
		<li><a href="/goods/active" title=""><span class="icos-dropbox"></span>Мои грузы</a></li>
	<?php elseif (isset($this->user->profiles->user_type_id) && $this->user->profiles->user_type_id == UserTypes::FREIGHTER): ?>
		<li><a href="/goods/active" title=""><span class="icos-dropbox"></span>Мои грузы</a></li>
	<?php elseif (isset($this->user->profiles->user_type_id) && $this->user->profiles->user_type_id == UserTypes::SHIPPER): ?>
		<li><a href="/vehicle/active" title=""><span class="icos-truck"></span>Мой транспорт</a></li>
	<?php endif; */?>
	<li><a href="/partners/search" title="" <?php if (isset($selectSearchUsers) && $selectSearchUsers): ?>class="this"<?php endif; ?>><span class="icos-search"></span>Поиск пользователей</a></li>
	<li><a href="/user/reviews" title="" <?php if (isset($selectReviews) && $selectReviews): ?>class="this"<?php endif; ?>><span class="icos-notes"></span>Отзывы</a></li>
</ul>