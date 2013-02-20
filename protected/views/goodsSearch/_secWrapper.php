<div class="secWrapper">
	
	<?php $this->renderPartial('/blocks/secTop') ?>

	<!-- Tabs container -->
	<div id="tab-container" class="tab-container">
		<ul class="iconsLine ic3 etabs">
			<li><a href="#vehicle" title="Мой транспорт" class="tipN" original-title="Мой транспорт"><span class="icos-truck"></span></a></li>
			<!--<li><a href="#user_profile" title="Настройки пользователя" class="tipN" original-title="Настройки пользователя"><span class="icos-user"></span></a></li>-->
			<li><a href="#soon"></a></li>
			<li><a href="#soon"></a></li>
		</ul>

		<div class="divider"><span></span></div>

		<div id="vehicle">
			<div class="sidePad">
				<a href="/goodsSearch/new" title="" class="sideB bGreen goods_modal_open">Добавить</a>
			</div>

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
//					'firstPageLabel'=> '<<',
//					'prevPageLabel'=> '<',
//					'nextPageLabel'=> '>',
//					'lastPageLabel'=> '>>',
//					'maxButtonCount' => 4,
//					'cssFile'=>'/css/pager.css', // устанавливаем свой .css файл
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