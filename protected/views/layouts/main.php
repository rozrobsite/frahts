<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
		<meta name="description" content="Сайт грузоперевозок." />
		<meta name="keywords" content="Грузоперевозки,Перевозка груза,Доставка груза,Доставка,Транспорт груза,Транспортировка груза,
			  Поиск груза,Фрахт,Фрахты,Отправка груза,Добавить груз,Разместить груз,Перевезти груз,Доставить груз,Найти груз,
			  Перевозка грузовым транспортом,Транспорт фурами,Фуры,Перевозка груза фурами,Фуры перевозка груза,Расчет расстояний,
			  Черный список,Ищу диспетчера,Нужен диспетчер,Экспедиция,Добавить транспорт,Разместить транспорт,Найти транспорт,Поиск транспорт,
			  Заявка на транспорт,Транспорт,Транспортировка,Перевозка ,Личный кабинет перевозчика,Личный кабинет диспетчера,
			  Личный кабинет грузоотправителя,Диспетчер,Диспетчерская,Диспетчера,Диспетчерские,Грузы для машин,Грузы для грузовых машин,Грузы для фур,
			  Грузоотправители,Междугородние перевозки,Междугородние грузовые перевозки,Международные грузовые перевозки,Международные перевозки,
			  Поиск груза и транспорта,Попутный транспорт,Попутный груз,Поиск попутного транспорта,Поиск попутного груза,Догруз,Свободный транспорт,
			  Груз,Грузы,Заявка на поиск транспорта,<?php echo $this->keywords ?>" />
        <title><?php echo $this->pageTitle ?></title>
		<link rel="shortcut icon" href="/images/favicon.ico" />
		<?php if (isset($this->mainPage) && $this->mainPage): ?>
			<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/main-style.css" rel="stylesheet" type="text/css" />
		<?php else: ?>
			<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/styles.css" rel="stylesheet" type="text/css" />
		<?php endif; ?>
		<!--[if IE]> <link href="/css/ie.css" rel="stylesheet" type="text/css"> <![endif]-->
		<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
        <script type="text/javascript" src="/js/plugins/forms/ui.spinner.js"></script>
		<script type="text/javascript" src="/js/plugins/forms/jquery.mousewheel.js"></script>

		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.min.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery/jquery.ui.datepicker-ru.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery/jquery-ui-timepicker-addon.js"></script>
		<!--<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery/jquery.ez-pinned-footer.js"></script>-->

<!--		<script type="text/javascript" src="/js/plugins/charts/excanvas.min.js"></script>
		<script type="text/javascript" src="/js/plugins/charts/jquery.flot.js"></script>
		<script type="text/javascript" src="/js/plugins/charts/jquery.flot.orderBars.js"></script>
		<script type="text/javascript" src="/js/plugins/charts/jquery.flot.pie.js"></script>
		<script type="text/javascript" src="/js/plugins/charts/jquery.flot.resize.js"></script>
		<script type="text/javascript" src="/js/plugins/charts/jquery.sparkline.min.js"></script>-->

		<script type="text/javascript" src="/js/plugins/scrollup/jquery.scrollUp.min.js"></script>
		<script type="text/javascript" src="/js/plugins/tables/jquery.dataTables.js"></script>
		<!--<script type="text/javascript" src="/js/plugins/tables/jquery.sortable.js"></script>-->
		<!--<script type="text/javascript" src="/js/plugins/tables/jquery.resizable.js"></script>-->

		<script type="text/javascript" src="/js/plugins/forms/autogrowtextarea.js"></script>
		<script type="text/javascript" src="/js/plugins/forms/jquery.uniform.js"></script>
		<!--<script type="text/javascript" src="/js/plugins/forms/jquery.inputlimiter.min.js"></script>-->
		<script type="text/javascript" src="/js/plugins/forms/jquery.tagsinput.min.js"></script>
		<script type="text/javascript" src="/js/plugins/forms/jquery.maskedinput.min.js"></script>
		<script type="text/javascript" src="/js/plugins/forms/jquery.autotab.js"></script>
		<script type="text/javascript" src="/js/plugins/forms/jquery.chosen.min.js"></script>
		<!--<script type="text/javascript" src="/js/plugins/forms/jquery.dualListBox.js"></script>-->
		<!--<script type="text/javascript" src="/js/plugins/forms/jquery.cleditor.js"></script>-->
		<script type="text/javascript" src="/js/plugins/forms/jquery.ibutton.js"></script>
		<!--<script type="text/javascript" src="/js/plugins/forms/jquery.validationEngine-en.js"></script>-->
		<!--<script type="text/javascript" src="/js/plugins/forms/jquery.validationEngine.js"></script>-->

