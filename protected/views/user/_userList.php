<?php if (count($receivingUsers)): ?>
	<ul class="userList">
		<?php foreach ($receivingUsers as $user): ?>
		<?php if (!isset($user->id) || $user->id == $this->user->id) continue; ?>
		<li>
			<a href="/user/messages/user/<?php echo $user->id ?>#users_message" title="">
				<img src="<?php echo ($user->profiles->avatar ? '/' . Yii::app()->params['files']['avatars'] . $user->id . '_s.jpg' : Yii::app()->params['imagesPath'] . 'userLogin3.png'); ?>" alt="" />
				<span class="contactName">
					<strong><?php echo $user->profiles->shortName(); ?></strong>
					<i><?php echo $user->profiles->userType->name_ru; ?></i>
				</span>
				<?php $status = $receivingUser && $receivingUser->id == $user->id ? 'status_available' : 'status_off'; ?>
				<span class="<?php echo $status; ?>"></span>
				<span class="clear"></span>
			</a>
		</li>
		<?php endforeach; ?>
	</ul>
<?php else: ?>
	<strong style="margin-left: 10px">Пользователи не найдены</strong>
<?php endif; ?>