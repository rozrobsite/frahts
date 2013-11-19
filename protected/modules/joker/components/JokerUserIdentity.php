<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{

	private $_id;
	private $_email;
	private $_enabled;

	const ERROR_NOT_ENABLED = 3;

	/**
	 * @var string username
	 */
	public $email;

	/**
	 * @var string password
	 */
	public $password;

	public function __construct($email, $password)
	{
		$this->email = $email;
		$this->password = $password;
	}

	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$record = JokerUsers::model()->findByAttributes(array('email' => $this->email));
		if ($record === null) $this->errorCode = self::ERROR_USERNAME_INVALID;
		else if ($record->password !== md5($this->password))
				$this->errorCode = self::ERROR_PASSWORD_INVALID;
		else if (!$record->enabled) $this->errorCode = self::ERROR_NOT_ENABLED;
		else
		{
			$this->_id = $record->id;
			$this->setState('id', $record->id);
			$this->setState('email', $record->email);
			$this->setState('enabled', $record->enabled);
			$this->errorCode = self::ERROR_NONE;
		}
		return !$this->errorCode;
	}

	public function getId()
	{
		return $this->_id;
	}

	public function getEmail()
	{
		return $this->_email;
	}

	public function getEnabled()
	{
		return $this->_enabled;
	}

}