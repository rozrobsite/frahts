<div id="settings">
	<ul class="subNav">
		<li><a href="/joker/user" title="" <?php if (isset($profiles) && $profiles): ?> class="this" <?php endif; ?>><span class="icos-fullscreen"></span>Профиль</a></li>
		<li><a href="/joker/user/organization" title="" <?php if (isset($organizations) && $organizations): ?> class="this" <?php endif; ?>><span class="icos-images2"></span>Организация</a></li>
		<li><a href="/joker/employee" title="" <?php if (isset($employees) && $employees): ?> class="this" <?php endif; ?>><span class="icos-coverflow"></span>Сотрудники</a></li>
		<li><a href="/joker/vendibles" title="" <?php if (isset($vendibles) && $vendibles): ?> class="this" <?php endif; ?>><span class="icos-view"></span>Товары для продажи</a></li>
	</ul>
</div>