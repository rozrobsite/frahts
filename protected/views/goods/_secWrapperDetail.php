<div class="secWrapper">

	<?php $this->renderPartial('/blocks/secTop') ?>

	<!-- Tabs container -->
	<div id="tab-container" class="tab-container">
		<ul class="iconsLine ic1 etabs">
			<li class="user_profile_tab"><a href="#goodsSearch" class="exp subClosed">Мой транспорт</a></li>
		</ul>

		<div class="divider"><span></span></div>

		<div id="goodsSearch">
			<div class="sidePad">
				<a href="/vehicle/new" title="" class="sideB bGreen">Добавить транспорт</a>
			</div>
			<?php if ($this->user->vehicles): ?>
				<div class="divider"><span></span></div>
				<div class="sidePad">
					<a href="/vehicle/search" title="Поиск всех доступных грузов" class="sideB bSea tipS">Показать все грузы</a>
				</div>
			<?php endif; ?>

			<div class="divider"><span></span></div>
			
		</div>
		<div class="clear"></div>
	</div>

</div>
<div class="clear"></div>