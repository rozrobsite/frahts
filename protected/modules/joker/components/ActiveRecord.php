<?php
class ActiveRecord extends CActiveRecord
{
	public function __construct($scenario = 'insert')
	{
		parent::__construct($scenario);
	}
}

