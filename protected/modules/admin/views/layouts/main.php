<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Фрахты.com - Административная панель</title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1">
		
		<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
		
<!--		<link rel="stylesheet" href="/css/admin/bootstrap.css">
		<link rel="stylesheet" href="/css/admin/bootstrap-responsive.css">-->
		<link rel="stylesheet" href="/css/admin/jquery.fancybox.css">
		<link rel="stylesheet" href="/css/admin/uniform.default.css">
		<!--<link rel="stylesheet" href="/css/admin/bootstrap.datepicker.css">-->
		<link rel="stylesheet" href="/css/admin/jquery.cleditor.css">
		<!--<link rel="stylesheet" href="/css/admin/jquery.plupload.queue.css">-->
		<link rel="stylesheet" href="/css/admin/jquery.tagsinput.css">
		<!--<link rel="stylesheet" href="/css/admin/jquery.ui.plupload.css">-->
		<!--<link rel="stylesheet" href="/css/admin/chosen.css">-->
		<link rel="stylesheet" href="/css/admin/chosen.css">
		<link rel="stylesheet" href="/css/admin/style.css">
	</head>
	<body>
		<div class="topbar">
			<div class="container-fluid">
				<a href="/admin/" class='company'>Фрахты.com - Административная панель</a>
				<ul class='mini'>
					<li class='dropdown dropdown-noclose supportContainer'>
						<a href="#" class='dropdown-toggle' data-toggle="dropdown">
							<img src="/images/admin/icons/fugue/book-question.png" alt="">
							Support tickets
							<span class="label label-warning">5</span>
						</a>
						<ul class="dropdown-menu pull-right custom custom-dark">
							<li class='custom'>
								<div class="title">
									What is the question?
									<span>Jul 22, 2012 by <a href="#" class='pover' data-title="Hover me" data-content="User information comes here">Hover me</a></span>
								</div>
								<div class="action">
									<div class="btn-group">
										<a href="#" class='tip btn btn-mini' title="Show ticket"><img src="/images/admin/icons/fugue/magnifier.png" alt=""></a>
										<a href="#" class='tip btn btn-mini' title="Delete ticket"><img src="/images/admin/icons/fugue/cross.png" alt=""></a>
									</div>
								</div>
							</li>
							<li class='custom'>
								<div class="title">
									How can i do this and that?
									<span>Jul 19, 2012 by <a href="#" class='pover' data-title="Username" data-content="User information comes here">Username</a></span>
								</div>
								<div class="action">
									<div class="btn-group">
										<a href="#" class='tip btn btn-mini' title="Show ticket"><img src="/images/admin/icons/fugue/magnifier.png" alt=""></a>
										<a href="#" class='tip btn btn-mini' title="Delete ticket"><img src="/images/admin/icons/fugue/cross.png" alt=""></a>
									</div>
								</div>
							</li>
							<li class='custom'>
								<div class="title">
									I want more support tickets!
									<span>Jul 19, 2012 by <a href="#" class='pover' data-title="Lorem" data-content="User information comes here">Lorem</a></span>
								</div>
								<div class="action">
									<div class="btn-group">
										<a href="#" class='tip btn btn-mini' title="Show ticket"><img src="/images/admin/icons/fugue/magnifier.png" alt=""></a>
										<a href="#" class='tip btn btn-mini' title="Delete ticket"><img src="/images/admin/icons/fugue/cross.png" alt=""></a>
									</div>
								</div>
							</li>
							<li class='custom custom-hidden'>
								<div class="title">
									This is a great feature, BUT...
									<span>Jul 18, 2012 by <a href="#" class='pover' data-title="Lorem" data-content="User information comes here">Ipsum</a></span>
								</div>
								<div class="action">
									<div class="btn-group">
										<a href="#" class='tip btn btn-mini' title="Show ticket"><img src="/images/admin/icons/fugue/magnifier.png" alt=""></a>
										<a href="#" class='tip btn btn-mini' title="Delete ticket"><img src="/images/admin/icons/fugue/cross.png" alt=""></a>
									</div>
								</div>
							</li>
							<li class='custom custom-hidden'>
								<div class="title">
									I want more colors! How?
									<span>Jul 16, 2012 by <a href="#" class='pover' data-title="Lorem" data-content="User information comes here">Lorem</a></span>
								</div>
								<div class="action">
									<div class="btn-group">
										<a href="#" class='tip btn btn-mini' title="Show ticket"><img src="/images/admin/icons/fugue/magnifier.png" alt=""></a>
										<a href="#" class='tip btn btn-mini' title="Delete ticket"><img src="/images/admin/icons/fugue/cross.png" alt=""></a>
									</div>
								</div>
							</li>
							<li class="custom">
								<div class="expand_custom">
									<a href="#">Show all support tickets</a>
								</div>
							</li>
						</ul>
					</li>
					<li class='dropdown pendingContainer'>
						<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
							<img src="/images/admin/icons/fugue/document-task.png" alt="">
							Pending orders
							<span class="label label-important">1</span>
						</a>
						<ul class="dropdown-menu pull-right custom custom-dark">
							<li class='custom'>
								<div class="title">
									Pending order #1 
									<span>Jul 22, 2012 by <a href="#" class='pover' data-title="Hover me" data-content="User information comes here">Hover me</a></span>
								</div>
								<div class="action">
									<div class="btn-group">
										<a href="#" class='tip btn btn-mini' title="Show order"><img src="/images/admin/icons/fugue/magnifier.png" alt=""></a>
										<a href="#" class='tip btn btn-mini' title="Delete order"><img src="/images/admin/icons/fugue/cross.png" alt=""></a>
									</div>
								</div>
							</li>
						</ul>
					</li>
					<li class='dropdown messageContainer'>
						<a href="#" class='dropdown-toggle' data-toggle='dropdown'>
							<img src="/images/admin/icons/fugue/balloons-white.png" alt="">
							Сообщения
							<span class="label label-info">3</span>
						</a>
						<ul class="dropdown-menu pull-right custom custom-dark">
							<li class='custom'>
								<div class="title">
									Hello, whats your name?
									<span>Jul 22, 2012 by <a href="#" class='pover' data-title="Hover me" data-content="User information comes here">Hover me</a></span>
								</div>
								<div class="action">
									<div class="btn-group">
										<a href="#" class='tip btn btn-mini' title="Show message"><img src="/images/admin/icons/fugue/magnifier.png" alt=""></a>
										<a href="#" class='tip btn btn-mini' title="Reply message"><img src="/images/admin/icons/fugue/mail-reply.png" alt=""></a>
									</div>
								</div>
							</li>
						</ul>
					</li>
					<li>
						<a href="#">
							<img src="/images/admin/icons/fugue/gear.png" alt="">
							Настройки
						</a>
					</li>
					<li>
						<a href="/admin/default/logout">
							<img src="/images/admin/icons/fugue/control-power.png" alt="">
							Выход
						</a>
					</li>
				</ul>
			</div>
		</div>
		<div class="breadcrumbs">
			<div class="container-fluid">
				<ul class="bread pull-left">
					<li>
						<a href="/admin/"><i class="icon-home icon-white"></i></a>
					</li>
					<?php foreach ($this->adminBreadcrumbs as $path => $breadcrumbs): ?>
					<li>
						<a href="<?php echo $path ?>">
							<?php echo $breadcrumbs ?>
						</a>
					</li>
					<?php endforeach; ?>
				</ul>

			</div>
		</div>
		<div class="main">
			<div class="navi">
				<ul class='main-nav'>
					<li class='active'>
						<a href="/admin/" class='light'>
							<div class="ico"><i class="icon-home icon-white"></i></div>
							Главная
							<!--<span class="label label-warning">10</span>-->
						</a>
					</li>
					<li>
						<a href="#" class='light toggle-collapsed'>
							<div class="ico"><i class="icon-th-large icon-white"></i></div>
							Населенные пункты
							<img src="/images/admin/toggle-subnav-down.png" alt="">
						</a>
						<ul class='collapsed-nav closed'>
							<li>
								<a href="/admin/location/countries">
									Страны
								</a>
							</li>
							<li>
								<a href="/admin/location/regions">
									Регионы
								</a>
							</li>
							<li>
								<a href="/admin/location/cities">
									Населенные пункты
								</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="#" class='light toggle-collapsed'>
							<div class="ico"><i class="icon-th-large icon-white"></i></div>
							Марки и модели
							<img src="/images/admin/toggle-subnav-down.png" alt="">
						</a>
						<ul class='collapsed-nav closed'>
							<li>
								<a href="/admin/brendvehicle/makes">
									Марки
								</a>
							</li>
							<li>
								<a href="/admin/brendvehicle/models">
									Модели
								</a>
							</li>
						</ul>
					</li>
