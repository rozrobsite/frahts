<?php
set_time_limit(0);

include 'simple_html_dom.php';

/**
 * Description of TestData
 *
 * @author Gena
 */
class ParserData {

	private $conn = NULL;
	private $_type = 1;

	public function __construct() {
		$this->_connect();
	}

	public function fill($countpages = 1, $type = 1) {
//		$this->conn->query("DELETE FROM companies");

		$this->_type = $type;
		for ($page = 1; $page <= $countpages; $page++) {
			$html = $this->_getPage($page, $type);

			$this->_parsePage($html);
			$this->_parseUsers();
		}

//		$this->_parseEmails();
	}

	private function getDbConfig() {
		return array(
			"dbHost" => "localhost",
			"dbName" => "frahtparser",
			"dbUser" => "gena",
			"dbPassword" => "12345"
		);
	}

	private function _connect() {
		try {
			$dbConfig = $this->getDbConfig();
			$this->conn = new PDO('mysql:host=' . $dbConfig['dbHost'] . ';dbname=' . $dbConfig['dbName'], $dbConfig['dbUser'], $dbConfig['dbPassword']);
			$this->conn->query('SET character_set_connection = "utf8";');
			$this->conn->query('SET character_set_client = "utf8";');
			$this->conn->query('SET character_set_results = "utf8";');
		}
		catch (PDOException $exc) {
			die($exc->getMessage());
		}
	}

	private function _getPage($page, $type) {
		return $type == 1 ?
			file_get_html('http://www.lardi-trans.com/trans/search/?countryfrom=UA&cityFrom=&cityTo=&dateFrom=&dateTo=&truck=0&mass=&mass2=&value=&value2=&gabDl=&gabSh=&gabV=&zagruzFilterId=&adr=-1&startSearch=%D0%A1%D0%B4%D0%B5%D0%BB%D0%B0%D1%82%D1%8C+%D0%B2%D1%8B%D0%B1%D0%BE%D1%80%D0%BA%D1%83&page=' . $page) :
			file_get_html('http://www.lardi-trans.com/gruz/?countryfrom=UA&cityFrom=&cityTo=&dateFrom=&dateTo=&truck=0&mass=&mass2=&value=&value2=&gabDl=&gabSh=&gabV=&zagruzFilterId=&adr=-1&showType=all&startSearch=%D0%A1%D0%B4%D0%B5%D0%BB%D0%B0%D1%82%D1%8C+%D0%B2%D1%8B%D0%B1%D0%BE%D1%80%D0%BA%D1%83&page=' . $page);
	}

	private function _getUserPage($url) {
		return file_get_html($url);
	}

	private function _parsePage($html) {
		foreach ($html->find('table.uiFirmContRootTable') as $element) {
			$item = $element->find('a[href^="/user"]', 0);
			$company_url = $item->href;

			if (empty($company_url))
				continue;

			$stmt = $this->conn->query("SELECT id FROM companies WHERE url = 'http://www.lardi-trans.com$company_url'");
			$result = $stmt->fetchAll(PDO::FETCH_OBJ);
			if (count($result))
				continue;

			$company_title = $item->innertext;

			unset($item);
			$item = $element->find('span.uiContsViewContactSpan', 0);
			$company_name = $item->innertext;

			unset($item);
			$item = $element->find('div.uiFirmContScroolBlock div');

			$company_phones_arr = array();
			$countItems = count($item);
			for ($i = 0; $i < ($countItems - 1); $i++) {
				$company_phones_arr[] = $item[$i]->innertext;
			}

			$company_phones = join(',', $company_phones_arr);

			$this->conn->query("INSERT INTO companies (title, url, type, name, phones) VALUES ('$company_title', 'http://www.lardi-trans.com$company_url', $this->_type, '$company_name', '$company_phones')");
		}
	}

	private function _parseUsers() {
		$stmt = $this->conn->query("SELECT id, url FROM companies WHERE is_parsed = 0 ORDER BY id");
		$result = $stmt->fetchAll(PDO::FETCH_OBJ);

		if (!count($result))
			return;

		foreach ($result as $url) {
			$html = $this->_getUserPage($url->url);

			foreach ($html->find('.contInfoTable') as $element) {
				$items = $element->find('a[href^="/sendmail"] img');
				$index = 0;
				foreach ($items as $item) {
					copy('http://www.lardi-trans.com' . $item->src, 'images/' . $url->id . '_' . $index . '.png');
					$index++;
				}
			}
		}
	}

	private function _parseEmails() {
		$stmt = $this->conn->query("SELECT id FROM companies ORDER BY id");
		$result = $stmt->fetchAll(PDO::FETCH_OBJ);

		if (!count($result))
			return;

		foreach ($result as $item) {

		}
	}

	public function getPhones($type) {
		$stmt = $this->conn->query("SELECT * FROM companies WHERE type = $type ORDER BY id");
		$result = $stmt->fetchAll(PDO::FETCH_OBJ);

		$phones_array = array();
		foreach ($result as $phone) {
			$phones = $phone->phones;
			$phones_row = explode(',', $phones);
			$phone = $phones_row[0];

			$phone = str_replace('(', '', $phone);
			$phone = str_replace(')', '', $phone);
			$phone = str_replace(' ', '', $phone);
			$phone = str_replace('-', '', $phone);
			$phone = str_replace('+', '', $phone);

			if ($this->startsWith($phone, '38')) {
				if (strlen($phone) < 12)
					continue;


//				if (!($this->startsWith('039', $tmp) || $this->startsWith('091', $tmp) || $this->startsWith('092', $tmp) || $this->startsWith('094', $tmp)))
					$phones_array[] = $this->startsWith($phone, '0') ? $phone : '+' . $phone;
			}
		}

		date_default_timezone_set('Europe/Kiev');
		$current_date = date('dmY_H_i');
		$filename = $type == 1 ? "Gruzoperevozchiki_$current_date.txt" : "Gruzootpraviteli_$current_date.txt";

		file_put_contents($filename, join("\r\n", $phones_array));
	}

