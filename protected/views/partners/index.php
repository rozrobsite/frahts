<style>
	.btn-group:before, .btn-group:after{display: block;}
</style>
<?php
Yii::app()->clientScript->registerScriptFile('/js/files/partners.js', CClientScript::POS_BEGIN);
Yii::app()->clientScript->registerScriptFile('/js/files/partner.js', CClientScript::POS_BEGIN);

$this->pageTitle = Yii::app()->name . ' - Мои партнеры';
$this->breadcrumbs = array(
	'current' => 'Мои партнеры',
);
?>
<!-- Sidebar begins -->
<div id="sidebar">
	<?php $this->renderPartial('/blocks/mainNav') ?>
    <!-- Secondary nav -->
    <div class="secNav">
		<?php
		$this->renderPartial('_secWrapperIndex')
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

		<div class="fluid">
				<div class="widget">
					<div class="whead"><h6>Мои партнеры</h6><div class="clear"></div></div>
					<div id="dyn" class="hiddenpars">
						<table cellpadding="0" cellspacing="0" border="0" class="dTable mytasks" id="dynamic">
						<thead>
							<tr>
								<th style="background: #EEE;">Фото</th>
								<th style="background: #EEE;">Имя,Вид деятельности</th>
								<th style="background: #EEE;">Организация</th>
								<th style="background: #EEE;">Расположение</th>
								<th style="background: #EEE;">Действия</th>
							</tr>
						</thead>
						<tbody style="text-align: center;">
							<?php foreach ($this->user->partnerUsers as $partner): ?>
								<tr>
									<td class="center" style="vertical-align: middle;">
										<a href="/user/view/<?php echo $partner->partner->id; ?>" title="" class="lightbox">
											<img src="<?php echo ($partner->partner->profiles->avatar ? '/' . Yii::app()->params['files']['avatars'] . $partner->partner->id . '_s.jpg' : Yii::app()->params['imagesPath'] . 'userLogin3.png') ?>" alt="" style="vertical-align: middle;" />
										</a>
									</td>
									<td class="center" style="vertical-align: middle;">
										<a href="/user/view/<?php echo $partner->partner->id; ?>" title=""><?php echo $partner->partner->profiles->shortName(); ?></a><br/>
										(<?php echo $partner->partner->profiles->userType->name_ru; ?>)
									</td>
									<td class="center" style="vertical-align: middle;">
										<?php if (is_object($partner->partner->organizations)): ?>
											<?php echo $partner->partner->organizations->name_org; ?>
										<?php else: ?>
											<strong style="color:#932a2a;">Не указана</strong>
										<?php endif; ?>
									</td>
									<td class="center" style="vertical-align: middle;"><?php echo $partner->partner->profiles->locationString(); ?></td>
									<td style="vertical-align: middle;">
										<div class="btn-group">
											<a href="#" class="tablectrl_small bDefault" data-toggle="dropdown">
												<span class="iconb" data-icon="&#xe1f7;"></span>
											</a>
											<ul class="dropdown-menu pull-right">
												<li><a href="/user/messages/user/<?php echo $partner->partner->id; ?>#users_message" class=""><span class="icos-speech"></span>Написать сообщение</a></li>
												<li><a href="javascript:void(0);" class="remove-partner" data-id="<?php echo $partner->partner->id; ?>"><span class="icos-users2"></span>Удалить из партнеров</a></li>
											</ul>
										</div>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
						</table>
					</div>
				</div>
			</div>


	</div>
</div>