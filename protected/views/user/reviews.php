<?php
$this->pageTitle = Yii::app()->name . ' - Отзывы, оставленные пользователями о Вас';
$this->breadcrumbs = array(
	'current' => 'Отзывы',
);
?>
<!-- Sidebar begins -->
<div id="sidebar">
	<?php $this->renderPartial('/blocks/mainNav') ?>
    <!-- Secondary nav -->
    <div class="secNav">
		<?php
		$this->renderPartial('_secWrapper', array(
			'selectReviews' => true,
			'receivingUser' => isset($receivingUser) ? $receivingUser : null,
			'receivingUsers' => $receivingUsers,))
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

		<?php if (count($this->user->reviewsReceiving)): ?>
		<div class="widget">
			<ul class="messagesTwo">
				<?php foreach ($this->user->reviewsReceiving as $review): ?>
					<li class="by_user">
						<a href="javascript:void(0)" title=""><img src="/images/<?php echo $review->rating == Reviews::POSITIVE ? 'positive.png' : 'negative.png'; ?>" /></a>
						<!--<div class="rating" style="display:inline-block; position:relative; left:10px; top:50px;">Оценка</div>-->
						<div class="messageArea">
							<div class="infoRow">
								<span class="name">
									<a href="/user/view/<?php echo $review->author->id ?>">
										<strong>
											<?php echo $review->author->profiles->shortName(); ?>
										</strong>
									</a>
									написал(а):
								</span>
								<span class="time"><?php echo Yii::app()->dateFormatter->format('dd MMMM yyyy HH:mm', $review->created_at); ?></span>
								<div class="clear"></div>
							</div>
							<?php echo $review->text; ?>
						</div>
						<div class="clear"></div>
					</li>
				<?php endforeach; ?>
			</ul>
			<div class="clear"></div>
		</div>
		<?php else: ?>
			<strong style="margin-top: 20px;">Пользователи еще не оставляли о Вас отзывы.</strong>
		<?php endif; ?>
	</div>
</div>