<?php
/* @var $this UserController */
/* @var $model Users */

$this->pageTitle = Yii::app()->name . ' - Заметки пользователя';
$this->breadcrumbs = array(
	'Заметки пользователя',
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
                <li class="current"><a title="">Заметки пользователя</a></li>
            </ul>
        </div>
    </div>

    <!-- Main content -->
    <div class="wrapper">
		<?php $this->renderPartial('/blocks/_notify') ?>
		<?php $this->renderPartial('/blocks/_middleNavR') ?>
		<!-- Calendar -->
        <div class="widget">
            <div class="whead">
				<h6>Календарь</h6>
				<div class="clear"></div>
			</div>
            <div id="calendar"></div>
        </div>
    </div>
</div>
<?php $this->renderPartial('/blocks/popups/_notes'); ?>
<!-- Content ends -->