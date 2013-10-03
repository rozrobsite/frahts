<?php
/* @var $this UserController */
/* @var $model Users */

$this->pageTitle = Yii::app()->name . ' - Заметки пользователя';
$this->breadcrumbs = array(
	'current' => 'Заметки пользователя',
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