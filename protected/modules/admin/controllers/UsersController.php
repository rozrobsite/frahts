<?php

class UsersController extends AdminController
{
	public function __construct($id, $module = null)
	{
		parent::__construct($id, $module);
	}

	public function actionAddAll()
	{
		$type = isset($_POST['type']) ? (int)$_POST['type'] : 0;

		switch($type)
		{
			case Users::ADD_ALL_USERS:
				return $this->getAll();
			case Users::ADD_USERS_WITHOUT_PROFILES:
				return $this->getWithProfiles(false);
			case Users::ADD_USERS_WITH_PROFILES:
				return $this->getWithProfiles(true);
			case Users::ADD_USERS_WITHOUT_GOOD:
				return $this->getWithoutGood();
			case Users::ADD_USERS_WITHOUT_VEHICLE:
				return $this->getWithoutVehicles();
			case Users::ADD_USERS_WITHOUT_VEHICLE_AND_GOOD:
				return $this->getWithoutGoodVehicles();
			case Users::ADD_USERS_FREIGHTER:
				return $this->getFreighters();
			case Users::ADD_USERS_SHIPPER:
				return $this->getShippers();
			case Users::ADD_USERS_DISPATCHER:
				return $this->getDispatchers();
			case Users::ADD_USERS_WITH_GOOD:
				return $this->getFreightersWithGood();
			case Users::ADD_USERS_WITH_VEHICLE:
				return $this->getShippersWithVehicle();
			case Users::ADD_USERS_DISPATCHER_WITH_GOOD:
				return $this->getDispatchersWithGood();
			case Users::ADD_USERS_DISPATCHER_WITH_VEHICLE:
				return $this->getDispatchersWithVehicle();
			case Users::ADD_USERS_DISPATCHER_WITH_GOOD_AND_VEHICLE:
				return $this->getDispatchersWithGoodVehicle();
		}
	}

	private function getAll()
	{
		$users = CHtml::listData(Users::model()->findAll(), 'id', 'email');

		return $this->respondJSON(array(
			'users' => join("\r\n", array_values($users)),
			'count' => count($users)
		));
	}

	private function getWithProfiles($withProfiles)
	{
		$users = Users::model()->findAll();

		$result = array();
		foreach ($users as $user) {
			if ($withProfiles)
			{
				if ($user->profiles)
					$result[] = $user->email;
			}
			else
			{
				if (!$user->profiles)
					$result[] = $user->email;
			}
		}

		return $this->respondJSON(array(
			'users' => join("\r\n", $result),
			'count' => count($result)
		));
	}

	private function getWithoutGood()
	{
		$users = Users::model()->findAll();

		$result = array();
		foreach ($users as $user) {
			if ($user->profiles && $user->profiles->userType->id == UserTypes::FREIGHTER && !$user->goods)
				$result[] = $user->email;
		}

		return $this->respondJSON(array(
			'users' => join("\r\n", $result),
			'count' => count($result)
		));
	}

	private function getWithoutVehicles()
	{
		$users = Users::model()->findAll();

		$result = array();
		foreach ($users as $user) {
			if ($user->profiles && $user->profiles->userType->id == UserTypes::SHIPPER && !$user->vehicles)
				$result[] = $user->email;
		}

		return $this->respondJSON(array(
			'users' => join("\r\n", $result),
			'count' => count($result)
		));
	}

	private function getWithoutGoodVehicles()
	{
		$users = Users::model()->findAll();

		$result = array();
		foreach ($users as $user) {
			if ($user->profiles && $user->profiles->userType->id == UserTypes::DISPATCHER && !$user->vehicles && !$user->goods)
				$result[] = $user->email;
		}

		return $this->respondJSON(array(
			'users' => join("\r\n", $result),
			'count' => count($result)
		));
	}

	private function getFreighters()
	{
		$command = Yii::app()->db->createCommand();
		$users = $command->selectDistinct('users.email')
			->from('users')
//			->where('user_types.id = ' . UserTypes::FREIGHTER)
			->join('profiles', 'profiles.user_id = users.id AND profiles.user_type_id = ' . UserTypes::FREIGHTER)
//			->leftJoin('user_types', 'user_types.id = profiles.user_type_id')
			->queryAll();


		return $this->respondJSON(array(
			'users' => join("\r\n", array_map('self::getItems',$users)),
			'count' => count($users)
		));
	}