<!--					<li>
						<a href="#" class='light toggle-collapsed'>
							<div class="ico"><i class="icon-th-large icon-white"></i></div>
							Новости
							<img src="/images/admin/toggle-subnav-down.png" alt="">
						</a>
						<ul class='collapsed-nav closed'>
							<li>
								<a href="/admin/news/add">
									Добавить новость
								</a>
							</li>
							<li>
								<a href="/admin/news/edit">
									Редактировать новости
								</a>
							</li>
						</ul>
					</li>-->
					<li>
						<a href="#" class='light toggle-collapsed'>
							<div class="ico"><i class="icon-th-large icon-white"></i></div>
							Документы
							<img src="/images/admin/toggle-subnav-down.png" alt="">
						</a>
						<ul class='collapsed-nav closed'>
							<li>
								<a href="/admin/docs/add">
									Добавить документ
								</a>
							</li>
							<li>
								<a href="/admin/docs/list">
									Список документов
								</a>
							</li>
						</ul>
					</li>
				</ul>
			</div>
			<?php echo $content; ?>
		</div>
		
<!--		<script src="/js/admin/less.js"></script>
		<script src="/js/admin/bootstrap.min.js"></script>
		<script src="/js/admin/jquery.peity.js"></script>
		<script src="/js/admin/jquery.uniform.min.js"></script>
		<script src="/js/admin/bootstrap.timepicker.js"></script>
		<script src="/js/admin/bootstrap.datepicker.js"></script>
		<script src="/js/admin/chosen.jquery.min.js"></script>
		<script src="/js/admin/jquery.fancybox.js"></script>-->
		<!--<script src="/js/admin/plupload/plupload.full.js"></script>-->
		<!--<script src="/js/admin/plupload/jquery.plupload.queue/jquery.plupload.queue.js"></script>-->
		<!--<script src="/js/admin/jquery.cleditor.min.js"></script>-->
		<!--<script src="/js/admin/jquery.inputmask.min.js"></script>-->
		<!--<script src="/js/admin/jquery.tagsinput.min.js"></script>-->
		<!--<script src="/js/admin/jquery.mousewheel.js"></script>-->
		<!--<script src="/js/admin/jquery.dataTables.min.js"></script>-->
		<!--<script src="/js/admin/jquery.dataTables.bootstrap.js"></script>-->
		<!--<script src="/js/admin/jquery.textareaCounter.plugin.js"></script>-->
		<script src="/js/admin/jquery.flot.js"></script>
		<!--<script src="/js/admin/jquery.color.js"></script>-->
		<script src="/js/admin/jquery.flot.resize.js"></script>
		<!--<script src="/js/admin/ui.spinner.js"></script>-->
		<script src="/js/admin/custom.js"></script>
		<script src="/js/admin/files/main.js"></script>
	</body>
</html>
