<div class="widget" style="margin-right: 30px; width: 333px !important; min-width: 333px !important;">
	<div class="whead"><h6><?php echo $data->profiles->shortName(); ?></h6><div class="clear"></div></div>
	<div class="body">
		<img src="<?php echo ($data->profiles->avatar ? '/' . Yii::app()->params['files']['avatars'] . $data->id . '_s.jpg' : Yii::app()->params['imagesPath'] . 'userLogin3.png') ?>" />
		<?php echo $data->profiles->locationString(); ?>
	</div>
</div>