	private function startsWith($haystack, $needle) {
		return !strncmp($haystack, $needle, strlen($needle));
	}

	private function endsWith($haystack, $needle) {
		$length = strlen($needle);
		if ($length == 0) {
			return true;
		}

		return (substr($haystack, -$length) === $needle);
	}

	private function _fillClients() {
		$this->conn->query("DELETE FROM users");
		$this->conn->query("DELETE FROM profiles");
		$this->conn->query("DELETE FROM organizations");

		$names_file = file_get_contents("names");
		$names = explode("\r\n", $names_file);
		$emails_file = file_get_contents("emails");
		$emails = explode("\r\n", $emails_file);
		$phone_codes_file = file_get_contents("phone_codes");
		$phone_codes = explode("\r\n", $phone_codes_file);

		$names_length = count($names);
		$emails_length = count($emails);
		for ($i = 0; $i < $names_length; $i++) {
			$name = $this->_translitIt($names[$i]);
			$name_ru = $names[$i];
			$tmp_name = explode(" ", $name);
			$tmp_name_ru = explode(" ", $name_ru);
			$first_name = $tmp_name_ru[0];
			$middle_name = $tmp_name_ru[1];
			$last_name = $tmp_name_ru[2];
			$email = substr($tmp_name[0], 0, 3) . "_" . substr($tmp_name[1], 0, 3) . "_" . substr($tmp_name[2], 0, 3) . "@mail." . $emails[rand(0, $emails_length - 1)];
			$password = md5("123456");
			$mobile = $phone_codes[rand(0, $phone_codes_length - 1)];
			$phone = $phone_codes[rand(0, $phone_codes_length - 1)];
			for ($j = 0; $j < 7; $j++) {
				$mobile .= $this->phones[rand(0, 9)];
				$phone .= $this->phones[rand(0, 9)];
			}

			$stmt = $this->conn->query("SELECT id, country_id, region_id FROM city ORDER BY RAND() LIMIT 0, 1");
			$result = $stmt->fetchAll(PDO::FETCH_OBJ);
			$country_id = $result[0]->country_id;
			$region_id = $result[0]->region_id;
			$city_id = $result[0]->id;

			$address = 'Пушкина 140, кв 50';
			$skype = substr($tmp_name[0], 0, 3) . "_" . substr($tmp_name[1], 0, 3) . "_" . substr($tmp_name[2], 0, 3);
			$icq = $phone;

			$stmt = $this->conn->query("SELECT id FROM user_types ORDER BY RAND() LIMIT 0, 1");
			$result = $stmt->fetchAll(PDO::FETCH_OBJ);
			$user_type_id = $result[0]->id;
			$created_at = rand((time() - 518400), time());

			$stmt = $this->conn->query("SELECT id FROM type_organizations ORDER BY RAND() LIMIT 0, 1");
			$result = $stmt->fetchAll(PDO::FETCH_OBJ);
			$type_org_id = $result[0]->id;
			$form_tax = 'Форма 25 У 34';

			$stmt = $this->conn->query("SELECT id FROM form_organizations ORDER BY RAND() LIMIT 0, 1");
			$result = $stmt->fetchAll(PDO::FETCH_OBJ);
			$form_org_id = $result[0]->id;

			$name_org = 'Организация ' . substr($tmp_name[0], 0, 3) . substr($tmp_name[1], 0, 3) . substr($tmp_name[2], 0, 3);
			$license = 'Лицензия №2345' . substr($tmp_name[0], 0, 3) . substr($tmp_name[1], 0, 3) . substr($tmp_name[2], 0, 3);
			$account_number = '2308765';
			$edrpou = 'DD4567';
			$bank = 'НацБанк Приват';
			$city = 'Симферополь';
			$mfo = '457UHR';
			$inn = '34546767INN';
			$certificate = '43343TURNIR';

			$this->conn->query("INSERT INTO users (email, username, password) VALUES ('$email', '$email', '$password')");

			$user_id = $this->conn->lastInsertId();

			$this->conn->query("INSERT INTO profiles (user_id, last_name, first_name, middle_name, mobile, country_id, region_id, city_id, address, phone, skype, icq, user_type_id, created_at, updated_at)
				VALUES ($user_id, '$last_name', '$first_name', '$middle_name', '$mobile', $country_id, $region_id, $city_id, '$address', '$phone', '$skype', '$icq', $user_type_id, $created_at, $created_at)");

			$this->conn->query("INSERT INTO organizations (type_org_id, form_tax, form_org_id, name_org, license, user_id, address, account_number, edrpou, bank, city, mfo, inn, certificate, phone)
				VALUES ($type_org_id, '$form_tax', $form_org_id, '$name_org', '$license', $user_id, '$address', '$account_number', '$edrpou', '$bank', '$city', '$mfo', '$inn', '$certificate', '$phone')");
		}
	}

}

$parserData = new ParserData();
//$parserData->fill(1, 2);
$parserData->getPhones(2);
?>