	private function getShippers()
	{
		$command = Yii::app()->db->createCommand();
		$users = $command->selectDistinct('users.email')
			->from('users')
//			->where('user_types.id = ' . UserTypes::SHIPPER)
			->join('profiles', 'profiles.user_id = users.id AND profiles.user_type_id = ' . UserTypes::SHIPPER)
//			->join('user_types', 'user_types.id = profiles.user_type_id AND user_types.id = ' . UserTypes::SHIPPER)
			->queryAll();


		return $this->respondJSON(array(
			'users' => join("\r\n", array_map('self::getItems',$users)),
			'count' => count($users)
		));
	}

	private function getDispatchers()
	{
		$command = Yii::app()->db->createCommand();
		$users = $command->selectDistinct('users.email')
			->from('users')
			->where('user_types.id = ' . UserTypes::DISPATCHER)
			->leftJoin('profiles', 'profiles.user_id = users.id')
			->leftJoin('user_types', 'user_types.id = profiles.user_type_id')
			->queryAll();


		return $this->respondJSON(array(
			'users' => join("\r\n", array_map('self::getItems',$users)),
			'count' => count($users)
		));
	}

	private function getFreightersWithGood()
	{
		$command = Yii::app()->db->createCommand();
		$users = $command->selectDistinct('users.email')
			->from('goods')
			->where('user_types.id = ' . UserTypes::FREIGHTER)
			->leftJoin('users', 'users.id = goods.user_id')
			->leftJoin('profiles', 'profiles.user_id = users.id')
			->leftJoin('user_types', 'user_types.id = profiles.user_type_id')
			->queryAll();


		return $this->respondJSON(array(
			'users' => join("\r\n", array_map('self::getItems',$users)),
			'count' => count($users)
		));
	}

	private static function getItems($item)
	{
		return $item['email'];
	}

	private function getShippersWithVehicle()
	{
		$command = Yii::app()->db->createCommand();
		$users = $command->selectDistinct('users.email')
			->from('vehicle')
			->where('user_types.id = ' . UserTypes::SHIPPER)
			->leftJoin('users', 'users.id = vehicle.user_id')
			->leftJoin('profiles', 'profiles.user_id = users.id')
			->leftJoin('user_types', 'user_types.id = profiles.user_type_id')
			->queryAll();


		return $this->respondJSON(array(
			'users' => join("\r\n", array_map('self::getItems',$users)),
			'count' => count($users)
		));
	}

	private function getDispatchersWithGood()
	{
		$items = Goods::model()->findAll();

		$result = array();
		foreach ($items as $item)
		{
			if ($item->user->profiles->userType->id != UserTypes::DISPATCHER)
				continue;

			if (isset($result[$item->user->email]))
				continue;
			else
				if (!$item->vehicles && $item->goods)
					$result[$item->user->email] = $item->user->email;
		}

		return $this->respondJSON(array(
			'users' => join("\r\n", $result),
			'count' => count($result)
		));
	}

	private function getDispatchersWithVehicle()
	{
		$items = Vehicle::model()->findAll();

		$result = array();
		foreach ($items as $item)
		{
			if ($item->user->profiles->userType->id != UserTypes::DISPATCHER)
				continue;

			if (isset($result[$item->user->email]))
				continue;
			else
				if ($item->vehicles && !$item->goods)
					$result[$item->user->email] = $item->user->email;
		}

		return $this->respondJSON(array(
			'users' => join("\r\n", $result),
			'count' => count($result)
		));
	}

	private function getDispatchersWithGoodVehicle()
	{
		$items = Users::model()->findAll();

		$result = array();
		foreach ($items as $item)
		{
			if ($item->profiles->userType->id != UserTypes::DISPATCHER)
				continue;

			if (isset($result[$item->user->email]))
				continue;
			else
			{
				if ($item->vehicles && $item->goods)
					$result[$item->user->email] = $item->user->email;
			}
		}

		return $this->respondJSON(array(
			'users' => join("\r\n", $result),
			'count' => count($result)
		));
	}
}