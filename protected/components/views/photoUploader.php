<?php require 'uploader.php'; ?>

<?php echo $this->form->labelEx($this->model, $this->attribute); ?>
<?php echo $this->form->hiddenField($this->model, $this->attribute, array('class' => 'photo-uploader-id')); ?>

<?php
$modelClass = get_class($this->model);
$this->widget('ext.eajaxupload.EAjaxUpload', array(
	'id' => 'photo_uploader'.$this->suffix,
	'config' => array(
		'action' => Yii::app()->createUrl('/vehicle/addphoto'),
		'allowedExtensions' => Yii::app()->params['images']['allowedExtensions'], //array("jpg","jpeg","gif","exe","mov" and etc...
		'sizeLimit' => Yii::app()->params['images']['sizeLimit'], // maximum file size in bytes
		'acceptFiles' => 'image/*',
		'template' => $uploader_defaults['template'],
		'classes' => $uploader_defaults['classes'],
		'callbacks' => array(
			'onComplete' => "js:function(id, fileName, responseJSON) {
				if (responseJSON.success) {
					$('#".$modelClass."_".$this->attribute."').val(responseJSON.photoId);
					$('.qq-upload-list', $(this._element)).empty();
					$('.main_photo".$this->suffix."')
						.attr('href', responseJSON.photoUrl).show()
						.find('img').attr('src', responseJSON.thumbUrl);
					$('#".$modelClass."-photo-uploader-info".$this->suffix."').show();
				}
			}"
		),
		'showMessage' => $uploader_defaults['showMessage'],
		'messages' => $uploader_defaults['messages'],
		'text' => $uploader_defaults['text'],
	)
));
?>

<a href="<?php if($this->model->{$this->relation}) echo $this->model->{$this->relation}->getUrl(); ?>" target="_blank" class="main_photo main_photo<?php print $this->suffix; ?>" title="Увеличить"<?php if(!$this->model->{$this->relation}) echo 'style="display:none"'?>>
	<img src="<?php if($this->model->{$this->relation}) echo $this->model->{$this->relation}->getResizedUrl(200, 200, Photos::MODE_EXACT); ?>" alt="">
</a>

<?php
$photo = $this->model->{$this->relation};

if ($this->withFields) : ?>
<div id="<?php echo $modelClass; ?>-photo-uploader-info<?php print $this->suffix; ?>" <?php echo !$photo ? 'style="display: none;"' : ''; ?>>
	<?php echo CHtml::hiddenField($modelClass.'_photo_uploader_relation', $this->relation); ?>

	<?php echo CHtml::label('Название', 'photo_uploader_title'); ?>
	<?php echo CHtml::textField($modelClass.'_photo_uploader_title', isset($_POST[$modelClass.'_photo_uploader_title']) ? $_POST[$modelClass.'_photo_uploader_title'] : ($photo ? $photo->title : '')); ?>
    <?php echo $photo ? CHtml::error($photo, 'title') : '';?>


	<?php echo CHtml::label('Источник', 'photo_uploader_source'); ?>
	<?php echo CHtml::textField($modelClass.'_photo_uploader_source', isset($_POST[$modelClass.'_photo_uploader_source']) ? $_POST[$modelClass.'_photo_uploader_source'] : ($photo ? $photo->source : '')); ?>
    <?php echo $photo ? CHtml::error($photo, 'source') : '';?>

</div>
<?php endif; ?>