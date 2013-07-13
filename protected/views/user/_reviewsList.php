<div class="tab_container">
	<div id="tab_comments" class="tab_content" style="display: block;">
			<?php if ($canWrite): ?>
				<div class="enterMessage" style="margin-bottom: 15px;">
					<label style="margin-right: 5px;">Оставьте свой отзыв:</label>
					<a id="positive_review" href="javascript:void(0)" class="buttonS bGreen" data-rating="<?php echo Reviews::POSITIVE; ?>">Положительный</a>
					<a id="negative_review" href="javascript:void(0)" class="buttonS bRed" data-rating="<?php echo Reviews::NEGATIVE; ?>">Отрицательный</a>
				</div>
			<?php endif; ?>
			<?php if (count($model->reviewsReceiving)): ?>
				<div id="reviewsList" class="widget reviewsList">
					<ul class="messagesTwo">
						<?php foreach ($model->reviewsReceiving as $review): ?>
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
				</div>
			<?php else: ?>
				<strong class="reviewsList">Пользователи еще не оставляли отзывов.</strong>
			<?php endif; ?>
		</div>


	</div>