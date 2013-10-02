<?php
Yii::app()->clientScript->registerScriptFile('/js/files/partners.js', CClientScript::POS_BEGIN);

$this->pageTitle = Yii::app()->name . ' - Поиск пользователей';
$this->breadcrumbs = array(
	'current' =>  'Поиск пользователей',
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

    <!-- Main content -->
    <div class="wrapper">
		<?php $this->renderPartial('/blocks/_notify') ?>
		<?php $this->renderPartial('/blocks/_middleNavR') ?>

		<div id="partnerView" class="fluid grid12">
			<div class="widget grid12">
				<div class="whead"><h6>Список пользователей</h6><div class="clear"></div></div>
				<table cellpadding="0" cellspacing="0" width="100%" class="tDefault mytasks" style="text-align: center;">
					<thead>
						<tr>
							<td width="5%">Фото</td>
							<td>Имя</td>
							<td width="15%">Вид деятельности</td>
							<td width="15%">Организация</td>
							<td width="25%">Расположение</td>
							<td width="5%">Действие</td>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<td colspan="5">
								<div class="tPages" style="margin-right: 50px;">
									<?php
									$this->widget('CLinkPager', array(
										'header' => '', // пейджер без заголовка
										'maxButtonCount' => '10',
										'firstPageLabel' => '<<',
										'prevPageLabel' => '<',
										'nextPageLabel' => '>',
										'lastPageLabel' => '>>',
										'cssFile' => '/css/pager.css',
//										'class' => 'CLinkPager',
										'htmlOptions' => array(
											'class' => 'pages',
										),
										'pages' => $pages, // модель пагинации переданная во View
									));
									?>
								</div>
							</td>
						</tr>
					</tfoot>
					<tbody>
						<?php foreach ($profiles as $data): ?>
							<tr>
								<td>
									<a href="/user/view/<?php echo $data->id; ?>" title="" class="lightbox">
										<img src="<?php echo ($data->profiles->avatar ? '/' . Yii::app()->params['files']['avatars'] . $data->id . '_s.jpg' : Yii::app()->params['imagesPath'] . 'userLogin3.png') ?>" alt="" />
									</a>
								</td>
								<td style="text-align: left;">
									<a href="/user/view/<?php echo $data->id; ?>" title=""><?php echo $data->profiles->shortName(); ?></a>
									<?php if ($this->user->isPartner($data)): ?><a href=""><strong style="color:#4d7f12">(Ваш партнер)</strong></a><?php endif; ?>
								</td>
								<td align="center"><?php echo $data->profiles->userType->name_ru; ?></td>
								<td align="center">
									<?php if (is_object($data->organizations)): ?>
										<?php echo $data->organizations->name_org; ?>
									<?php else: ?>
										<strong style="color:#932a2a;">Не указана</strong>
									<?php endif; ?>
								</td>
								<td align="center"><?php echo $data->profiles->locationString(); ?></td>
								<td align="center" class="tableActs">
									<div class="btn-group">
										<a href="#" class="tablectrl_small bDefault" data-toggle="dropdown">
											<span class="iconb" data-icon="&#xe1f7;"></span>
										</a>
										<ul class="dropdown-menu pull-right">
											<li><a href="/user/messages/user/<?php echo $data->id; ?>#users_message" class=""><span class="icos-speech"></span>Написать сообщение</a></li>
											<?php
//																					echo '<pre>';
//																					print_r($this->user->partnerUsers[0]->id);
//																					echo '</pre>';
											?>
											<?php if (!$this->user->isPartner($data)): ?>
												<li><a href="javascript:void(0);" class="add-partner" data-id="<?php echo $data->id; ?>"><span class="icos-users2"></span>Добавить в партнеры</a></li>
											<?php else: ?>
												<li><a href="javascript:void(0);" class="remove-partner" data-id="<?php echo $data->id; ?>"><span class="icos-users2"></span>Удалить из партнеров</a></li>
											<?php endif; ?>
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
<!-- Content ends -->