<?php
Yii::app()->clientScript->registerScriptFile('/js/files/partners.js', CClientScript::POS_BEGIN);

$this->pageTitle = Yii::app()->name . ' - Партнеры';
$this->breadcrumbs = array(
	'Партнеры',
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
                <li class="current"><a title="">Партнеры</a></li>
            </ul>
        </div>
    </div>

    <!-- Main content -->
    <div class="wrapper">
		<?php $this->renderPartial('/blocks/_notify') ?>
		<?php $this->renderPartial('/blocks/_middleNavR') ?>

		<div class="fluid">
			<div class="widget grid12">
				<div class="whead"><h6>Список пользователей</h6><div class="clear"></div></div>
					<div id="dyn" class="hiddenpars">
						<table cellpadding="0" cellspacing="0" border="0" class="dTable" id="searchUsersResult">
						<thead>
							<tr>
								<th></th>
								<th>Имя</th>
								<th style="background: #EEE;">Организация</th>
								<th>Расположение</th>
								<th style="background: #EEE;">Действия</th>
							</tr>
						</thead>
						<tbody style="text-align: center;">
							<?php foreach ($profiles as $profile): ?>
							<?php
//										echo '<pre>';
//										print_r($profile->user->id);
//										echo '</pre>';die();
							?>
							<tr class="gradeX">
								<td>
									<a href="/user/view/<?php echo $profile->user->id ?>" title="">
										<img src="<?php echo ($profile->avatar ? '/' . Yii::app()->params['files']['avatars'] . $profile->user->id . '_s.jpg' : Yii::app()->params['imagesPath'] . 'userLogin3.png'); ?>" alt="" />
									</a>
								</td>
								<td>
									<a href="/user/view/<?php echo $profile->user->id ?>" title=""><?php echo $profile->shortName(); ?></a>
								</td>
								<td>
									<?php echo isset($profile->user->organizations) && $profile->user->organizations ? $profile->user->organizations->name_org : 'Нет данных'; ?>
								</td>
								<td class="center">
									<?php echo $profile->locationString(); ?>
								</td>
								<td class="center">
									<div class="btn-group">
                                        <a href="#" class="tablectrl_small bDefault" data-toggle="dropdown">
                                            <span class="iconb" data-icon="&#xe1f7;"></span>
                                        </a>
                                        <ul class="dropdown-menu pull-right">
                                            <li><a href="#" class=""><span class="icon-plus"></span>Add</a></li>
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
</div>
<!-- Content ends -->