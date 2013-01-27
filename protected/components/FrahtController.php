<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class FrahtController extends Controller
{
	public $user = null;
	public $pageName = 'Общая информация';
	public $is_access_search = false;
	
	public function __construct($id,$module=null)
	{
		parent::__construct($id,$module=null);
		
		if(Yii::app()->user->isGuest) $this->redirect ('/main/login');
		
		$this->user = Users::model()->findByPk(Yii::app()->user->id);
		
		$this->is_access_search = isset($this->user->profiles->id) && isset($this->user->organizations->id) && isset($this->user->vehicles);
	}
}