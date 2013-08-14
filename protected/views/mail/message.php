Здравствуйте!<br/><br/>
Пользователь <?php echo $model->author->profiles->fullName() ?> оставил(а) Вам сообщение:<br/>
<blockquote>
	<p style="font-style: italic">
		<?php echo $model->message; ?>
	</p>
</blockquote>
Чтобы ответить на это сообщение перейдите по <a target="_blank" href="<?php echo Yii::app()->request->hostInfo . '/user/messages/user/' . $model->author->id . '#users_message'?>">этой ссылке</a>.<br/><br/>
Просмотреть все сообщения которые оставили Вам пользователи можна на странице <a href="<?php echo Yii::app()->request->hostInfo; ?>/user/messages#users_message">Сообщения</a>
<br/><br/>
Если у Вас возникли какие-либо вопросы по нашему сервису, обратитесь к администрации сайта <a href="<?php echo Yii::app()->params['fullSiteName']; ?>">www.frahts.com</a>: <a href="mailto:support@frahts.com">support@frahts.com</a>
<br/><br/>
С Уважением,<br/>
Администрация сайта <a href="<?php echo Yii::app()->params['fullSiteName']; ?>">www.frahts.com</a>
