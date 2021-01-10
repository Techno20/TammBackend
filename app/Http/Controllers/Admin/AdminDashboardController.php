<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail,Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use DB, Helper;

class AdminDashboardController extends Controller
{
	public $start_date;
	public $end_date;
	public $prev_start_date;
	public $prev_end_date;
	public $has_prev_date = false;

	/**
	* Get general statistics
	* @param object $q Request data
	*
	* @return mixed
	*/
	public function getGeneral(Request $q)
	{
		$validator = Validator::make(request()->all(), [
			'date' => 'required',
			'start_date' => 'required|date',
			'end_date' => 'required|date'
		]);
		if($validator->fails()) {
			return Helper::responseValidationError($validator->messages());
		}

		$this->prepareFiltersParameters($q);
		$topLimit = 10;
		// increate the length of json_object data
		DB::statement(DB::raw('SET SESSION group_concat_max_len = 1000000;'));
		$countOrders = DB::raw('(SELECT JSON_OBJECT("count",COUNT(id),"amount",IFNULL(SUM(orders.paid_total),0),"commission_amount",IFNULL(SUM(orders.paid_total*(0.01*orders.commission_rate)),0),"net_amount",IFNULL(SUM(orders.paid_total-(orders.paid_total*(0.01*orders.commission_rate))),0)) FROM orders WHERE '.$this->dateRange('first','orders.created_at').' LIMIT 1) as count_orders');
		$countUsers = DB::raw('(SELECT COUNT(users.id) FROM users WHERE '.$this->dateRange('first','users.created_at').' LIMIT 1) AS count_users');
		$countServices = DB::raw('(SELECT COUNT(services.id) FROM services WHERE '.$this->dateRange('first','services.created_at').' LIMIT 1) AS count_services');
		$countNotApprovedServices = DB::raw('(SELECT COUNT(services.id) FROM services WHERE services.is_approved = 0 '.$this->basicFilters(true,'services.user_id','services.created_at').' LIMIT 1) AS count_not_approved_services');

		$topServicesByOrdersCount = DB::raw('(SELECT CONCAT("[",GROUP_CONCAT(sel_top_services_by_orders_count),"]") FROM (SELECT JSON_OBJECT("amount",IFNULL(SUM(orders.paid_total),0),"count",IFNULL(COUNT(orders.paid_total),0),"service_id",services.id,"service_title",services.title,"service_owner_name",users.name) AS sel_top_services_by_orders_count,COUNT(orders.id) AS count_orders FROM orders INNER JOIN services ON services.id = orders.service_id LEFT JOIN users ON users.id = services.user_id WHERE '.$this->dateRange('first','orders.created_at').' GROUP BY orders.service_id ORDER BY count_orders DESC LIMIT '.$topLimit.') x) as top_services_by_orders_count');
		$topServicesByOrdersRevenue = DB::raw('(SELECT CONCAT("[",GROUP_CONCAT(sel_top_services_by_orders_revenue),"]") FROM (SELECT JSON_OBJECT("amount",IFNULL(SUM(orders.paid_total),0),"count",IFNULL(COUNT(orders.paid_total),0),"service_id",services.id,"service_title",services.title,"service_owner_name",users.name) AS sel_top_services_by_orders_revenue,SUM(orders.paid_total) AS total_orders FROM orders INNER JOIN services ON services.id = orders.service_id LEFT JOIN users ON users.id = services.user_id WHERE '.$this->dateRange('first','orders.created_at').' GROUP BY orders.service_id ORDER BY total_orders DESC LIMIT '.$topLimit.') x) as top_services_by_orders_revenue');
		
		$topCategoriesByOrdersCount = DB::raw('(SELECT CONCAT("[",GROUP_CONCAT(sel_top_categories_by_orders_count),"]") FROM (SELECT JSON_OBJECT("amount",IFNULL(SUM(orders.paid_total),0),"count",IFNULL(COUNT(orders.paid_total),0),"category_id",category.id,"category_name",category.name_ar,"main_category_type",category.main_category_type) AS sel_top_categories_by_orders_count,COUNT(orders.id) AS count_orders FROM orders INNER JOIN services ON services.id = orders.service_id LEFT JOIN categories AS category ON services.category_id = category.id WHERE '.$this->dateRange('first','orders.created_at').' GROUP BY category.id ORDER BY count_orders DESC LIMIT '.$topLimit.') x) as top_categories_by_orders_count');
		$topCategoriesByOrdersRevenue = DB::raw('(SELECT CONCAT("[",GROUP_CONCAT(sel_top_categories_by_orders_revenue),"]") FROM (SELECT JSON_OBJECT("amount",IFNULL(SUM(orders.paid_total),0),"count",IFNULL(COUNT(orders.paid_total),0),"category_id",category.id,"category_name",category.name_ar,"main_category_type",category.main_category_type) AS sel_top_categories_by_orders_revenue,SUM(orders.paid_total) AS total_orders FROM orders INNER JOIN services ON services.id = orders.service_id LEFT JOIN categories AS category ON services.category_id = category.id WHERE '.$this->dateRange('first','orders.created_at').' GROUP BY category.id ORDER BY total_orders DESC LIMIT '.$topLimit.') x) as top_categories_by_orders_revenue');
		
		$topUsersByOrdersCount = DB::raw('(SELECT CONCAT("[",GROUP_CONCAT(sel_top_users_by_orders_count),"]") FROM (SELECT JSON_OBJECT("amount",IFNULL(SUM(orders.paid_total),0),"count",IFNULL(COUNT(orders.paid_total),0),"user_id",user.id,"user_name",user.name) AS sel_top_users_by_orders_count,COUNT(orders.id) AS count_orders FROM orders INNER JOIN services ON services.id = orders.service_id LEFT JOIN users AS user ON services.user_id = user.id  WHERE '.$this->dateRange('first','orders.created_at').' GROUP BY user.id ORDER BY count_orders DESC LIMIT '.$topLimit.') x) as top_users_by_orders_count');
		$topUsersByOrdersRevenue = DB::raw('(SELECT CONCAT("[",GROUP_CONCAT(sel_top_users_by_orders_revenue),"]") FROM (SELECT JSON_OBJECT("amount",IFNULL(SUM(orders.paid_total),0),"count",IFNULL(COUNT(orders.paid_total),0),"user_id",user.id,"user_name",user.name) AS sel_top_users_by_orders_revenue,SUM(orders.paid_total) AS total_orders FROM orders INNER JOIN services ON services.id = orders.service_id LEFT JOIN users AS user ON services.user_id = user.id  WHERE '.$this->dateRange('first','orders.created_at').' GROUP BY user.id ORDER BY total_orders DESC LIMIT '.$topLimit.') x) as top_users_by_orders_revenue');
		
		// $topCitiesByOrdersCount = DB::raw('(SELECT CONCAT("[",GROUP_CONCAT(sel_top_cities_by_orders_count),"]") FROM (SELECT JSON_OBJECT("amount",IFNULL(SUM(orders.paid_total),0),"count",IFNULL(COUNT(orders.paid_total),0),"city_id",city.id,"city_name",city.name_ar) AS sel_top_cities_by_orders_count,COUNT(orders.id) AS count_orders FROM orders INNER JOIN services ON services.id = orders.service_id LEFT JOIN list_of_cities AS city ON services.city_id = city.id WHERE '.$this->dateRange('first','orders.created_at').' GROUP BY city.id ORDER BY count_orders DESC LIMIT '.$topLimit.') x) as top_cities_by_orders_count');
		// $topCitiesByOrdersRevenue = DB::raw('(SELECT CONCAT("[",GROUP_CONCAT(sel_top_cities_by_orders_revenue),"]") FROM (SELECT JSON_OBJECT("amount",IFNULL(SUM(orders.paid_total),0),"count",IFNULL(COUNT(orders.paid_total),0),"city_id",city.id,"city_name",city.name_ar) AS sel_top_cities_by_orders_revenue,SUM(orders.paid_total) AS total_orders FROM orders INNER JOIN services ON services.id = orders.service_id LEFT JOIN list_of_cities AS city ON services.city_id = city.id WHERE '.$this->dateRange('first','orders.created_at').' GROUP BY city.id ORDER BY total_orders DESC LIMIT '.$topLimit.') x) as top_cities_by_orders_revenue');
		

		$servicesByCategories = DB::raw('(SELECT CONCAT("[",GROUP_CONCAT(sel_categories),"]") FROM (SELECT JSON_OBJECT("main_category_type",categories.main_category_type,"name",categories.name_ar,"count",
		IFNULL((SELECT COUNT(services.id) FROM services WHERE services.category_id = categories.id GROUP BY services.category_id),0)
		) as sel_categories FROM categories WHERE EXISTS(SELECT id FROM services WHERE services.category_id = categories.id)) x) as services_by_categories');

		$this->Statistics = \App\Models\User::select($countOrders,$countServices,$countNotApprovedServices,$countUsers,$servicesByCategories,$topServicesByOrdersCount,$topServicesByOrdersRevenue,$topCategoriesByOrdersCount,$topCategoriesByOrdersRevenue,$topUsersByOrdersCount,$topUsersByOrdersRevenue);
		$this->prepareSelectTrendChartData($q);
		$this->Statistics = $this->Statistics->first();

		$countOrders = ($this->Statistics->count_orders) ? json_decode($this->Statistics->count_orders) : ['count' => 0,'total' => 0];
		$countUsers = ($this->Statistics->count_users) ? $this->Statistics->count_users : 0;
		$countServices = ($this->Statistics->count_services) ? $this->Statistics->count_services : 0;
		$countNotApprovedServices = ($this->Statistics->count_not_approved_services) ? $this->Statistics->count_not_approved_services : 0;
		$countServiceProviders = \App\Models\User::whereHas('Services')->whereRaw($this->dateRange('first','created_at'))->count();


		$servicesByCategories = ($this->Statistics->services_by_categories) ? json_decode($this->Statistics->services_by_categories) : [];

		$topServicesByOrdersCount = ($this->Statistics->top_services_by_orders_count) ? json_decode($this->Statistics->top_services_by_orders_count) : [];
		$topServicesByOrdersRevenue = ($this->Statistics->top_services_by_orders_revenue) ? json_decode($this->Statistics->top_services_by_orders_revenue) : [];

		$topCategoriesByOrdersCount = ($this->Statistics->top_categories_by_orders_count) ? json_decode($this->Statistics->top_categories_by_orders_count) : [];
		$topCategoriesByOrdersRevenue = ($this->Statistics->top_categories_by_orders_revenue) ? json_decode($this->Statistics->top_categories_by_orders_revenue) : [];

		$topUsersByOrdersCount = ($this->Statistics->top_users_by_orders_count) ? json_decode($this->Statistics->top_users_by_orders_count) : [];
		$topUsersByOrdersRevenue = ($this->Statistics->top_users_by_orders_revenue) ? json_decode($this->Statistics->top_users_by_orders_revenue) : [];
		

		$Result = [
			'count_orders' => $countOrders,
			'count_users' => $countUsers,
			'count_services' => $countServices,
			'count_service_providers' => $countServiceProviders,
			'count_not_approved_services' => $countNotApprovedServices,
			'services_by_categories' => $servicesByCategories,
			'top_services_by_orders' => [
				'by_count' => $topServicesByOrdersCount,
				'by_revenue' => $topServicesByOrdersRevenue
			],
			'top_categories_by_orders' => [
				'by_count' => $topCategoriesByOrdersCount,
				'by_revenue' => $topCategoriesByOrdersRevenue
			],
			'top_users_by_orders' => [
				'by_count' => $topUsersByOrdersCount,
				'by_revenue' => $topUsersByOrdersRevenue
			]
		];

		$Result['orders_trend'] = [
			'current' => ($this->Statistics->orders_trend) ? json_decode($this->Statistics->orders_trend) : [],
			'prev' => ($this->Statistics->prev_orders_trend) ? json_decode($this->Statistics->prev_orders_trend) : [],
		];

		return response()->json($Result);
	}

	/**
	 * Prepare filter parameters values
	 * @param object $q Request
	 * @return
	 */
	private function prepareFiltersParameters($q){
		$this->user_id = ($q->user_id) ? intval($q->user_id) : null;

		$this->start_date = $q->start_date;
		$this->end_date = $q->end_date;
		if (in_array($q->date,['daily','monthly','weekly','quarterly','yearly']) && $q->prev_start_date && $q->prev_end_date) {

			$this->has_prev_date = true;
			$this->prev_start_date = $q->prev_start_date;
			$this->prev_end_date = $q->prev_end_date;
		}
	}

	/**
	 * Filter start and end date in db query string
	 * 
	 * @param string $type
	 * @param string $col table date column
	 * @return string
	 */
	private function dateRange($type,$col = 'created_at'){
		$date_range = [];
		$sd = ($type == 'first') ? $this->start_date : $this->prev_start_date;
		$ed = ($type == 'first') ? $this->end_date : $this->prev_end_date;

		if ($sd) {
			$date_range[] = ' DATE('.$col.') >= "'.$sd.'" ';
		}
		if ($ed) {
			$date_range[] = ' DATE('.$col.') <= "'.$ed.'" ';
		}
		
		return (count($date_range)) ? join('AND',$date_range) : '';
	}

	/**
	* Function to set filters to query
	* @return string
	**/
	private function basicFilters($has_first_and = false,$user_col = 'user_id',$date_col = 'created_at'){
		$r = '';
		if (request()->start_date) {
			$r .= ' AND DATE('.$date_col.') >= "'.request()->start_date.'"';
		}
		if (request()->end_date) {
			$r .= ' AND DATE('.$date_col.') <= "'.request()->end_date.'"';
		}
		if (!$has_first_and) {
			$prefix = ' AND';
			$r = substr($r, strlen($prefix));
		}
		return $r;
	}

	/**
	 * Prepare select trend chart data
	 */
	public function prepareSelectTrendChartData($q)
	{
		$whereOrders = [];
		if($this->user_id){
			$whereOrders[] = ' services.user_id = '.$this->user_id.' ';
		}
		$whereOrders = (count($whereOrders)) ? join('AND',$whereOrders) : '';

		switch ($q->date) {
			case 'daily':
				$this->Statistics = $this->Statistics->addSelect(DB::raw('(SELECT CONCAT("[",GROUP_CONCAT(total_orders_trend),"]") FROM (SELECT JSON_OBJECT("count",COUNT(orders.id),"hour",MAX(HOUR(orders.created_at)),"amount",SUM(orders.paid_total)) as total_orders_trend FROM orders LEFT JOIN services ON services.id = orders.service_id WHERE '.$whereOrders.(($whereOrders) ? 'AND' : '').' DATE(orders.created_at) = "'.$this->start_date.'" GROUP BY HOUR(orders.created_at),DAY(orders.created_at)) x) as orders_trend'));
				$this->Statistics = $this->Statistics->addSelect(DB::raw('(SELECT CONCAT("[",GROUP_CONCAT(total_orders_trend),"]") FROM (SELECT JSON_OBJECT("count",COUNT(orders.id),"hour",MAX(HOUR(orders.created_at)),"amount",SUM(orders.paid_total)) as total_orders_trend FROM orders LEFT JOIN services ON services.id = orders.service_id WHERE '.$whereOrders.(($whereOrders) ? 'AND' : '').' DATE(orders.created_at) = "'.$this->prev_start_date.'" GROUP BY HOUR(orders.created_at),DAY(orders.created_at)) x) as prev_orders_trend'));
			break;
			case 'monthly': case 'weekly':
				$dayFunc = ($q->date == 'monthly') ? 'DAY' : 'DAYNAME';
				$this->Statistics = $this->Statistics->addSelect(DB::raw('(SELECT CONCAT("[",GROUP_CONCAT(total_orders_trend),"]") FROM (SELECT JSON_OBJECT("count",COUNT(orders.id),"day",MAX('.$dayFunc.'(orders.created_at)),"amount",SUM(orders.paid_total)) as total_orders_trend FROM orders LEFT JOIN services ON services.id = orders.service_id WHERE '.$whereOrders.(($whereOrders) ? ' AND ' : '').$this->dateRange('first','orders.created_at').' GROUP BY DAYNAME(orders.created_at) ORDER BY DAYNAME(orders.created_at)) x) as orders_trend'));
				$this->Statistics = $this->Statistics->addSelect(DB::raw('(SELECT CONCAT("[",GROUP_CONCAT(total_orders_trend),"]") FROM (SELECT JSON_OBJECT("count",COUNT(orders.id),"day",MAX('.$dayFunc.'(orders.created_at)),"amount",SUM(orders.paid_total)) as total_orders_trend FROM orders LEFT JOIN services ON services.id = orders.service_id WHERE '.$whereOrders.(($whereOrders) ? ' AND ' : '').$this->dateRange('prev','orders.created_at').' GROUP BY DAYNAME(orders.created_at) ORDER BY DAYNAME(orders.created_at)) x) as prev_orders_trend'));
			break;
			case 'yearly': case 'quarterly':
				$this->Statistics = $this->Statistics->addSelect(DB::raw('(SELECT CONCAT("[",GROUP_CONCAT(total_orders_trend),"]") FROM (SELECT JSON_OBJECT("count",COUNT(orders.id),"month",MAX(MONTH(orders.created_at)),"amount",SUM(orders.paid_total)) as total_orders_trend FROM orders LEFT JOIN services ON services.id = orders.service_id WHERE '.$whereOrders.(($whereOrders) ? ' AND ' : '').$this->dateRange('first','orders.created_at').' GROUP BY MONTH(orders.created_at) ORDER BY MONTH(orders.created_at)) x) as orders_trend'));
				$this->Statistics = $this->Statistics->addSelect(DB::raw('(SELECT CONCAT("[",GROUP_CONCAT(total_orders_trend),"]") FROM (SELECT JSON_OBJECT("count",COUNT(orders.id),"month",MAX(MONTH(orders.created_at)),"amount",SUM(orders.paid_total)) as total_orders_trend FROM orders LEFT JOIN services ON services.id = orders.service_id WHERE '.$whereOrders.(($whereOrders) ? ' AND ' : '').$this->dateRange('prev','orders.created_at').' GROUP BY MONTH(orders.created_at) ORDER BY MONTH(orders.created_at)) x) as prev_orders_trend'));
			break;
		}
	}
}
