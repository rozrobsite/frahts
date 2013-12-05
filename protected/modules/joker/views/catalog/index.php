<?php
/* @var $this UserController */
/* @var $model Users */

$this->pageTitle = Yii::app()->params['joker']['name'] . ' - Настройки (Профиль)';
$this->breadcrumbs = array(
	'/joker/user' => 'Настройки',
	'current' => 'Профиль',
);
?>

<!-- Sidebar begins -->
<div id="sidebar">
	<?php $this->renderPartial('/blocks/mainNavJoker') ?>
    <!-- Secondary nav -->
    <div class="secNav">
		<?php
		$this->renderPartial('_secWrapper', array(
            'countries' => $countries,
            'regions' => $regions,
            'cities' => $cities,
            'countriesRoute' => $countriesRoute,
            'regionsRoute' => $regionsRoute,
            'citiesRoute' => $citiesRoute,
            'businessTypes' => $businessTypes,
            'model' => $model,
        ));
		?>
	</div>
</div>

<!-- Sidebar ends -->
<div id="content">
	<?php $this->renderPartial('/blocks/contentTop') ?>

    <!-- Main content -->
    <div class="wrapper">
		<?php $this->renderPartial('/blocks/_notify') ?>
		<?php $this->renderPartial('/blocks/_middleNavR') ?>
    </div>
</div>