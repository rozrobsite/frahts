<?phpclass SearchFilter extends CFormModel {	const DIRECTION_ASC = 1;	const DIRECTION_DESC = 0;	const SORT_CREATED_AT = 0;	const SORT_PAYMENT_TYPE = 1;	public $vid = ''; // vehicle_id	public $check_dispatcher;	public $date_from;	public $date_to;	public $country_id; //vcoid	public $region_id; //vrid	public $city_id; //vcid	public $country_search_id; //fvcoid	public $region_search_id; //fvrid	public $city_search_id; //fvcid	public $radius;	public $sort; //vtid	public $direction; //btid	public $page;	public $vehicle;	public $good;	public function __construct() {		$this->vid = '';	}	public function getUrl($vid = '', $page = 1) {		if (isset($vid) && $vid) {			$vid = (int) $vid;		}		elseif (isset($this->vid) && $this->vid) {			$vid = (int) $this->vid;		}		if (isset($page) && (int) $page > 1) {			$page = (int) $page;		}		elseif (isset($this->pages) && $this->pages) {			$page = (int) $this->pages;		}		$path = '?' .			'vid=' . $vid .			'&check_dispatcher=' . $this->check_dispatcher .			'&date_from=' . (isset($this->date_from) ? $this->date_from : '') .			'&date_to=' . (isset($this->date_to) ? $this->date_to : '') .			'&vcoid=' . (isset($this->country_id) ? (int) $this->country_id : '') .			'&vrid=' . (isset($this->region_id) ? (int) $this->region_id : '') .			'&vcid=' . (isset($this->city_id) ? (int) $this->city_id : '') .			'&fvcoid=' . (isset($this->country_search_id) ? (int) $this->country_search_id : '') .			'&fvrid=' . (isset($this->region_search_id) ? (int) $this->region_search_id : '') .			'&fvcid=' . (isset($this->city_search_id) ? (int) $this->city_search_id : '') .			'&radius=' . (isset($this->radius) ? (int) $this->radius : '') .			'&sort=' . (isset($this->sort) ? (int) $this->sort : '') .			'&direct=' . (isset($this->direction) ? (int) $this->direction : '') .			'&page=' . $page;		return $path;	}	public function getGoodsUrl($vid = '', $page = 1) {		if (isset($vid) && $vid) {			$vid = (int) $vid;		}		elseif (isset($this->vid) && $this->vid) {			$vid = (int) $this->vid;		}		if (isset($page) && (int) $page > 1) {			$page = (int) $page;		}		elseif (isset($this->pages) && $this->pages) {			$page = (int) $this->pages;		}		$path = '?' .			'vid=' . $vid .			'&check_dispatcher=' . $this->check_dispatcher .			'&date_from=' . (isset($this->date_from) ? $this->date_from : '') .			'&date_to=' . (isset($this->date_to) ? $this->date_to : '') .			'&vcoid=' . (isset($this->country_id) ? (int) $this->country_id : '') .			'&vrid=' . (isset($this->region_id) ? (int) $this->region_id : '') .			'&vcid=' . (isset($this->city_id) ? (int) $this->city_id : '') .			'&fvcoid=' . (isset($this->country_search_id) ? (int) $this->country_search_id : '') .			'&fvrid=' . (isset($this->region_search_id) ? (int) $this->region_search_id : '') .			'&fvcid=' . (isset($this->city_search_id) ? (int) $this->city_search_id : '') . 			'&radius=' . (isset($this->radius) ? (int) $this->radius : '') .			'&sort=' . (isset($this->sort) ? (int) $this->sort : '') .			'&direct=' . (isset($this->direction) ? (int) $this->direction : '') .			'&page=' . $page;		return $path;	}}?>