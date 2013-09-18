<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
		<meta name="description" content="Сайт грузоперевозок." />
		<meta name="keywords" content="Грузоперевозки,Перевозка груза,Доставка груза,Доставка,Транспорт груза,Транспортировка груза,
			  Поиск груза,Фрахт,Фрахты,Отправка груза,Добавить груз,Разместить груз,Перевезти груз,Доставить груз,Найти груз,
			  Перевозка грузовым транспортом,Транспорт фурами,Фуры,Перевозка груза фурами,Фуры перевозка груза,Расчет расстояний,
			  Черный список,Ищу диспетчера, Ищу логистического оператора,Нужен диспетчер, Нужен логистический оператор, Экспедиция,Добавить транспорт,Разместить транспорт,Найти транспорт,Поиск транспорт,
			  Заявка на транспорт,Транспорт,Транспортировка,Перевозка ,Личный кабинет перевозчика,Личный кабинет диспетчера, Личный кабинет логистического оператора,
			  Личный кабинет грузоотправителя,Диспетчер, Логистический оператор, Диспетчерская,Диспетчера, Логистические операторы, Диспетчерские,Грузы для машин,Грузы для грузовых машин,Грузы для фур,
			  Грузоотправители,Междугородние перевозки,Междугородние грузовые перевозки,Международные грузовые перевозки,Международные перевозки,
			  Поиск груза и транспорта,Попутный транспорт,Попутный груз,Поиск попутного транспорта,Поиск попутного груза,Догруз,Свободный транспорт,
			  Груз,Грузы,Заявка на поиск транспорта,<?php echo $this->keywords ?>" />
        <title><?php echo $this->pageTitle ?></title>
		<link rel="shortcut icon" href="/images/favicon.ico" />
		<?php if (isset($this->mainPage) && $this->mainPage): ?>
			<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/main-style.css" rel="stylesheet" type="text/css" />
		<?php else: ?>
			<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/styles.css" rel="stylesheet" type="text/css" />
			<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/hopscotch-0.1.2.min.css" rel="stylesheet" type="text/css" />
		<?php endif; ?>
		<!--[if IE]> <link href="/css/ie.css" rel="stylesheet" type="text/css"> <![endif]-->
		<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
        <script type="text/javascript" src="/js/plugins/forms/ui.spinner.js"></script>
		<script type="text/javascript" src="/js/plugins/forms/jquery.mousewheel.js"></script>

		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.min.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery/jquery.ui.datepicker-ru.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery/jquery-ui-timepicker-addon.js"></script>
		<script type="text/javascript" src="/js/plugins/scrollup/jquery.scrollUp.min.js"></script>
		<script type="text/javascript" src="/js/plugins/tables/jquery.dataTables.js"></script>
		<script type="text/javascript" src="/js/plugins/forms/autogrowtextarea.js"></script>
		<script type="text/javascript" src="/js/plugins/forms/jquery.uniform.js"></script>
		<script type="text/javascript" src="/js/plugins/forms/jquery.tagsinput.min.js"></script>
		<script type="text/javascript" src="/js/plugins/forms/jquery.maskedinput.min.js"></script>
		<script type="text/javascript" src="/js/plugins/forms/jquery.autotab.js"></script>
		<script type="text/javascript" src="/js/plugins/forms/jquery.chosen.min.js"></script>
		<script type="text/javascript" src="/js/plugins/forms/jquery.ibutton.js"></script>
		<script type="text/javascript" src="/js/plugins/wizards/jquery.form.js"></script>
		<script type="text/javascript" src="/js/plugins/ui/jquery.collapsible.min.js"></script>
		<script type="text/javascript" src="/js/plugins/ui/jquery.tipsy.js"></script>
		<script type="text/javascript" src="/js/plugins/ui/jquery.progress.js"></script>
		<script type="text/javascript" src="/js/plugins/ui/jquery.jgrowl.js"></script>
		<script type="text/javascript" src="/js/plugins/ui/jquery.fancybox.js"></script>
		<script type="text/javascript" src="/js/plugins/others/jquery.fullcalendar.js"></script>
		<script type="text/javascript" src="/js/plugins/others/jquery.elfinder.js"></script>
		<script type="text/javascript" src="/js/plugins/ui/jquery.easytabs.min.js"></script>
		<script type="text/javascript" src="/js/jquery/jquery.blockUI.js"></script>
		<script type="text/javascript" src="/js/jquery/hopscotch-0.1.2.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/files/block.js"></script>
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

		<script type="text/javascript">

			/*var _gaq = _gaq || [];
			_gaq.push(['_setAccount', 'UA-35733336-1']);
			_gaq.push(['_trackPageview']);

			(function() {
			  var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			  ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			})();*/

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
	                <div id="left-block" class="left">
	                    <div class="light-grey width140">
	                        <p class="turquoise center">Мир Фрахты.com ориентирован на коммуникацию профессиональных перевозчиков и грузовладельцев.</p>
	                    </div>
	                </div>
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
					<a href="<?php echo isset($this->headerUrl)
					? $this->headerUrl : '/user'; ?>" title="" class="logo main"><img src="/images/logo_2.png" alt="frahts.com - Мир грузоперевозок!" /></a>
					<!-- Right top nav -->
					<div class="topNav">
						<?php if (Yii::app()->user->isGuest): ?>
							<a href="/main/login" class="buttonS bDefault mb10 mt5" style="margin-top: 10px; width:70px;text-align: center;">Вход</a>
							<a href="/main/register" class="buttonS bDefault mb10 mt5" style="margin-top: 10px; width:70px;text-align: center;">Регистрация</a>
						<?php else: ?>
							<ul class="userNav">
								<!--<li><a href="#" title="Поиск" class="search tipN" original-title="Поиск"></a></li>-->
								<li><a href="/user" title="Личный кабинет" class="profile tipN" original-title="Личный кабинет"></a></li>
								<?php if (isset($this->user->profiles) && $this->user->profiles): ?>
									<?php if ($this->user->profiles->user_type_id == 2 || $this->user->profiles->user_type_id == 3): ?>
										<li><a href="/goods/search" title="Мои грузы" class="box tipN" original-title="Мои грузы"></a></li>
									<?php endif; ?>
									<?php if ($this->user->profiles->user_type_id == 1 || $this->user->profiles->user_type_id == 3): ?>
										<li><a href="/vehicle/active" title="Мой транспорт" class="truck tipN" original-title="Мой транспорт"></a></li>
									<?php endif; ?>
						<?php endif; ?>
								<li><a href="/user/notes" title="Заметки" class="notes tipN" original-title="Заметки"></a></li>
								<li><a href="/user/feedback" title="Обратная связь" class="feedback tipN" original-title="Обратная связь"></a></li>
								<li><a href="/user/faq" title="ЧаВо" class="fuk tipN" original-title="ЧаВо"></a></li>
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

			<script type="text/javascript">
				_shcp = [];
				_shcp.push({widget_id : 629422, widget : "Chat", auth : "<?php echo $this->user->getInfoForChat(); ?>"});
				(function() { var hcc = document.createElement("script"); hcc.type = "text/javascript"; hcc.async = true;
					hcc.src = ("https:" == document.location.protocol ? "https" : "http")+"://widget.siteheart.com/apps/js/sh.js";
					var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(hcc, s.nextSibling); })();
			</script>
		<?php endif; ?>

		<!-- Yandex.Metrika counter -->
		<script type="text/javascript">
			/*(function (d, w, c) {
			(w[c] = w[c] || []).push(function() {
				try {
					w.yaCounter21031384 = new Ya.Metrika({id:21031384,
							webvisor:true,
							clickmap:true,
							trackLinks:true,
							accurateTrackBounce:true});
				} catch(e) { }
			});

			var n = d.getElementsByTagName("script")[0],
				s = d.createElement("script"),
				f = function () { n.parentNode.insertBefore(s, n); };
			s.type = "text/javascript";
			s.async = true;
			s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

			if (w.opera == "[object Opera]") {
				d.addEventListener("DOMContentLoaded", f, false);
			} else { f(); }
		})(document, window, "yandex_metrika_callbacks");*/
		</script>
		<noscript><div><img src="//mc.yandex.ru/watch/21031384" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
		<!-- /Yandex.Metrika counter -->
    </body>
</html>