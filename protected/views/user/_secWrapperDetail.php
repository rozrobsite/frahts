<div class="secWrapper">

	<?php $this->renderPartial('/blocks/secTop') ?>

	<!-- Tabs container -->
	<div id="tab-container" class="tab-container">
		<ul class="iconsLine ic1 etabs">
			<li class="user_profile_tab">
				<a href="#user" class="exp subClosed">Пользователь</a>
			</li>
		</ul>

		<div class="divider"><span></span></div>

		<div id="user">
			<div class="sidePad">
				<a href="/user/messages/user/<?php echo $user->id ?>#users_message" title="Написать сообщение пользователю" class="sideB bSea tipS">Написать сообщение</a>
			</div>
			<?php/* if ($this->user->goods): ?>
				<div class="divider"><span></span></div>
				<div class="sidePad">
					<a href="/goods/search" title="Вывести все доступные транспортные средства" class="sideB bSea tipS">Все транспортные средства</a>
				</div>
			<?php endif; */?>

			<div class="divider"><span></span></div>

		</div>
		<div class="clear"></div>
	</div>

</div>
<div class="clear"></div>