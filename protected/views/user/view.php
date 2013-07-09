<script type="text/javascript">
	var myMap;
	var cityname = "<?php echo $model->profiles->city->name_ru ?>";
	var address = "<?php echo $model->profiles->address ?>";
</script>

<?php

Yii::app()->clientScript->registerScriptFile('http://api-maps.yandex.ru/2.0/?load=package.full&lang=ru-RU');
//Yii::app()->clientScript->registerScriptFile('/js/files/userMap.js'); //включить карту

$this->pageTitle = Yii::app()->name . ' - Данные о пользователе "' . $model->profiles->last_name . ' ' . $model->profiles->first_name . ' ' . $model->profiles->middle_name . '"';
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
		//$this->renderPartial('_secWrapperDetail', array());
		?>
	</div>
</div>
<!-- Sidebar ends -->
<div id="content">
<!-- 	<?php $this->renderPartial('/blocks/contentTop') ?> -->

    <!-- Breadcrumbs line -->
    <div class="breadLine">
        <div class="bc">
            <ul id="breadcrumbs" class="breadcrumbs">
                <li><a href="/">Главная</a></li>
                <li><a href="<?php echo Yii::app()->session['redirectUrl']; ?>">Поиск груза</a></li>
                <li class="current">
					<a title="">
						<?php echo 'Данные о пользователе "' . $model->profiles->last_name . ' ' . $model->profiles->first_name . ' ' . $model->profiles->middle_name . '"'; ?>
					</a>
				</li>
            </ul>
        </div>

    </div>

    <!-- Main content -->
    <div class="wrapper">
	<?php $this->renderPartial('/blocks/_notify') ?>
		<div class="widget">
            <div class="invoice">

			<div class="inHead">
                    <div class="inInfo">
                        <span class="invoiceNum">Данные о пользователе</span>
                     </div>
                    <div class="clear"></div>
                </div> 

                <div class="inContainer">
                    <div class="inFrom" >                        					
						<h5><?php echo $model->profiles->last_name . ' ' . $model->profiles->first_name . ' ' . $model->profiles->middle_name; ?></h5>
					
						<span><strong><?php echo $model->profiles->userType->name_ru; ?></strong></span>
						
						<span>На сайте с <?php echo Yii::app()->dateFormatter->format('dd.MM.yyyy', $model->profiles->created_at); ?></span> 
						<span class="number">Рейтинг: <?php echo $model->profiles->rating; ?></span>
						<strong>Расположение</strong>
						<span><?php echo $model->profiles->country->name_ru .", ". $model->profiles->region->name_ru .", ". $model->profiles->city->name_ru; ?></span>
						<span><?php echo $model->profiles->address; ?></span>
						<strong>Контакты</strong>
						<span class="number">Мобильный телефон: <strong class="red"><?php echo $model->profiles->mobile ?></strong></span>
						<span>Skype: <?php echo $model->profiles->skype; ?></span>
						<span>ICQ: <?php echo $model->profiles->icq; ?></span>
						<br />	
						<h5><?php echo $model->organizations->name_org; ?></h5>
						<span><?php echo $model->organizations->typeOrg->name_ru; ?></span>
						<span>Форма: <?php echo $model->organizations->formOrganizations->name_ru; ?></span>
						<span>Форма налогообложения: <?php echo $model->organizations->form_tax; ?></span>
						<span>Лицензия: <?php echo $model->organizations->license; ?></span>
						<span>Сертификат: <?php echo $model->organizations->certificate; ?></span>
						
						<strong>Реквизиты</strong>
						<span>ИНН: <?php echo $model->organizations->inn; ?></span>
						<span>ЕДРПОУ: <?php echo $model->organizations->edrpou; ?></span>
						<span>Р. счет: <?php echo $model->organizations->account_number; ?></span>
						<span>Банк: <?php echo $model->organizations->bank; ?></span>
						<span>МФО: <?php echo $model->organizations->mfo; ?></span>
						
						<strong>Контакты</strong>
						<span><?php echo $model->organizations->city .", ". $model->organizations->address; ?></span>
						<span class="number">Телефон: <strong class="red"><?php echo $model->organizations->phone ?></strong></span>
						
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
							<?php $this->renderPartial('_reviewsList', array('model'=>$model)); ?>
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
</div>
<!-- Content ends -->
