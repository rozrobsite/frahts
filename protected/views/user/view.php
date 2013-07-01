
<?php

Yii::app()->clientScript->registerScriptFile('http://api-maps.yandex.ru/2.0/?load=package.full&lang=ru-RU');

$this->pageTitle = Yii::app()->name . ' - Данные о пользователе "' . $model->username . '"';
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
	<?php $this->renderPartial('/blocks/contentTop') ?>

    <!-- Breadcrumbs line -->
    <div class="breadLine">
        <div class="bc">
            <ul id="breadcrumbs" class="breadcrumbs">
                <li><a href="/">Главная</a></li>
                <li><a href="<?php echo Yii::app()->session['redirectUrl']; ?>">Поиск груза</a></li>
                <li class="current">
					<a title="">
						<?php echo 'Данные о пользователе "' . $model->username . '"'; ?>
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
                    <!--<span class="inLogo"><a href="index.html" title="invoice"><img src="images/newLogo.png" alt="logo" /></a></span>-->
                    <div class="inInfo">
                        <span class="invoiceNum"><?php echo $model->username ?></span>
                     </div>
                    <div class="clear"></div>
                </div>

                <div class="inContainer">
                    <div class="inFrom" style="width:30%">
                        <h5>Данные о пользователе</h5>
						<span>
							<strong>
								<?php echo $model->profiles->userType->name_ru; ?>
							</strong>
						</span>
						<span>
							<?php echo $model->profiles->last_name . ' ' . $model->profiles->first_name . ' ' . $model->profiles->middle_name; ?>
						</span>
						<span><?php echo $model->organizations->name_org; ?></span>
						<span class="number">Мобильный телефон: <strong class="red"><?php echo $model->profiles->mobile ?></strong></span>
						<span>На сайте с <?php echo Yii::app()->dateFormatter->format('dd.MM.yyyy', $model->profiles->created_at); ?></span>          
					</div>
								
                    <div class="clear"></div>
                </div>
				
				<div class="inContainer">
					<div class="widget grid6">       
						<ul class="tabs">
							<li class="activeTab" style=""><a href="#tabb1">Tab active</a></li>
							<li class=""><a href="#tabb2">Tab inactive</a></li>
						</ul>
						
						<div class="tab_container">
							<div id="tabb1" class="tab_content" style="display: block;">
								Tab is active and has left tabs             
							</div>
							<div id="tabb2" class="tab_content" style="display: none;"> This tab is active now</div>
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
