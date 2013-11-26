<div id="settings">
	<ul class="subNav">
		<li><a href="/joker/user" title="" <?php if (isset($profiles) && $profiles): ?> class="this" <?php endif; ?>><span class="icos-admin"></span>Профиль</a></li>
		<li><a href="/joker/user/organization" title="" <?php if (isset($organization) && $organization): ?> class="this" <?php endif; ?>><span class="icos-users"></span>Организация</a></li>
		<li><a href="/joker//user/employee" title="" <?php if (isset($employees) && $employees): ?> class="this" <?php endif; ?>><span class="icos-users2"></span>Сотрудники</a></li>
		<li><a href="/joker/user/vendibles" title="" <?php if (isset($vendibles) && $vendibles): ?> class="this" <?php endif; ?>><span class="icos-view"></span>Товары для продажи</a></li>
	</ul>
</div>