<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;
	private $_code;
	private $_enabled;

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
		$record = Users::model()->findByAttributes(array('username' => $this->username));
		if ($record === null) $this->errorCode = self::ERROR_USERNAME_INVALID;
		else if ($record->password !== md5($this->password))
				$this->errorCode = self::ERROR_PASSWORD_INVALID;
		else
		{
			$this->_id = $record->id;
			$this->setState('id', $record->id);
			$this->setState('email', $record->email);
			$this->setState('enabled', $record->enabled);
			$this->setState('balance', $record->balance);
			$this->errorCode = self::ERROR_NONE;
		}
		return !$this->errorCode;
	}
	
	public function authenticateByCode()
	{
		$record = Users::model()->findByAttributes(array('code' => $this->code));
		
		if ($record === null) $this->errorCode = self::ERROR_UNKNOWN_IDENTITY;
		else if ($record->password !== $this->password)
			self::ERROR_UNKNOWN_IDENTITY;
		else
		{
			$this->_id = $record->id;
			$this->errorCode = self::ERROR_NONE;
		}
		
		return !$this->errorCode;
	}
	
	public function getId()
    {
        return $this->_id;
    }
	
	public function getCode()
	{
		return $this->_code;
	}

}