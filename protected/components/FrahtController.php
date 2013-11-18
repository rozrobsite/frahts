<?php/** * Controller is the customized base controller class. * All controller classes for this application should extend from this base class. */class FrahtController extends Controller {	public $pageName = 'Общая информация';	public $is_access_search = false;	public $messagesCount = 0;	public $notesCount = 0;	public $headerUrl = '/user';	public $userInfoForChat = array();//	public $newOffersCount = 0;	public function __construct($id, $module = null) {		parent::__construct($id, $module = null);		if (Yii::app()->user->isGuest)			Yii::app()->session['redirectUrl'] = Yii::app()->request->requestUri;		else			unset(Yii::app()->session['redirectUrl']);		if (Yii::app()->user->isGuest)			$this->redirect('/main/login');		$this->user = Users::model()->findByPk(Yii::app()->user->id);//		$this->userInfoForChat = $this->initUserForChat();		$this->is_access_search = isset($this->user->profiles->id) && isset($this->user->organizations->id);		$this->messagesCount = Messages::model()->count('receiving_user_id = ' . $this->user->id . ' AND is_deleted = 0 AND is_view = 0');		$this->notesCount = Notes::model()->count('user_id = ' . $this->user->id . ' AND is_show = 0 AND start >= CURDATE() AND start <= DATE_ADD(CURDATE(), INTERVAL 1 DAY)');		if (!$this->user->profiles && !$this->user->organizations)			Yii::app()->user->setFlash('_default', 'Для полноценной работы с сайтом обязательно введите Ваши <a href=\'/user\' style=\'color:#5895C0\'>личные данные</a> и данные о Вашей <a href=\'/user#organization\' style=\'color:#5895C0\'>организации</a>.');		elseif (!$this->user->profiles)			Yii::app()->user->setFlash('_default', 'Для полноценной работы с сайтом обязательно введите Ваши <a href=\'/user\' style=\'color:#5895C0\'>личные данные</a>.');		elseif (!$this->user->organizations)			Yii::app()->user->setFlash('_default', 'Для полноценной работы с сайтом обязательно введите данные о Вашей <a href=\'/user#organization\' style=\'color:#5895C0\'>организации</a>.');		if ($this->user->profiles)		{			if ($this->user->profiles->userType->id == UserTypes::FREIGHTER)				$this->headerUrl = '/goods/search';			if ($this->user->profiles->userType->id == UserTypes::SHIPPER)				$this->headerUrl = '/vehicle/search';			if ($this->user->profiles->userType->id == UserTypes::DISPATCHER) {				if (isset($this->user) && count($this->user->vehicles) >= count($this->user->goods))					$this->headerUrl = '/goods/search';				else					$this->headerUrl = '/vehicle/search';			}		}	}//	private function initUserForChat() {//		$avatar = isset($this->user->profiles) && $this->user->profiles ? '/' . Yii::app()->params['files']['avatars'] . $this->user->id . '_s.jpg' : '';//		$name = isset($this->user->profiles) && $this->user->profiles ? $this->user->profiles->fullName() : 'Без профайла';//		$userType = isset($this->user->profiles) && $this->user->profiles ? $this->user->profiles->userType->name_ru : 'Неизвестно';////		$user = array(//			'nick' => $this->user->username,//			'avatar' => $avatar,//			'id' => $this->user->id,//			'email' => $this->user->email,//			'data' => array("username" => $name, 'usertype' => $userType)//		);////		$time = time();//		$secret = YII_DEBUG ? Yii::app()->params['chat']['key']['test'] : Yii::app()->params['chat']['key']['product'];//		$user_base64 = base64_encode(json_encode($user));//		$sign = md5($secret . $user_base64 . $time);////		return $user_base64 . "_" . $time . "_" . $sign;//	}}