<?php
$this->pageTitle = Yii::app()->name . ' - Отзывы, оставленные пользователями о Вас';
$this->breadcrumbs = array(
	'Отзывы',
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
    <!-- Breadcrumbs line -->
    <div class="breadLine">
        <div class="bc">
            <ul id="breadcrumbs" class="breadcrumbs">
                <li><a href="/">Главная</a></li>
                <li class="current"><a title="">Отзывы</a></li>
            </ul>
        </div>
    </div>
	<!-- Main content -->
    <div class="wrapper">
		<?php $this->renderPartial('/blocks/_notify') ?>
		<?php $this->renderPartial('/blocks/_middleNavR') ?>
		
		<?php if (count($this->user->reviewsReceiving)): ?>
		<div class="widget">
			<ul class="messagesTwo">
				<?php foreach ($this->user->reviewsReceiving as $review): ?>
					<li class="by_user">
						<a href="javascript:void(0)" title=""><img src="/images/<?php echo $review->rating == 1 ? 'positive.png' : 'negative.png'; ?>" /></a>
						<!--<div class="rating" style="display:inline-block; position:relative; left:10px; top:50px;">Оценка</div>-->
						<div class="messageArea">
							<div class="infoRow">
								<a href="/user/view/<?php echo $review->author->id ?>">
									<span class="name"><strong><?php echo $review->author->profiles->shortName(); ?></strong> написал(а):</span>
								</a>
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
			<strong>Пользователи еще не оставляли о Вас отзывы.</strong>
		<?php endif; ?>
	</div>
</div>