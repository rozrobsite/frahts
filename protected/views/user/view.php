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
                <li><a href="<?php echo isset($this->headerUrl) ? $this->headerUrl : '/user'; ?>">Главная</a></li>
                <li class="current">
					<a title="">
						<?php echo 'Подробные сведения о пользователе'; ?>
					</a>
				</li>
            </ul>
        </div>

    </div>

    <!-- Main content -->
    <?php
	$this->renderPartial('_view', array(
		'model' => $model,
		'offer' => $offer,
		'offer_id' => $offer_id,
		'canWrite' => $canWrite,
	));
	?>
</div>
<!-- Content ends -->
