<div class="mainNav">
	<div class="user">
		<a href="javascript:void(0);" class="leftUserDrop"><img src="/images/userLogin2.png" width="72" height="70" alt="" /></a><span>
			<?php
				if (isset($this->user->profiles)) echo ucfirst($this->user->profiles->first_name);
				else echo 'Гость';
			?>
		</span>
		<ul class="leftUser">
			<li><a href="/user" title="Личные настройки" class="sProfile">Настройки пользователя</a></li>
			<?php if ($this->user->vehicles): ?>
				<li><a href="/vehicle/new" title="Личный транспорт пользователя" class="sTruck">Мой транспорт</a></li>
				<li><a href="/vehicle/new" title="Личный груз пользователя" class="sBox">Мои грузы</a></li>
			<?php endif; ?>
			<li><a href="#" title="Сообщения" class="sMessages">Сообщения</a></li>
			<li><a href="/user" title="Файлы" class="sFiles">Файлы</a></li>
			<li><a href="/main/logout" title="Выход" class="sLogout">Выход</a></li>
		</ul>
	</div>

	<!-- Responsive nav -->
	<div class="altNav">
		<div class="userSearch">
			<form action="">
				<input type="text" placeholder="search..." name="userSearch" />
				<input type="submit" value="" />
			</form>
		</div>

		<!-- User nav -->
		<ul class="userNav">
			<li><a href="#" title="" class="profile"></a></li>
			<li><a href="#" title="" class="messages"></a></li>
			<li><a href="#" title="" class="settings"></a></li>
			<li><a href="#" title="" class="logout"></a></li>
		</ul>
	</div>

	<!-- Main nav -->
	<ul class="nav">
		<?php if (isset($this->is_access_search) && $this->is_access_search): ?>
			<li><a href="index.html" title="Поиск транспорта для грузоперевозок" class="tipW" original-title="Поиск транспорта для грузоперевозок"><img src="/images/icons/mainnav/transport4.png" alt="Поиск транспорта для грузоперевозок" /><span>Транспорт</span></a></li>
		<?php endif; ?>
		<li><a href="/user/feedback" title="Свяжитесь с нами если у Вас есть вопросы или предложения" original-title="Свяжитесь с нами если у Вас есть вопросы или предложения" class="tipW <?php if(isset($userFeedback) && $userFeedback): ?>active<?php endif; ?>"><img src="/images/icons/mainnav/contacts2.png" alt="" /><span>Обратная связь</span></a></li>
		<li><a href="forms.html" title=""><img src="/images/icons/mainnav/ui.png" alt="" /><span>Партнеры</span></a></li>
		<li><a href="messages.html" title=""><img src="/images/icons/mainnav/files.png" alt="" /><span>Файлы</span></a></li>
		<li><a href="statistics.html" title=""><img src="/images/icons/mainnav/document.png" alt="" /><span>Документы</span></a></li>
	</ul>
</div>