<?php
Yii::app()->clientScript->registerScriptFile('/js/files/partners.js', CClientScript::POS_BEGIN);

$this->pageTitle = Yii::app()->name . ' - Поиск пользователей';
$this->breadcrumbs = array(
	'Поиск пользователей',
);
?>

<!-- Sidebar begins -->
<div id="sidebar">
	<?php $this->renderPartial('/blocks/mainNav') ?>
    <!-- Secondary nav -->
    <div class="secNav">
		<?php
		$this->renderPartial('_secWrapper', array(
			'countries' => $countries,
		));
		?>
	</div>
</div>

<!-- Sidebar ends -->
<div id="content">
	<?php $this->renderPartial('/blocks/contentTop') ?>
    <!-- Breadcrumbs line -->
    <div class="breadLine">
        <div class="bc">
            <ul id="breadcrumbs" class="breadcrumbs">
                <li><a href="<?php echo isset($this->headerUrl) ? $this->headerUrl : '/user'; ?>">Главная</a></li>
                <li class="current"><a title="">Партнеры</a></li>
            </ul>
        </div>
    </div>

    <!-- Main content -->
    <div class="wrapper">
		<?php $this->renderPartial('/blocks/_notify') ?>
		<?php $this->renderPartial('/blocks/_middleNavR') ?>

		<div class="fluid grid12">
			<?php
			$form = $this->beginWidget('CActiveForm', array(
				'id' => 'searchPartnersForm',
				'method' => 'get',
				'action' => '/partners/search',
				'enableAjaxValidation' => false,
				'clientOptions' => array(
					'validateOnSubmit' => false,
				),
				'htmlOptions' => array('class' => 'main'),
				));
			?>
			<style>
				.formRow{padding-top: 12px;}
			</style>
			<div class="widget grid2" style="min-width: 250px;">
                <div class="whead"><h6>Настройки поиска</h6><div class="clear"></div></div>
                <div class="body">
					<fieldset>
						<div class="formRow">
							<div>
								<select id="partnerSearchCountry" name="partnerSearchCountry">
									<option value="">Выберите страну</option>
									<?php foreach ($countries as $country): ?>
										<option value="<?php echo $country->id; ?>"><?php echo $country->name_ru; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div>
								<select id="partnerSearchRegion" name="partnerSearchRegion" >
									<option value="">Выберите регион</option>
								</select>
							</div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div>
								<select id="partnerSearchCity" name="partnerSearchCity" >
									<option value="">Выберите населенный пункт</option>
								</select>
							</div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div>
								<input type="checkbox" id="partnerSearchShipper" name="partnerSearchShipper" checked="checked" class="check" />
								<label for="partnerSearchShipper"  class="nopadding">Грузоперевозчики</label>
							</div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div>
								<input type="checkbox" id="partnerSearchFreighter" name="partnerSearchFreighter" checked="checked" class="check" />
								<label for="partnerSearchFreighter"  class="nopadding">Грузоотправители</label>
							</div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div>
								<input type="checkbox" id="partnerSearchDispatcher" name="partnerSearchDispatcher" checked="checked" class="check" />
								<label for="partnerSearchDispatcher"  class="nopadding">Логистические операторы</label>
							</div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div>
								<input type="text" name="partnerSearchWords" placeholder="Введите имя или название" />
							</div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div style="text-align: right">
								<input type="submit" class="buttonS bLightBlue" value="Найти">
							</div>
							<div class="clear"></div>
						</div>
					</fieldset>
				</div>
            </div>

			<div class="widget grid9">
				<div class="whead"><h6>Список пользователей</h6><div class="clear"></div></div>
				<div class="body">
					<?php
					$this->widget('ext.widgets.EColumnListView', array(
						'dataProvider' => $profiles,
						'itemView' => '_item',
						'columns' => 3,
						'emptyText'=>'Пользователей не надено.',
						'summaryText'=>"{start}&mdash;{end} из {count}",
						'template' => "{items}\n{pager}",
						'pagerCssClass' => 'pagination',
						'pager' => array(
							'prevPageLabel' => '<',
							'firstPageLabel' => '<<',
							'nextPageLabel' => '>',
							'lastPageLabel' => '>>',
							'header' => '',
							'cssFile' => '/css/pager.css',
							'class' => 'CLinkPager',
							'htmlOptions' => array(
								'class' => 'pages'
							),
						),
					));
					?>
				</div>
			</div>
			<?php $this->endWidget(); ?>
		</div>

    </div>
</div>
<!-- Content ends -->