<!--		<script type="text/javascript" src="/js/plugins/uploader/plupload.js"></script>
		<script type="text/javascript" src="/js/plugins/uploader/plupload.html4.js"></script>
		<script type="text/javascript" src="/js/plugins/uploader/plupload.html5.js"></script>
		<script type="text/javascript" src="/js/plugins/uploader/jquery.plupload.queue.js"></script>-->

<!--		<script type="text/javascript" src="/js/plugins/wizards/jquery.form.wizard.js"></script>
		<script type="text/javascript" src="/js/plugins/wizards/jquery.validate.js"></script>-->
		<script type="text/javascript" src="/js/plugins/wizards/jquery.form.js"></script>

		<script type="text/javascript" src="/js/plugins/ui/jquery.collapsible.min.js"></script>
		<!--<script type="text/javascript" src="/js/plugins/ui/jquery.breadcrumbs.js"></script>-->
		<script type="text/javascript" src="/js/plugins/ui/jquery.tipsy.js"></script>
		<script type="text/javascript" src="/js/plugins/ui/jquery.progress.js"></script>
		<!--<script type="text/javascript" src="/js/plugins/ui/jquery.timeentry.min.js"></script>-->
		<!--<script type="text/javascript" src="/js/plugins/ui/jquery.colorpicker.js"></script>-->
		<script type="text/javascript" src="/js/plugins/ui/jquery.jgrowl.js"></script>
		<script type="text/javascript" src="/js/plugins/ui/jquery.fancybox.js"></script>
		<!--<script type="text/javascript" src="/js/plugins/ui/jquery.fileTree.js"></script>-->
		<!--<script type="text/javascript" src="/js/plugins/ui/jquery.sourcerer.js"></script>-->

		<script type="text/javascript" src="/js/plugins/others/jquery.fullcalendar.js"></script>
		<script type="text/javascript" src="/js/plugins/others/jquery.elfinder.js"></script>

		<script type="text/javascript" src="/js/plugins/ui/jquery.easytabs.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/files/common.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/files/user.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/files/profile.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/files/vehicle.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/files/goods.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/files/bootstrap.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/files/login.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/files/vehicleSearch.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/files/functions.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/files/messages.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/files/notes.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/files/offers.js"></script>

		<style>
/*			#footer {
				background-color: #000;
				color: #fff;
				font-size: 12px;
				z-index: 1000;
				text-align: center;
			}*/
		</style>

		<script>
