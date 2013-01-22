<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
		<title>Мир грузоперевозок - Ошибка 404</title>

		<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/styles.css" rel="stylesheet" type="text/css" />
		<!--[if IE]> <link href="css/ie.css" rel="stylesheet" type="text/css"> <![endif]-->

	</head>
	<body>
		<!-- Top line begins -->
		<div id="top">
			<div class="wrapper">
				<a href="/" title="" class="logo main"><img src="/images/logo.png" alt="" /></a>

				<div class="clear"></div>
			</div>
		</div>
		<!-- Top line ends -->

		<!-- Main content wrapper begins -->
		<div class="errorWrapper">
			<div class="errorWrapper">
				<span class="errorNum">404</span>
				<div class="errorContent">
					<span class="errorDesc">
						<span class="icon-warning"></span>
						<?php if ($error=Yii::app()->errorHandler->error) echo $error['message']; else 'Страница не найдена.' ?>
					</span>
					<div class="fluid">
						<a href="/" title="" class="buttonM bLightBlue grid6">На главную</a>
						<a href="<?php echo Yii::app()->user->returnUrl ?>" title="" class="buttonM bRed grid6">Назад</a>
					</div>
				</div>
			</div>    
		</div>    
		<!-- Main content wrapper ends -->
	</body>
</html>
