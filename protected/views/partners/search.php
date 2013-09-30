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
			'regions' => $regions,
			'cities' => $cities,
			'model' => $model,
			'profiles' => $profiles,
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
                <li class="current"><a title="">Поиск пользователей</a></li>
            </ul>
        </div>
		<?php $this->renderPartial('/blocks/_breadLinks') ?>
    </div>

    <!-- Main content -->
    <div class="wrapper">
		<?php $this->renderPartial('/blocks/_notify') ?>
		<?php $this->renderPartial('/blocks/_middleNavR') ?>

		<div class="fluid grid12">
			<div class="widget grid12">
				<div class="whead"><h6>Список пользователей</h6><div class="clear"></div></div>
				<div class="body">
				</div>
			</div>
		</div>

    </div>
</div>
<!-- Content ends -->