//			$(window).load(function() {
//				$("#footer").pinFooter();
//			});
//
//			$(window).resize(function() {
//				$("#footer").pinFooter();
//			});
		</script>
    </head>
    <body <?php if (isset($this->mainPage) && $this->mainPage): ?>class="main-body" <?php endif; ?>>
		<?php if (isset($this->mainPage) && $this->mainPage): ?>
			<img src="/images/bg.jpg" class="bg" />
			<div id="wrapper">
				<div id="header">
					<div id="logo">
						<a href="/">
							<img src="/images/main-logo.png" alt="ФРАХТЫ.com" width="91" height="52" />
						</a>
					</div>
					<div id="btn">
						<a href="/main/login" class="btn left">Вход</a>
						<a href="/main/register" class="btn left">Регистрация</a>
					</div>
					<div id="social">
						<div class="share42init" data-url="http://www.frahts.com" data-title="Фрахты.com - Мир грузоперевозок" data-description="Сайт грузоперевозок" data-image="http://gruz2.host5841.de1.dp10.ru/images/logo.png"></div>
						<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/share42/share42.js"></script>
					</div>
				</div>

				<?php echo $content; ?>
			</div>

			<div id="footer">
				<div id="block-text">
					<div class="text">МИР<br /> ГРУЗОПЕРЕВОЗОК <span>ФРАХТЫ</span>.com</div>
				</div>

				<div id="bottom-block">
					<div class="grey inline-block">
						<span class="num left">1</span>
						<span class="vertical-line left"></span>
						<p class="white"><span class="turquoise">Вы профессиональный перевозчик</span> и хотите иметь полную информацию о грузах для Ваших машин?</p>
					</div>

					<div class="grey inline-block">
						<span class="num left">2</span>
						<span class="vertical-line left"></span>
						<p class="white"><span class="turquoise">Вы грузовладелец</span> и хотите быть уверенны в качественной и своевременной перевозке Вашего груза?</p>
					</div>

					<div class="grey inline-block">
						<span class="num left">3</span>
						<span class="vertical-line left"></span>
						<p class="white"><span class="turquoise">Вы логистический оператор,</span> представляете интересы профессиональных грузоперевозчиков и грузоотправителей?</p>
					</div>
				</div>
				<div class="footer-text-container">
					<p class="footer-text turquoise">Фрахты.com созданы для ВАС!</p>
				</div>
			</div>
		<?php else: ?>
		<!-- Top line begins -->
			<div id="top">
				<div class="wrapper">
					<a href="/" title="" class="logo main"><img src="/images/logo_2.png" alt="frahts.com - Мир грузоперевозок!" /></a>
					<!-- Right top nav -->
					<div class="topNav">
						<?php if (Yii::app()->user->isGuest): ?>

							<a href="/main/login" class="buttonS bDefault mb10 mt5" style="margin-top: 10px; width:70px;text-align: center;">Вход</a>

							<a href="/main/register" class="buttonS bDefault mb10 mt5" style="margin-top: 10px; width:70px;text-align: center;">Регистрация</a>

						<?php else: ?>
							<ul class="userNav">
								<!--<li><a href="#" title="Поиск" class="search tipN" original-title="Поиск"></a></li>-->
								<li><a href="/user" title="Настройки пользователя" class="profile tipN" original-title="Настройки пользователя"></a></li>
								<?php if (isset($this->user->profiles) && $this->user->profiles): ?>
									<?php if ($this->user->profiles->user_type_id == 2 || $this->user->profiles->user_type_id == 3 ): ?>
										<li><a href="/goods/search" title="Мои грузы" class="box tipN" original-title="Мои грузы"></a></li>
									<?php endif; ?>
									<?php if ($this->user->profiles->user_type_id == 1 || $this->user->profiles->user_type_id == 3 ): ?>
										<li><a href="/vehicle/active" title="Мой транспорт" class="truck tipN" original-title="Мой транспорт"></a></li>
									<?php endif; ?>
								<?php endif; ?>
								<li><a href="/main/logout" title="Выход" class="logout tipN" original-title="Выход"></a></li>
							</ul>
						<?php endif; ?>
					</div>
					<div class="share42init" data-url="http://www.frahts.com" data-title="Фрахты.com - Мир грузоперевозок" data-description="Сайт грузоперевозок" data-image="http://gruz2.host5841.de1.dp10.ru/images/logo.png"></div>
					<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/share42/share42.js"></script>

					<div class="clear"></div>
				</div>
			</div>
			<!-- Top line ends -->
			<?php echo $content; ?>

			<?php /*
			<div id="footer" style="text-align: center; margin: 50px;">
				Все права защищены &copy; <?php echo date('Y', time()); ?>, <?php echo $_SERVER['HTTP_HOST'] ?>: Фрахты.com - Мир грузоперевозок

				<div class="clear"></div>
			</div>
			 */?>
		<?php endif; ?>
    </body>
</html>