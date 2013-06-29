<?php
/* @var $this UserController */
/* @var $model Users */

$this->pageTitle = Yii::app()->name . ' - Сообщения от пользователей';
$this->breadcrumbs = array(
	'Сообщения от пользователей',
);
?>

<!-- Sidebar begins -->
<div id="sidebar">
	<?php $this->renderPartial('/blocks/mainNav') ?>
    <!-- Secondary nav -->
    <div class="secNav">
		<?php
		$this->renderPartial('_secWrapper', array(
			'selectProfile' => false,
			'receivingUser' => isset($receivingUser) ? $receivingUser : null,
			'receivingUsers' => $receivingUsers,
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
                <li class="current"><a title="">Сообщения от пользователей</a></li>
            </ul>
        </div>
    </div>

    <!-- Main content -->
    <div class="wrapper">
		<?php $this->renderPartial('/blocks/_notify') ?>
		<?php $this->renderPartial('/blocks/_middleNavR') ?>
		
		<?php if ($receivingUser): ?>
			<div class="enterMessage">
				<input id="enterMessage" type="text" name="enterMessage" placeholder="Напишите сообщение..." data-receiving-id="<?php echo $receivingUser->id ?>" />
				<div class="sendBtn">
					<input id="sendMessage" type="submit" name="sendMessage" class="buttonS bLightBlue" value="Добавить" />
				</div>
			</div>
		<?php endif; ?>

		<div id="usersMessages">
			<?php if (!count($models)): ?>
				<div class="fluid" style="text-align: center;margin-top: 50px;">
					<label style="font-weight: bold; font-size: 16px;">
						Сообщения отсутствуют.
					</label>
				</div>
			<?php else: ?>
				<div class="widget">
					<div class="whead">
						<h6>Сообщения от пользователей</h6>
						<div class="on_off">
							<ul class="navi nav-pills">
								<li class="dropdown">
									<img id="messagesLoader" src="/images/elements/loaders/10s.gif" style="float: left; margin: 2px 15px 0 0;display: none" alt="" />
									<span id="messagesUpdate" class="icon-reload-CW tipS" title="Обновить" style="margin-right: 15px; cursor: pointer;"></span>
									<a class="dropdown-toggle" data-toggle="dropdown">Показать сообщения<b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li><a href="/user/messages/<?php if ($receivingUser) echo 'user/' . $receivingUser->id . '/'; ?>type/<?php echo Messages::TYPE_LAST ?>#users_message">Последние</a></li>
										<li><a href="/user/messages/<?php if ($receivingUser) echo 'user/' . $receivingUser->id . '/'; ?>type/<?php echo Messages::TYPE_WEEK ?>#users_message">За неделю</a></li>
										<li><a href="/user/messages/<?php if ($receivingUser) echo 'user/' . $receivingUser->id . '/'; ?>type/<?php echo Messages::TYPE_MONTH ?>#users_message">За месяц</a></li>
										<li><a href="/user/messages/<?php if ($receivingUser) echo 'user/' . $receivingUser->id . '/'; ?>type/<?php echo Messages::TYPE_3_MONTH ?>#users_message">За 3 месяца</a></li>
									</ul>
								</li>
							</ul>

						</div>
						<div class="clear"></div>
					</div>
					<ul class="messagesTwo">
						<?php foreach ($models as $model): ?>
							<li class="<?php echo $this->user->id == $model->author->id ? 'by_user' : 'by_me'; ?> message_<?php echo $model->id; ?>">
								<a href="javascript:void(0)" title="Перейти на страницу пользователя">
									<img src="<?php echo ($model->author->profiles->avatar ? '/' . Yii::app()->params['files']['avatars'] . $model->author->id . '_s.jpg' : Yii::app()->params['imagesPath'] . 'userLogin3.png'); ?>" 
										 alt="<?php echo $model->author->profiles->fullName(); ?>" />
								</a>
								<div class="messageArea">
									<div class="infoRow">
										<span class="name"><strong><?php echo $model->author->profiles->shortName(); ?></strong> написал(а) <?php if (!$receivingUser): ?> для <strong><?php echo $model->receivingUser->profiles->shortName(); ?></strong><?php endif; ?>:</span>
										<a href="javascript:void(0);" style="margin-left: 30px" class="tipS message-remove message_remove_open" title="Удалить" data-message-id="<?php echo $model->id ?>"><img src="/images/elements/other/fileError.png" /></a>
										<span class="time"><?php echo Yii::app()->dateFormatter->format('dd MMMM yyyy HH:mm', $model->created_at); ?></span>
										<div class="clear"></div>
									</div>
									<?php echo $model->message; ?>
								</div>
								<div class="clear"></div>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php endif; ?>
		</div>
    </div>
</div>
<?php $this->renderPartial('/blocks/popups/_messageRemove'); ?>
<!-- Content ends -->