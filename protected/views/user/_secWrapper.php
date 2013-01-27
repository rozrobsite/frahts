<div class="secWrapper">
	<div class="secTop">
		<div class="balance">
			<div class="balInfo">Баланс:<span><?php echo Yii::app()->dateFormatter->format('dd.MMM.yyyy', time()); ?></span></div>
			<div class="balAmount">
				<span class="balBars"><!--5,10,15,20,18,16,14,20,15,16,12,10--></span>
				<span class="tipN" original-title="Специальная единица сайта"><?php echo $this->user->balance ?> фрахтов</span>
			</div>
		</div>
	</div>

	<!-- Tabs container -->
	<div id="tab-container" class="tab-container">
		<ul class="iconsLine ic3 etabs">
			<li><a href="#user_profile" title="Настройки пользователя" class="tipN" original-title="Настройки пользователя"><span class="icos-user"></span></a></li>
			<li><a href="#user_items" title="Настройки транспорта / груза" class="tipN" original-title="Настройки транспорта / груза"><span class="icos-truck"></span></a></li>
			<li><a href="#user_files" title="Файлы" class="tipN" original-title="Файлы"><span class="icos-files"></span></a></li>
		</ul>

		<div class="divider"><span></span></div>

		<div id="user_profile">
			<ul class="subNav">
				<li><a href="/user/" title="" <?php if (isset($selectProfile)): ?>class="this"<?php endif; ?>><span class="icos-admin2"></span>Личные настройки</a></li>
				<li><a href="/user/organization" title="" <?php if (isset($selectOrganization)): ?>class="this"<?php endif; ?>><span class="icos-users"></span>Организация</a></li>
				<?php if (isset($this->user->profiles->user_type_id) && $this->user->profiles->user_type_id == 3): ?>
					<li><a href="/vehicle/new" title=""><span class="icos-truck"></span>Транспорт</a></li>
					<li><a href="/user/shipper" title=""><span class="icos-trolly"></span>Груз</a></li>
				<?php elseif(isset($this->user->profiles->user_type_id) && $this->user->profiles->user_type_id == 2): ?>
					<li><a href="/user/shipper" title=""><span class="icos-trolly"></span>Груз</a></li>
				<?php elseif(isset($this->user->profiles->user_type_id) && $this->user->profiles->user_type_id == 1): ?>
					<li><a href="/vehicle/new" title=""><span class="icos-truck"></span>Транспорт</a></li>
				<?php endif; ?>
			</ul>
		</div>

		<div id="user_items">
			<ul class="userList">
				<li>
					<a href="#" title="">
						<span class="contactName">
							<strong>Eugene Kopyov <span>(5)</span></strong>
							<i>web &amp; ui designer</i>
						</span>
						<span class="status_away"></span>
						<span class="clear"></span>
					</a>
				</li>
				<li>
					<a href="#" title="">
						<span class="contactName">
							<strong>Lucy Wilkinson <span>(12)</span></strong>
							<i>Team leader</i>
						</span>
						<span class="status_off"></span>
						<span class="clear"></span>
					</a>
				</li>
				<li>
					<a href="#" title="">
						<span class="contactName">
							<strong>John Dow</strong>
							<i>PHP developer</i>
						</span>
						<span class="status_available"></span>
						<span class="clear"></span>
					</a>
				</li>
				<li>
					<a href="#" title="">
						<span class="contactName">
							<strong>The Incredible</strong>
							<i>web &amp; ui designer</i>
						</span>
						<span class="status_available"></span>
						<span class="clear"></span>
					</a>
				</li>
				<li>
					<a href="#" title="">
						<span class="contactName">
							<strong>The wazzup guy</strong>
							<i>web &amp; ui designer</i>
						</span>
						<span class="status_available"></span>
						<span class="clear"></span>
					</a>
				</li>
				<li>
					<a href="#" title="">
						<span class="contactName">
							<strong>Viktor Fedorovich</strong>
							<i>web &amp; ui designer</i>
						</span>
						<span class="status_available"></span>
						<span class="clear"></span>
					</a>
				</li>
			</ul>
		</div>

		<div id="user_files">
			<div class="widget">
				<div class="whead">
					<h6><span class="icon-tree-view"></span>Simple jQuery file tree</h6>
					<div class="clear"></div>
				</div>
			</div>
		</div>
	</div>

</div>
<div class="clear"></div>