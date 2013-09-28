<?php

class SearchPartners extends CFormModel {

	public $partnerSearchCountry;
	public $partnerSearchRegion;
	public $partnerSearchCity;
	public $partnerSearchShipper;
	public $partnerSearchFreighter;
	public $partnerSearchDispatcher;
	public $partnerSearchWords;

	public function __construct($data = array()) {

		$this->populate($data);
	}

	public function populate($data = array()) {
		foreach ($data as $key => $value)
		{
//			$itemValue = is_int($value) ? (int) $value : (is_string($value) ? strip_tags(trim($value)) : $value);

			$this->{$key} = is_int($value) ? (int) $value : (is_string($value) ? strip_tags(trim($value)) : $value);;
		}
	}

}

?>