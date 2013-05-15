<?php
/* @var $this UserController */
/* @var $model Users */

$this->pageTitle = Yii::app()->name . ' - Неактивные грузы';
$this->breadcrumbs = array(
	' Неактивные грузы',
);
?>
<!-- Sidebar begins -->
<div id="sidebar">
	<?php $this->renderPartial('/blocks/mainNav') ?>
    <!-- Secondary nav -->
    <div class="secNav">
		<?php
		$this->renderPartial('_secWrapper', array(
			'goodsActive' => $goodsActive, 
			'goodsNoActive' => $goodsNoActive, 
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
                <li><a href="/">Главная</a></li>
                <li><a href="/goods/search">Поиск транспорта</a></li>
                <li class="current">
					<a title="">
						<?php echo 'Неактивные грузы' ?>
					</a>
				</li>
            </ul>
        </div>

    </div>

    <!-- Main content -->
    <div class="wrapper">
		<?php if (!$goodsNoActive): ?>
			<div class="fluid" style="text-align: center;margin-top: 50px;">
				<label style="font-weight: bold; font-size: 16px;">У Вас нет грузов удаленных из поиска.</label>
			</div>
		<?php else: ?>
			<div class="fluid">
				<div class="widget">
					<div class="whead"><h6>Грузы удаленные из поиска</h6><div class="clear"></div></div>
					<div id="dyn" class="hiddenpars">
						<a class="tOptions tipS" title="Фильтры"><img src="/images/icons/options" alt="" /></a>
						<table cellpadding="0" cellspacing="0" border="0" class="dTable" id="dynamic">
						<thead>
							<tr>
								<th>№<span class="sorting" style="display: block;"></span></th>
								<th>Короткое название</th>
								<th style="background: #EEE;">Период доставки</th>
								<th>Дата добавления</th>
								<th style="background: #EEE;">Действия</th>
							</tr>
						</thead>
						<tbody style="text-align: center;">
							<?php foreach ($goodsNoActive->getData() as $good): ?>
							<tr class="gradeX">
								<td><?php echo $good->id ?></td>
								<td><strong><?php echo $good->name ?></strong></td>
								<td><?php echo date('d.m.Y', $good->date_from) ?> - <?php echo date('d.m.Y', $good->date_to) ?></td>
								<td class="center"><?php echo date('d.m.Y', $good->created_at) ?></td>
								<td class="center">
									<a href="/goods/update/<?php echo $good->slug ?>" class="tablectrl_small bLightBlue tipS" title="Редактировать">
										<span class="iconb" data-icon="&#xe1db;"></span>
									</a>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
						</table> 
					</div>
				</div>
			</div>
		<?php endif; ?>
	</div>
</div>
	<!-- Content ends -->
<?php $this->renderPartial('/blocks/_notify') ?>