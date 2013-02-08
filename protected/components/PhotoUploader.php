<?php
/**
 * PhotoUploader class file.
 */

class PhotoUploader extends CInputWidget
{
	/**
	 * @var TbActiveForm
	 */
	public $form;
	public $relation;
	public $withFields = false;
	/**
	 * @var string Suffix for element names (need if you have few fields on the form)
	 */
	public $suffix = '_default';

	public function init()
	{
	}

	public function run()
	{
		echo $this->render('photoUploader');
	}
}