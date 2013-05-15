<?php
/* @var $this UserController */
/* @var $model Users */

$this->pageTitle = Yii::app()->name . ' - Настройки пользователя (Сотрудники)';
$this->breadcrumbs = array(
	'Настройки пользователя (Сотрудники)',
);
?>
<!-- Sidebar begins -->
<div id="sidebar">
	<?php $this->renderPartial('/blocks/mainNav') ?>
    <!-- Secondary nav -->
    <div class="secNav">
		<?php $this->renderPartial('_secWrapper', array('selectEmployee' => true)) ?>
	</div>
</div>
<!-- Sidebar ends -->