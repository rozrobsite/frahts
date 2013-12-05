<?php

class JokerSearch extends CFormModel {

	public $serviceCountry;
	public $serviceRegion;
	public $serviceCity;
	public $serviceRouteCountry;
	public $serviceRouteRegion;
	public $serviceRouteCity;
	public $serviceBusinessTypes;
	public $serviceWords;

	public function __construct($data = array()) {

		$this->populate($data);
	}

	public function populate($data = array()) {
		foreach ($data as $key => $value)
		{
			$this->{$key} = is_int($value) ? (int) $value : (is_string($value) ? strip_tags(trim($value)) : $value);;
		}
	}

}

?>