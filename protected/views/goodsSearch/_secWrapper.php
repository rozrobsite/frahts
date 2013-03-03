<div class="secWrapper">
	
	<?php $this->renderPartial('/blocks/secTop') ?>

	<!-- Tabs container -->
	<div id="tab-container" class="tab-container">
		<ul class="iconsLine ic1 etabs">
			<li class="user_profile_tab"><a href="#goodsSearch" class="exp subClosed">Мои грузы</a></li>
		</ul>

		<div class="divider"><span></span></div>

		<div id="goodsSearch">
			<div class="sidePad">
				<a href="/goods/new" title="" class="sideB bGreen">Добавить груз</a>
				<a href="/goods/inactive" title="" class="sideB bGold mt10">Удаленные из поиска грузы</a>
			</div>
			<?php if ($vehicles): ?>
				<div class="divider"><span></span></div>
				<div class="sidePad">
					<a href="#" title="Вывести все транспортные средства" class="sideB bSea tipS">Все транспортные средства</a>
				</div>
			<?php endif; ?>

			<div class="divider"><span></span></div>
			<?php if ($goodsActive): ?>
			
			<div class="sideUpload">
			<?php $this->widget('zii.widgets.CListView', array(
				'dataProvider'=>$goodsActive,
				'itemView'=>'_goodsList',
				'itemsTagName' => 'ul',
				'itemsCssClass' => 'filesDown',
				'ajaxUpdate'=>true,
				'emptyText'=>'У Вас нет добавленных грузов.',
				'template'=>"{items}{pager}",
				'pager'=>array(
					'class'=>'CListPager',
					'header'=>'Страница:',
					'htmlOptions'=>array('class'=>'pages'),
				),
			)); ?>
			</div>
			
			<?php endif; ?>
		</div>
		<div class="clear"></div>
	</div>

</div>
<div class="clear"></div>