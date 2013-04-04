<?php

/**
 * This is the model class for table "city".
 *
 * The followings are the available columns in table 'city':
 * @property string $id
 * @property string $country_id
 * @property string $region_id
 * @property string $name_ru
 *
 * The followings are the available model relations:
 * @property Country $country
 * @property Region $region
 * @property Profiles[] $profiles
 */
class CityTestData extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return City the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'country';
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'cities' => array(self::HAS_MANY, 'City', 'region_id'),
			'regions' => array(self::HAS_MANY, 'Region', 'country_id'),
		);
	}

	public function getCoordinates()
	{
		set_time_limit(0);
		
		$countries = $this->findAll();
		foreach ($countries as $country)
		{
			foreach ($country->regions as $region)
			{
				foreach ($region->cities as $city)
				{
					if ($city->id < 1820) continue;
					
					$params = array(
						'geocode' => $country->name_ru . ', ' . $city->name_ru, // адрес
						'format' => 'json', // формат ответа
						'results' => 1, // количество выводимых результатов
						'key' => 'AKgqHEkBAAAA-WzMYwIAeAeamm8ETZZZpdfp2R07eIuGyX4AAAAAAAAAAACjUCDoHIHZJ2pcl5mSL1zWVp2Myw==', // ваш api key
					);
					$response = json_decode(file_get_contents('http://geocode-maps.yandex.ru/1.x/?' . http_build_query($params,
											'', '&')));

					if ($response->response->GeoObjectCollection->metaDataProperty->GeocoderResponseMetaData->found > 0)
					{
						$coord_array = explode(' ',
								$response->response->GeoObjectCollection->featureMember[0]->GeoObject->Point->pos);

						$city->longitude = $coord_array[0];
						$city->latitude = $coord_array[1];
						
						$city->update(false);
//						echo $country->name_ru . ', ' . $region->name_ru . ', ' . $city->name_ru . '<br/>';
//						echo "latitude(широта): " . $coord_array[1] . '<br/>';
//						echo "longitude(долгота): " . $coord_array[0] . '<br/>';
					}
					else
					{
						echo $country->name_ru . ', ' . $region->name_ru . ', ' . $city->name_ru . ' - Ничего не найдено';
					}
				}
			}
		}

	}

}