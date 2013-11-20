<?php
Yii::app()->clientScript->registerScriptFile('/js/files/add_friend.js', CClientScript::POS_BEGIN);
?>
<div class="breadLinks">
	<ul>
		<li><a href="/joker/advertise" class="tipS" title="Заказать рекламу. Просмотреть статистику показов рекламных банеров"><i class="icos-user"></i><span>Реклама</span></a></li>
		<li class="has">
			<a title="">
				<i class="icos-admin"></i>
				<span>Настройки</span>
				<span><img src="/images/elements/control/hasddArrow.png" alt="" /></span>
			</a>
			<ul style="width: 200px;">
				<li><a href="/joker/user" title=""><span class="icos-admin2"></span>Профиль</a></li>
				<li><a href="/joker/user/organization" title=""><span class="icos-users"></span>Организация</a></li>
				<li><a href="/joker/employee" title=""><span class="icos-users2"></span>Сотрудники</a></li>
				<li><a href="/joker/vendibles" title=""><span class="icos-search"></span>Товары для продажи</a></li>
			</ul>
		</li>
	</ul>
	<div class="clear"></div>
</div>