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
						<?php foreach ($profiles->getData() as $data): ?>
							<tr>
								<td>
									<a href="/user/view/<?php echo $data->id; ?>" title="" class="lightbox">
										<img src="<?php echo ($data->profiles->avatar ? '/' . Yii::app()->params['files']['avatars'] . $data->id . '_s.jpg' : Yii::app()->params['imagesPath'] . 'userLogin3.png') ?>" alt="" />
									</a>
								</td>
								<td style="text-align: left;">
									<a href="/user/view/<?php echo $data->id; ?>" title=""><?php echo $data->profiles->shortName(); ?></a>
								</td>
								<td align="center"><?php echo $data->profiles->userType->name_ru; ?></td>
								<td align="center">
									<?php if (is_object($data->organizations)): ?>
										<?php echo $data->organizations->name_org; ?>
									<?php else: ?>
										<strong class="income">Не указана</strong>
									<?php endif; ?>
								</td>
								<td align="center"><?php echo $data->profiles->locationString(); ?></td>
								<td align="center" class="tableActs">
									<div class="btn-group">
										<a href="#" class="tablectrl_small bDefault" data-toggle="dropdown">
											<span class="iconb" data-icon="&#xe1f7;"></span>
										</a>
										<ul class="dropdown-menu pull-right">
											<li><a href="#" class=""><span class="icon-plus"></span>Написать сообщение</a></li>
											<li><a href="#" class=""><span class="icon-remove"></span>Remove</a></li>
											<li><a href="#" class=""><span class="icon-pen_alt2"></span>Edit</a></li>
											<li><a href="#" class=""><span class="icon-heart"></span>Do whatever you like</a></li>
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