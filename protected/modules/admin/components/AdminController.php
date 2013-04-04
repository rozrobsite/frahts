<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdminController
 *
 * @author Gennadiy
 */
class AdminController extends Controller
{
	public $adminUser = null;
	public $adminBreadcrumbs = array();
	public $users = null;
	public $freighter = null;
	public $shipper = null;
	public $dispatcher = null;
	public $vehicles = null;
	public $goods = null;
	
	public function __construct($id, $module = null)
	{
		parent::__construct($id, $module);
		
		$this->users = Users::model()->count('code = ""');
		$this->freighter = Profiles::model()->count('user_type_id = ' . UserTypes::FREIGHTER);
		$this->shipper = Profiles::model()->count('user_type_id = ' . UserTypes::SHIPPER);
		$this->dispatcher = Profiles::model()->count('user_type_id = ' . UserTypes::DISPATCHER);
		$this->vehicles = Vehicle::model()->count();
		$this->goods = Goods::model()->count();
	}
}
?>
