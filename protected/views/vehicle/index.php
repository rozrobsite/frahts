<?php
/* @var $this UserController */
/* @var $model Users */

$this->pageTitle = Yii::app()->name . ' - Мой транспорт';
$this->breadcrumbs = array(
	'Мой транспорт',
);
?>
<!-- Sidebar begins -->
<div id="sidebar">
	<?php $this->renderPartial('/blocks/mainNav') ?>
    <!-- Secondary nav -->
    <div class="secNav">
		<?php
		$this->renderPartial('_secWrapper', array('selectProfile' => true))
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
                <li><a href="/vehicle">Мой транспорт</a></li>
                <li class="current"><a title="">Регистрация транспорта</a></li>
            </ul>
        </div>

    </div>

    <!-- Main content -->
    <div class="wrapper">
		<?php $this->renderPartial('_accessMessage') ?>
        <!-- Tabs -->
		<div class="fluid">
			<?php
			$form = $this->beginWidget('CActiveForm',
					array(
				'id' => 'organizations-form',
				'enableAjaxValidation' => false,
				'clientOptions' => array(
					'validateOnSubmit' => true,
				),
//				'focus' => array($model, 'user_type_id'),
				'htmlOptions' => array('class' => 'main', 'enctype' => 'multipart/form-data'),
					));
			?>
			<div class="widget grid12">     
				<div class="whead">
					<h6>Регистрация нового транспорта</h6>
					<div class="clear"></div>
				</div>
			</div>
			<div class="clear"></div>
			<?php $this->endWidget(); ?>
		</div>

	</div>
	<!-- Content ends -->

