<div class="secWrapper">	<?php $this->renderPartial('/blocks/secTop') ?>	<!-- Tabs container -->	<div id="tab-container" class="tab-container">		<ul class="iconsLine ic1 etabs">			<li class="user_profile_tab"><a href="#user_profile" class="exp subClosed">Настройки пользователя</a></li>		</ul>		<div class="divider"><span></span></div>		<div id="user_profile">			<ul class="subNav">				<li><a href="/user/" title=""><span class="icos-admin2"></span>Личный кабинет</a></li>				<li><a href="/user/organization" title=""><span class="icos-users"></span>Организация</a></li>				<?php if (isset($this->user->profiles->user_type_id) && $this->user->profiles->user_type_id == 3): ?>					<li><a href="/vehicle/active" title=""><span class="icos-truck"></span>Транспорт</a></li>					<li><a href="/goods/search" title=""><span class="icos-dropbox"></span>Груз</a></li>				<?php elseif (isset($this->user->profiles->user_type_id) && $this->user->profiles->user_type_id == 2): ?>					<li><a href="/goods/search" title=""><span class="icos-dropbox"></span>Груз</a></li>				<?php elseif (isset($this->user->profiles->user_type_id) && $this->user->profiles->user_type_id == 1): ?>					<li><a href="/vehicle/active" title=""><span class="icos-truck"></span>Транспорт</a></li>				<?php endif; ?>				<li><a href="/user/reviews" title=""><span class="icos-create"></span>Отзывы</a></li>			</ul>		</div>	</div></div><div class="clear"></div>