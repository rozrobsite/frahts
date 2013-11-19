<?php
class JokerController extends Controller
{
	public $jokerUser = null;
	public $jokerBreadcrumbs = array();
	
	public function __construct($id, $module = null)
	{
		parent::__construct($id, $module);
		
		$s_code = isset(Yii::app()->request->cookies['frahts_joker_user']->value) ? Yii::app()->request->cookies['frahts_joker_user']->value : '';

		if ($s_code && !$this->jokerUser)
		{
			Yii::app()->session['redirectUrl'] = Yii::app()->request->requestUri;
			$this->jokerUser = JokerUsers::model()->login($s_code);
		}
		else
		{
			unset(Yii::app()->session['redirectUrl']);
		}
	}
}
?>
