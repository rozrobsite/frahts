<?php
$this->pageTitle = Yii::app()->name . ' - Предложения';

$this->breadcrumbs=array(
	'current' => 'Предложения',
);
?>
<!-- Sidebar begins -->
<div id="sidebar">
	<?php $this->renderPartial('/blocks/mainNav') ?>
    <!-- Secondary nav -->
    <div class="secNav">
		<?php
		$this->renderPartial('_secWrapper', array());
		?>
	</div>
</div>
<!-- Sidebar ends -->
<div id="content">
	<?php $this->renderPartial('/blocks/contentTop') ?>

	<div class="wrapper">
		<?php $this->renderPartial('/blocks/_notify') ?>
		<?php $this->renderPartial('/blocks/_middleNavR') ?>

		<div class="widget grid12">
			<ul class="tabs">
				<li><a href="#tabb1">Ваши предложения</a></li>
				<li><a href="#tabb2">Вам предлагают <?php if ($newOffersCount): ?><span style="color: #934848;">(+<?php echo $newOffersCount; ?>)</span><?php endif; ?></a></li>
			</ul>

			<div class="tab_container">
				<div id="tabb1" class="tab_content">
					<?php $this->renderPartial('_userOffers', array('userOffers' => $userOffers)); ?>
				</div>
				<div id="tabb2" class="tab_content">
					<?php $this->renderPartial('_forUserOffers', array('forUserOffers' => $forUserOffers)); ?>
				</div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
</div>
