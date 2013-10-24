<?php$this->pageTitle = Yii::app()->name . ' - Мои грузы';$this->breadcrumbs = array(	'current' => 'Мои грузы',);?><!-- Sidebar begins --><div id="sidebar">	<?php $this->renderPartial('/blocks/mainNav') ?>    <!-- Secondary nav -->    <div class="secNav">		<?php		$this->renderPartial('_secWrapper', array(			'goodsActive' => $goodsActive,			'goodsNoActive' => $goodsNoActive,		));		?>	</div></div><!-- Sidebar ends --><div id="content">	<?php $this->renderPartial('/blocks/contentTop') ?>    <!-- Main content -->    <div class="wrapper">		<?php $this->renderPartial('/blocks/_middleNavR') ?>			<div class="fluid">				<div class="widget">					<div class="whead"><h6>Мои грузы</h6><div class="clear"></div></div>					<div id="dyn" class="hiddenpars">						<table cellpadding="0" cellspacing="0" border="0" class="dTable" id="dynamic">						<thead>							<tr>								<th style="background: #EEE;">№</th>								<th style="background: #EEE;">Короткое название</th>								<th style="background: #EEE;">Период доставки</th>								<th style="background: #EEE;">Дата добавления</th>								<th style="background: #EEE;">Действия</th>							</tr>						</thead>						<tbody style="text-align: center;">							<?php foreach ($this->user->goods as $good): ?>								<?php if ($good->is_deleted) continue; ?>								<tr class="gradeX">									<td><?php echo $good->id ?></td>									<td><strong><?php echo $good->name ?></strong></td>									<td style="<?php if ($good->date_to < time()): ?>color:red<?php endif; ?>">										<?php echo date('d.m.Y', $good->date_from) ?> - <?php echo date('d.m.Y', $good->date_to) ?><br/>										<?php if ($good->date_to < time()): ?><span style="color:red; font-size: 11px;">(Просрочено, обязательно обновите данные или удалите груз)</span><?php endif; ?>									</td>									<td class="center"><?php echo date('d.m.Y', $good->created_at) ?></td>									<td class="center">										<a href="/goods/update/<?php echo $good->slug ?>" class="tablectrl_small bLightBlue tipS" title="Редактировать">											<span class="iconb" data-icon="&#xe1db;"></span>										</a>										<a href="javascript:void(0)" class="tablectrl_small bGold tipS goodDeleteSearch" title="Удалить груз" rel="<?php echo $good->id ?>"><span class="iconb" data-icon="&#xe136;"></span></a>									</td>								</tr>							<?php endforeach; ?>						</tbody>						</table>					</div>				</div>			</div>	</div></div>	<!-- Content ends --><?php $this->renderPartial('/blocks/_notify') ?>