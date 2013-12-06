<?php
set_time_limit(0);

/**
 * Description of TestData
 *
 * @author Gena
 */
class TestData
{

    private $phones = "0123456789";
    private $conn = NULL;

    public function fill_get()
    {
        $this->_connect();
//		$this->_fillClients();
//        $this->_fillVehicles();
//        $this->_fillGoods();
//        $this->_tmp();
//        $this->_fillJokerOrganizations();
//        $this->_fillJokerProfiles();
//        $this->_fillJokerOrgBusinessTypes();
//        $this->_fillJokerEmployee();
        $this->_fillJokerVendibles();

    }

    private function getDbConfig()
    {
        return array(
            "dbHost" => "localhost",
            "dbName" => "host5841_gruz",
            "dbUser" => "gena",
            "dbPassword" => "12345"
        );
    }

    private function _connect()
    {
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

    private function _fillClients()
    {
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

    private function _fillVehicles()
    {
        $this->conn->query("DELETE FROM vehicle");

        $stmt = $this->conn->query("SELECT count(*) as cnt FROM users");
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);

        $stmt = $this->conn->query("SELECT id FROM users");
        $users = $stmt->fetchAll(PDO::FETCH_OBJ);

        foreach ($users as $user) {
            $rand_count = rand(4, 5);
            for ($i = 0; $i < $rand_count; $i++) {
                $stmt = $this->conn->query("SELECT cat_id, model_id, marka_id FROM modeli WHERE cat_id = 6 ORDER BY RAND() LIMIT 0, 1");
                $result = $stmt->fetchAll(PDO::FETCH_OBJ);
                $category_id = $result[0]->cat_id;
                $make_id = $result[0]->marka_id;
                $model_id = $result[0]->model_id;

//				$stmt = $this->conn->query("SELECT id FROM vehicle_types ORDER BY RAND() LIMIT 0, 1");
//				$result = $stmt->fetchAll(PDO::FETCH_OBJ);
//				$vehicle_type_id = $result[0]->id;
                $vehicle_type_id = 11;

//				$stmt = $this->conn->query("SELECT id FROM body_types WHERE id >= 1 AND id <= 10 ORDER BY RAND() LIMIT 0, 1");
//				$result = $stmt->fetchAll(PDO::FETCH_OBJ);
//				$body_type_id = $result[0]->id;
                $body_type_id = 1;

                $bearing_capacity = rand(100, 200);
                $body_capacity = rand(100, 200);
                $license_plate = 'ВА 2345 МО';

                $permissions = '1,2,3';
                $adr = 0;
//				$permissions = '';
//				$rand_permissions = rand(0, 5);
//				if ($rand_permissions)
//				{
//					$stmt = $this->conn->query("SELECT id FROM permissions ORDER BY RAND() LIMIT 0, $rand_permissions");
//					$results = $stmt->fetchAll(PDO::FETCH_OBJ);
//					$tmp = array();
//					foreach($results as $result)
//					{
//						$tmp[] = $result->id;
//						$adr = $result->id == 4 ? rand(1, 9) : 0;
//					}
//					$permissions = join(',', $tmp);
//				}

                $shipments = '1,2';
//				$shipments = '';
//				$rand_shipments = rand(0, 4);
//				if ($rand_shipments)
//				{
//					$stmt = $this->conn->query("SELECT id FROM shipment ORDER BY RAND() LIMIT 0, $rand_shipments");
//					$results = $stmt->fetchAll(PDO::FETCH_OBJ);
//					$tmp = array();
//					foreach($results as $result)
//					{
//						$tmp[] = $result->id;
//					}
//					$shipments = join(',', $tmp);
//				}
//				$stmt = $this->conn->query("SELECT id, country_id, region_id FROM city WHERE country_id IN (9908) ORDER BY RAND() LIMIT 0, 1");
                $stmt = $this->conn->query("SELECT id, country_id, region_id FROM city WHERE country_id = 9908 AND region_id IN (10583, 9909, 10165) ORDER BY RAND() LIMIT 0, 1");
                $result = $stmt->fetchAll(PDO::FETCH_OBJ);
                $country_id = $result[0]->country_id;
                $region_id = $result[0]->region_id;
                $city_id = $result[0]->id;

                $stmt = $this->conn->query("SELECT id, country_id, region_id FROM city WHERE country_id = 9908 AND region_id IN (10583, 9909, 10165) ORDER BY RAND() LIMIT 0, 1");
                $result = $stmt->fetchAll(PDO::FETCH_OBJ);
                $country_id_to = $result[0]->country_id;
                $region_id_to = $result[0]->region_id;
                $city_id_to = $result[0]->id;

                $date_from = 1364819565;
                $date_to = 1406910765;

                $created_at = rand((time() - 518400), time());

                $this->conn->query("INSERT INTO vehicle (user_id, category_id, make_id, vehicle_type_id, model_id, body_type_id, bearing_capacity, body_capacity, license_plate, permissions, shipments, adr, date_from, date_to, country_id, region_id, city_id, country_id_to, region_id_to, city_id_to, created_at, updated_at)
				VALUES ($user->id, $category_id, $make_id, $vehicle_type_id, $model_id, $body_type_id, $bearing_capacity, $body_capacity, '$license_plate', '$permissions', '$shipments', $adr, $date_from, $date_to, $country_id, $region_id, $city_id, $country_id_to, $region_id_to, $city_id_to, $created_at, $created_at)");

                $vehicle_id = $this->conn->lastInsertId();

                $stmt = $this->conn->query("SELECT name FROM marka WHERE marka_id = $make_id AND cat_id = $category_id");
                $result = $stmt->fetchAll(PDO::FETCH_OBJ);
                $make_name = $result[0]->name;

                $stmt = $this->conn->query("SELECT name FROM modeli WHERE model_id = $model_id");
                $result = $stmt->fetchAll(PDO::FETCH_OBJ);
                $model_name = $result[0]->name;

                $slug_translit = $this->_translitIt($make_name . ' ' . $model_name);
                $slug = str_replace(' ', '-', $slug_translit) . '-' . $vehicle_id;

                $stmt = $this->conn->query("UPDATE vehicle SET slug = '$slug' WHERE id = $vehicle_id");
            }
        }
    }

    private function _fillGoods()
    {
        $this->conn->query("DELETE FROM goods");

        $stmt = $this->conn->query("SELECT count(*) as cnt FROM users");
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);

        $stmt = $this->conn->query("SELECT id FROM users");
        $users = $stmt->fetchAll(PDO::FETCH_OBJ);

        $titles_file = file_get_contents("titles");
        $names = explode("\r\n", $titles_file);
        $count_names = count($names) - 1;

        $descriptions_file = file_get_contents("descriptions");
        $descriptions_array = explode("\r\n", $descriptions_file);
        $count_descriptions = count($descriptions_array) - 1;

        foreach ($users as $user) {
            $rand_count = rand(5, 10);
            for ($i = 0; $i < $rand_count; $i++) {
                $date_from = 1370104365;
                $date_to = 1393673925;
                $name = $names[rand(0, $count_names)];

                $stmt = $this->conn->query("SELECT id, country_id, region_id FROM city WHERE country_id = 9908 AND region_id IN (10583, 9909, 10165) ORDER BY RAND() LIMIT 0, 1");
                $result = $stmt->fetchAll(PDO::FETCH_OBJ);

                $country_id_from = $result[0]->country_id;
                $region_id_from = $result[0]->region_id;
                $city_id_from = $result[0]->id;

                $stmt = $this->conn->query("SELECT id, country_id, region_id FROM city WHERE country_id = 9908 AND region_id IN (10583, 9909, 10165) ORDER BY RAND() LIMIT 0, 1");
                $result = $stmt->fetchAll(PDO::FETCH_OBJ);

                $country_id_to = $result[0]->country_id;
                $region_id_to = $result[0]->region_id;
                $city_id_to = $result[0]->id;

                $vehicle_types = '11';
//				$vehicle_types = '';
//				$rand_vehicle_types = rand(1, 3);
//				if ($rand_vehicle_types)
//				{
//					$stmt = $this->conn->query("SELECT id FROM vehicle_types ORDER BY RAND() LIMIT 0, $rand_vehicle_types");
//					$results = $stmt->fetchAll(PDO::FETCH_OBJ);
//					$tmp = array();
//					foreach($results as $result)
//					{
//						$tmp[] = $result->id;
//					}
//					$vehicle_types = join(',', $tmp);
//				}

                $body_types = '1';
//				$body_types = '';
//				$rand_body_types = rand(1, 4);
//				if ($rand_body_types)
//				{
//					$stmt = $this->conn->query("SELECT id FROM body_types WHERE id >= 1 AND id <= 10 ORDER BY RAND() LIMIT 0, $rand_body_types");
//					$results = $stmt->fetchAll(PDO::FETCH_OBJ);
//					$tmp = array();
//					foreach($results as $result)
//					{
//						$tmp[] = $result->id;
//					}
//					$body_types = join(',', $tmp);
//				}

                $shipments = '1,2';
//				$rand_shipments = rand(0, 4);
//				if ($rand_shipments)
//				{
//					$stmt = $this->conn->query("SELECT id FROM shipment ORDER BY RAND() LIMIT 0, $rand_shipments");
//					$results = $stmt->fetchAll(PDO::FETCH_OBJ);
//					$tmp = array();
//					foreach($results as $result)
//					{
//						$tmp[] = $result->id;
//					}
//					$shipments = join(',', $tmp);
//				}

                $adr = 0;
                $permissions = '1,2,3';
//				$permissions = '';
//				$rand_permissions = rand(0, 5);
//				if ($rand_permissions)
//				{
//					$stmt = $this->conn->query("SELECT id FROM permissions ORDER BY RAND() LIMIT 0, $rand_permissions");
//					$results = $stmt->fetchAll(PDO::FETCH_OBJ);
//					$tmp = array();
//					foreach($results as $result)
//					{
//						$tmp[] = $result->id;
//						$adr = $result->id == 4 ? rand(1, 9) : 0;
//					}
//					$permissions = join(',', $tmp);
//				}

                $weight_exact_value = rand(50, 90);
                $capacity_exact_value = rand(50, 90);
                $cost = rand(100, 5000);

                $stmt = $this->conn->query("SELECT id FROM currency ORDER BY RAND() LIMIT 0, 1");
                $result = $stmt->fetchAll(PDO::FETCH_OBJ);
                $currency_id = $result[0]->id;

                $stmt = $this->conn->query("SELECT id FROM payment_type ORDER BY RAND() LIMIT 0, 1");
                $result = $stmt->fetchAll(PDO::FETCH_OBJ);
                $payment_type_id = $result[0]->id;

                $description = $descriptions_array[rand(0, $count_descriptions)];

                $stmt = $this->conn->query("SELECT user_type_id FROM profiles WHERE user_id = " . $user->id);
                $result = $stmt->fetchAll(PDO::FETCH_OBJ);
                $user_type_id = $result[0]->user_type_id;

                $fee = '';
                $fee_array = array('200 грн', '10%', '20%', '100$', '50 евро');
                $count_fee = count($fee_array) - 1;
                if ($user_type_id == 3) {
                    $fee = $fee_array[rand(0, $count_fee)];
                }

                $this->conn->query("INSERT INTO goods (user_id, date_from, date_to, name, country_id_from, region_id_from, city_id_from, country_id_to, region_id_to, city_id_to, vehicle_types, body_types, shipments,
					permissions, adr, weight_exact_value, capacity_exact_value, cost, currency_id, payment_type_id, description, created_at, updated_at, fee)
				VALUES ($user->id, $date_from, $date_to, '$name', $country_id_from, $region_id_from, $city_id_from, $country_id_to, $region_id_to, $city_id_to, '$vehicle_types', '$body_types', '$shipments',
					'$permissions', $adr, $weight_exact_value, $capacity_exact_value, $cost, $currency_id, $payment_type_id, '$description', $date_from, $date_from, '$fee')");

                $good_id = $this->conn->lastInsertId();

                $slug_translit = $this->_translitIt($name);
                $slug = str_replace(' ', '-', $slug_translit) . '-' . $good_id;

                $stmt = $this->conn->query("UPDATE goods SET slug = '$slug' WHERE id = $good_id");
            }
        }
    }

    private function _translitIt($str)
    {
        $tr = array(
            "А" => "A", "Б" => "B", "В" => "V", "Г" => "G",
            "Д" => "D", "Е" => "E", "Ж" => "J", "З" => "Z", "И" => "I",
            "Й" => "Y", "К" => "K", "Л" => "L", "М" => "M", "Н" => "N",
            "О" => "O", "П" => "P", "Р" => "R", "С" => "S", "Т" => "T",
            "У" => "U", "Ф" => "F", "Х" => "H", "Ц" => "TS", "Ч" => "CH",
            "Ш" => "SH", "Щ" => "SCH", "Ъ" => "", "Ы" => "YI", "Ь" => "",
            "Э" => "E", "Ю" => "YU", "Я" => "YA", "Ё" => "E", "а" => "a", "б" => "b",
            "в" => "v", "г" => "g", "д" => "d", "е" => "e", "ж" => "j",
            "з" => "z", "и" => "i", "й" => "y", "к" => "k", "л" => "l",
            "м" => "m", "н" => "n", "о" => "o", "п" => "p", "р" => "r",
            "с" => "s", "т" => "t", "у" => "u", "ф" => "f", "х" => "h",
            "ц" => "ts", "ч" => "ch", "ш" => "sh", "щ" => "sch", "ъ" => "y",
            "ы" => "yi", "ь" => "", "э" => "e", "ю" => "yu", "я" => "ya", "ё" => "e"
        );
        return strtr($str, $tr);
    }

    function _fillJokerOrganizations()
    {
        $this->conn->query("DELETE FROM joker_organizations");
        $stmt = $this->conn->query("SELECT * FROM joker_users LIMIT 2000, 80");
        $users = $stmt->fetchAll(PDO::FETCH_OBJ);

        $stmt = $this->conn->query("SELECT * FROM city WHERE region_id IN (10583, 10165, 10201) ORDER BY RAND() LIMIT 0, 100");
        $cities = $stmt->fetchAll(PDO::FETCH_OBJ);

        $descriptions_file = file_get_contents("descriptions");
        $descriptions_array = explode("\r\n", $descriptions_file);
        $count_descriptions = count($descriptions_array) - 1;
        $phone_codes_file = file_get_contents("phone_codes");
        $phone_codes = explode("\r\n", $phone_codes_file);

        $phone_codes_length = count($phone_codes);

        $countUsers = count($users);
        for ($index = 0; $index < $countUsers; $index++) {
            $userId = $users[mt_rand(0, $countUsers - 1)]->id;
            $name = 'Организация ' . $index;
            $description = $descriptions_array[rand(0, $count_descriptions)];
            $country_id = $cities[$index]->country_id;
            $region_id = $cities[$index]->region_id;
            $city_id = $cities[$index]->id;
            $latitude = $cities[$index]->latitude;
            $longitude = $cities[$index]->longitude;
            $address = 'улю Хрешатик 125';

            $mobile = $phone_codes[rand(0, $phone_codes_length - 1)];
            for ($j = 0; $j < 7; $j++) {
                $mobile .= $this->phones[rand(0, 9)];
            }

            $email = 'a' . $index . '.@a.com';

            $this->conn->query("
            INSERT INTO joker_organizations (user_id, name, description, country_id, region_id, city_id, address, mobile, email, latitude, longitude)
            VALUES ($userId, '$name', '$description', $country_id, $region_id, $city_id, '$address', '$mobile', '$email', $latitude, $longitude);
            ");
        }
    }

    private function _fillJokerProfiles()
    {
        $this->conn->query("DELETE FROM joker_profiles");
        $stmt = $this->conn->query("SELECT DISTINCT user_id FROM joker_organizations");
        $users = $stmt->fetchAll(PDO::FETCH_OBJ);

        $names_file = file_get_contents("names");
        $names = explode("\r\n", $names_file);
        $phone_codes_file = file_get_contents("phone_codes");
        $phone_codes = explode("\r\n", $phone_codes_file);

        $phone_codes_length = count($phone_codes);
        for ($index = 0; $index < count($users); $index++) {
            $userId = $users[$index]->user_id;
            $tmp_name_ru = explode(" ", $names[$index]);
            $first_name = $tmp_name_ru[0];
            $middle_name = $tmp_name_ru[1];
            $last_name = $tmp_name_ru[2];

            $mobile = $phone_codes[rand(0, $phone_codes_length - 1)];
            for ($j = 0; $j < 7; $j++) {
                $mobile .= $this->phones[rand(0, 9)];
            }

            $created_at = rand((time() - 518400), time());

            $this->conn->query("
            INSERT INTO joker_profiles (user_id, first_name, middle_name, last_name, mobile, created_at)
            VALUES ($userId, '$first_name', '$middle_name', '$last_name', '$mobile', $created_at);
            ");
        }
    }

    private function _fillJokerOrgBusinessTypes()
    {
        $this->conn->query("DELETE FROM joker_organization_business_type");
        $stmt = $this->conn->query("SELECT id FROM joker_organizations");
        $organizations = $stmt->fetchAll(PDO::FETCH_OBJ);
        $stmt = $this->conn->query("SELECT id FROM joker_business_type");
        $types = $stmt->fetchAll(PDO::FETCH_OBJ);

        for ($index = 0; $index < count($organizations); $index++) {
            for ($i = 0; $i < 3; $i++) {
                $this->conn->query("
                INSERT INTO joker_organization_business_type (organization_id, business_type_id)
                VALUES (" . $organizations[$index]->id . ", " . $types[mt_rand(0, count($types) - 1)]->id . ");
                ");
            }
        }
    }

    private function _fillJokerEmployee()
    {
        $this->conn->query("DELETE FROM joker_employee");
        $stmt = $this->conn->query("SELECT id FROM joker_organizations");
        $organizations = $stmt->fetchAll(PDO::FETCH_OBJ);

        for ($index = 0; $index < count($organizations); $index++) {
            for ($i = 0; $i < 3; $i++) {
                $this->conn->query("
                INSERT INTO joker_employee (organization_id, position, fio, mobile)
                VALUES (" . $organizations[$index]->id . ", 'Менеджер', 'Сотрудник К.О.', '0651234789');
                ");
            }
        }
    }

    private function _fillJokerVendibles()
    {
        $this->conn->query("DELETE FROM joker_vendibles");
        $stmt = $this->conn->query("SELECT id FROM joker_organizations");
        $organizations = $stmt->fetchAll(PDO::FETCH_OBJ);
        $stmt = $this->conn->query("SELECT id FROM joker_currency");
        $currencies = $stmt->fetchAll(PDO::FETCH_OBJ);

        $names_file = file_get_contents("titles");
        $names = explode("\r\n", $names_file);
        $descriptions_file = file_get_contents("descriptions");
        $descriptions = explode("\r\n", $descriptions_file);

        for ($index = 0; $index < count($organizations); $index++) {
            $countVendibles = mt_rand(10, 25);
            for ($i = 0; $i < $countVendibles; $i++) {
                $created_at = rand((time() - 518400), time());
                
                $this->conn->query("
                INSERT INTO joker_vendibles (organization_id, name, description, cost, discount, currency_id, created_at)
                VALUES (" . $organizations[$index]->id . ", '" . $names[mt_rand(0, count($names) - 1)] . "', '" . $descriptions[mt_rand(0, count($descriptions) - 1)] . "', " . mt_rand(100, 10000) . ", " . mt_rand(1, 10) . ", " . $currencies[mt_rand(0, count($currencies) - 1)]->id . ", $created_at);
                ");
            }
        }
    }

}

$testData = new TestData();
$testData->fill_get();
?>
