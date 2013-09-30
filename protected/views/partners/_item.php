<li>
	<a href="javascript:void(0);" title="" style="font-size: 11px;">
		<img src="<?php echo ($data->profiles->avatar ? '/' . Yii::app()->params['files']['avatars'] . $data->id . '_s.jpg' : Yii::app()->params['imagesPath'] . 'userLogin3.png') ?>" alt="" />
		<span class="contactName">
			<strong><?php echo $data->profiles->shortName(); ?></strong>
			<?php if (is_object($data->organizations)): ?>
				<i style="color: #b35d5d;"><?php echo $data->organizations->name_org; ?></i>
			<?php endif; ?>
		</span>
		<span>
			<?php echo $data->profiles->userType->name_ru; ?>
		</span><br/>
		<span>
			<i><?php echo $data->profiles->locationString(); ?></i>
		</span>
		<span class="clear"></span>
	</a>
</li>
