<div class="secTop">
	<div class="balance">
		<div class="balInfo">Баланс:<span><?php echo Yii::app()->dateFormatter->format('dd MMM yyyy', time()); ?></span></div>
		<div class="balAmount">
			<span class="tipN" original-title="Специальная единица сайта"><?php echo $this->user->balance ?> фрахтов</span>
		</div>
	</div>
</div>