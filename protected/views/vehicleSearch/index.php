<?php
/* @var $this UserController */
/* @var $model Users */

$this->pageTitle = Yii::app()->name . ' - Поиск подходящего груза';
$this->breadcrumbs = array(
	'Поиск подходящего груза',
);
?>
<!-- Sidebar begins -->
<div id="sidebar">
	<?php $this->renderPartial('/blocks/mainNav') ?>
    <!-- Secondary nav -->
    <div class="secNav">
		<?php
		$this->renderPartial('_secWrapper', array('vehicleActive' => $vehicleActive, 'goods' => $goods))
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
                <li><a href="/vehicleSearch">Поиск груза</a></li>
                <li class="current">
					<a title="">Найденные подходящие грузы</a>
				</li>
            </ul>
        </div>

    </div>

    <!-- Main content -->
    <div class="wrapper">
		<?php if (!$this->user->vehicles): ?>
			<div class="fluid" style="text-align: center;margin-top: 50px;">
				<label style="font-weight: bold; font-size: 16px;">
					У Вас нет добавленных транспортных средств. Добавьте транспортное средство чтобы найти подходящий груз.
				</label>
				<div class="formRow" style="border-top: 0">
					<div class="grid5">&nbsp;</div>
					<div class="grid2">
						<a id="vehicles_modal_open" href="/vehicle/new" title="" class="sideB bGreen goods_modal_open">Добавить транспорт</a>
					</div>
					<div class="grid5">&nbsp;</div>
				</div>
			</div>
		<?php else: ?>
		<?php if (!$goods): ?>
			<div class="fluid" style="text-align: center;margin-top: 50px;">
				<label style="font-weight: bold; font-size: 16px;">
					К сожалению для Вашего транспортного средства не найдено ни одного подходящего груза.
				</label>
			</div>
		<?php else: ?>
			<div class="fluid">
				<div class="widget check">
					<div class="whead">
						<span class="titleIcon">
							<input type="checkbox" id="titleCheck" name="titleCheck" />
						</span>
						<h6>Найденные подходящие грузы для Вашего транспортного средства (1200 шт.)</h6>
						<div class="clear"></div>
					</div>
				</div>
			</div>
			<?php endif; ?>
		<?php endif; ?>
	</div>
	<!-- Content ends -->
<?php $this->renderPartial('/blocks/_notify') ?>