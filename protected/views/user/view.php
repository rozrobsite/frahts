<script type="text/javascript">
	var myMap;
	var cityname = "<?php echo $model->profiles->city->name_ru ?>";
	var address = "<?php echo $model->profiles->address ?>";
</script>
<style>
	strong.title
	{
		font-size: 15px;
	}
</style>

<?php

Yii::app()->clientScript->registerScriptFile('http://api-maps.yandex.ru/2.0/?load=package.full&lang=ru-RU');
Yii::app()->clientScript->registerScriptFile('/js/files/userMap.js'); //включить карту

$this->pageTitle = Yii::app()->name . ' - Данные о пользователе"' . $model->profiles->last_name . ' ' . $model->profiles->first_name . ' ' . $model->profiles->middle_name . '"';
$this->breadcrumbs = array(
	'Данные о пользователе',
);

?>
<!-- Sidebar begins -->
<div id="sidebar">
	<?php $this->renderPartial('/blocks/mainNav') ?>
    <!-- Secondary nav -->
    <div class="secNav">
		<?php
			$this->renderPartial('_secWrapperDetail', array('user' => $model));
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
                <li><a href="/">Главная</a></li>
                <li><a href="<?php echo Yii::app()->session['redirectUrl']; ?>">Поиск груза</a></li>
                <li class="current">
					<a title="">
						<?php echo 'Подробные сведения о пользователе'; ?>
					</a>
				</li>
            </ul>
        </div>

    </div>

    <!-- Main content -->
    <div class="wrapper">
	<?php $this->renderPartial('/blocks/_notify') ?>
	<?php $this->renderPartial('/blocks/_middleNavR') ?>
		<div class="widget">
            <div class="invoice">

			<div class="inHead">
                    <div class="inInfo">
                        <span class="invoiceNum">Данные о пользователе</span>
						<i>На сайте с: <?php echo Yii::app()->dateFormatter->format('dd.MM.yyyy HH:mm', $model->profiles->created_at); ?></i>
                     </div>
                    <div class="clear"></div>
                </div>

                <div class="inContainer">
                    <div class="inFrom" >
						<h5><?php echo $model->profiles->last_name . ' ' . $model->profiles->first_name . ' ' . $model->profiles->middle_name; ?></h5>

						<span><strong><?php echo $model->profiles->userType->name_ru; ?></strong></span>

						<!--<span class="number">Рейтинг: <?php // echo $model->profiles->rating; ?></span>-->
						<strong class="title">Расположение</strong>
						<span><?php echo $model->profiles->country->name_ru .", ". $model->profiles->region->name_ru .", ". $model->profiles->city->name_ru; ?></span>
						<span><?php echo $model->profiles->address; ?></span>
						<strong class="title">Контакты</strong>
						<span class="number"><strong>Мобильный телефон:</strong> <strong class="red"><?php echo $model->profiles->mobile ?></strong></span>
						<?php if ($model->profiles->phone): ?>
							<span><strong>Тедефон/Факс:</strong> <?php echo $model->profiles->skype; ?></span>
						<?php endif; ?>
						<?php if ($model->profiles->skype): ?>
							<span><strong>Skype:</strong> <?php echo $model->profiles->skype; ?></span>
						<?php endif; ?>
						<?php if ($model->profiles->icq): ?>
							<span><strong>ICQ:</strong> <?php echo $model->profiles->icq; ?></span>
						<?php endif; ?>
						<br />
						<?php if ($model->organizations): ?>
							<h5><?php echo $model->organizations->name_org; ?></h5>
							<span><?php echo $model->organizations->typeOrg->name_ru; ?></span>
							<span><strong>Форма:</strong> <?php echo $model->organizations->formOrganizations->name_ru; ?></span>
							<?php if ($model->organizations->form_tax): ?>
								<span><strong>Форма налогообложения:</strong> <?php echo $model->organizations->form_tax; ?></span>
							<?php endif; ?>
							<?php if ($model->organizations->license): ?>
								<span><strong>Лицензия:</strong> <?php echo $model->organizations->license; ?></span>
							<?php endif; ?>
							<?php if ($model->organizations->certificate): ?>
								<span><strong>Сертификат:</strong> <?php echo $model->organizations->certificate; ?></span>
							<?php endif; ?>

							<strong class="title">Реквизиты</strong>
							<?php if ($model->organizations->inn): ?>
								<span><strong>ИНН:</strong> <?php echo $model->organizations->inn; ?></span>
							<?php endif; ?>
							<?php if ($model->organizations->edrpou): ?>
								<span><strong>ЕДРПОУ:</strong> <?php echo $model->organizations->edrpou; ?></span>
							<?php endif; ?>
							<?php if ($model->organizations->account_number): ?>
								<span><strong>Расчетный счет:</strong> <?php echo $model->organizations->account_number; ?></span>
							<?php endif; ?>
							<?php if ($model->organizations->bank): ?>
								<span><strong>Банк:</strong> <?php echo $model->organizations->bank; ?></span>
							<?php endif; ?>
							<?php if ($model->organizations->mfo): ?>
								<span><strong>МФО:</strong> <?php echo $model->organizations->mfo; ?></span>
							<?php endif; ?>

							<strong class="title">Контакты</strong>
							<?php if ($model->organizations->mfo): ?>
								<span><?php echo $model->organizations->address .", ". $model->organizations->address; ?></span>
							<?php endif; ?>
							<?php if ($model->organizations->phone): ?>
								<span class="number"><strong>Телефон:</strong> <strong class="red"><?php echo $model->organizations->phone ?></strong></span>
							<?php endif; ?>
						<?php else: ?>
							<strong class="title">Пользователь не предоставил данных о своей организации.</strong>
						<?php endif; ?>

					</div>
					<div class="floatR" style="width:50%;height:430px; margin:10px; border:1px solid;">
						<div id="map" style="width:100%;height:430px;"></div>
					</div>

                    <div class="clear"></div>
                </div>

				<div class="inContainer">
					<div class="widget grid6">
						<ul class="tabs">
							<?php
								switch ($model->profiles->userType->id) {
									case UserTypes::FREIGHTER:
										$printVehicles = true;
										$printGoods = false;
										break;
									case UserTypes::SHIPPER:
										$printVehicles = false;
										$printGoods = true;
										break;
									default:
										$printVehicles = true;
										$printGoods = true;
								}
							?>
							<li class="activeTab" style=""><a href="#tab_comments">Отзывы</a></li>
							<?php  if ($printGoods): ?> <li class=""><a href="#tab_goods">Грузы</a></li> <?php endif; ?>
							<?php  if ($printVehicles): ?> <li class=""><a href="#tab_vehicles">Транспорт</a></li> <?php endif; ?>
						</ul>
							<?php $this->renderPartial('_reviewsList', array('model'=>$model, 'canWrite' => $canWrite)); ?>
							<?php $this->renderPartial('_userGoodsList', array('printGoods' => $printGoods, 'model'=>$model)); ?>
							<?php $this->renderPartial('_userVehiclesList', array('printVehicles' => $printVehicles, 'model'=>$model)); ?>
						</div>
						<div class="clear"></div>
					</div>
					<div class="clear"></div>
				</div>
            </div>
        </div>
</div>
<!-- Content ends -->
