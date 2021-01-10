<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail,Validator;
use Illuminate\Validation\Rule;
use Storage, DB,Excel, Helper;

class AdminDatatableController extends Controller
{

	/**
	* We use this parameter to separate the process
	* from execute data to javascript datatable plugin or just export it to an excel sheet
	* @var bool
	*/
	private $is_export = false;

	/**
	* Fill the current module from route parameter, its accept sub module such as "training-group" or main module such as "training"
	* @var string
	*/
	private $currentModule;

	/**
	* Set the current main module
	* @var string
	*/
	private $module;

	/**
	* Set the current main module id
	* @var integer
	*/
	private $moduleId;

	/**
	* Set the current sub module
	* @var string
	*/
	private $subModule;

	/**
	* Set the current sub module id
	* @var integer
	*/
	private $subModuleId;


	/**
	* Prepare and response module data either to excel or to datatable
	* @param string $module get the module type from route
	* @param object $q Request data
	*
	* @return mixed
	*/
	public function getModule($module,$sub_module = null,$module_id = 0,$sub_module_id = 0,Request $q)
	{
		$this->currentModule = ($sub_module) ? $sub_module : $module;
		$this->module = $module;
		$this->subModule = $sub_module;
		$this->moduleId = $module_id;
		$this->subModuleId = $sub_module_id;

		// If the current route is for export data to excel sheet
		if ($q->route()->getName() == 'datatable_export') {
			$this->is_export = true;
		}

		switch ($module) {
			case 'users':
                return $this->Users($q);
			break;
			case 'orders':
                return $this->Orders($q);
			break;
			case 'services':
                return $this->Services($q);
			break;
			case 'conversations':
                return $this->Conversations($q);
			break;
			case 'services-reviews':
                return $this->ServicesReviews($q);
			break;
			case 'financial-transactions':
                return $this->FinancialTransactions($q);
			break;
			case 'financial-withdraw-requests':
                return $this->FinancialWithdrawRequests($q);
            break;
			default:
			abort(403);
			break;
		}

	}


    
	/**
	* Export model data to excel sheet
	*
	* @param object $Model eloquent model data
	* @return mixed
	*/
	public function exportToExcel($Model)
	{
		$q = request();
		$Columns = explode(',',$q->columns);
		if (count($Columns)) {
			$fileDir = 'temporary';
			$filePath = $fileDir.'/'.ucfirst($this->currentModule).'-'.date('Ymdh').'-'.uniqid().'.xlsx';
			$excelStoreDisk = 'public';
			switch ($this->currentModule) {
				case 'services':
					$Model = $Model->get();
					Excel::store(new \App\Exports\ServicesExport($Model), $filePath,$excelStoreDisk);
				break;
				case 'orders':
					$Model = $Model->get();
					Excel::store(new \App\Exports\OrdersExport($Model), $filePath,$excelStoreDisk);
				break;
				case 'users':
					$Model = $Model->get();
					Excel::store(new \App\Exports\UsersExport($Model), $filePath,$excelStoreDisk);
				break;
				case 'conversations':
					$Model = $Model->get();
					Excel::store(new \App\Exports\ConversationsExport($Model), $filePath,$excelStoreDisk);
				break;
				case 'services-reviews':
					$Model = $Model->get();
					Excel::store(new \App\Exports\ServicesReviewsExport($Model), $filePath,$excelStoreDisk);
				break;
				case 'financial-transactions':
					$Model = $Model->get();
					Excel::store(new \App\Exports\FinancialTransactionsExport($Model), $filePath,$excelStoreDisk);
				break;
				default:
					return response()->json(['message' => 'invalid_export','message_string' => __('messages.errors.default'),'status' => false],404);
				break;
			}
			return response()->json(['message' => 'success','status' => true,'file' => \Storage::disk($excelStoreDisk)->url($filePath)]);
		}
	}
	
	/**
	* Check if the filter parameter has a value not a default value
	*
	* @param object $filter_parameter
	* @return mixed
	*/
	public function isVal($filter_parameter,$default_value = 'all')
	{
		return $filter_parameter && $filter_parameter != $default_value;
    }

	

    /**
     * Get Services
	 * 
	 * @param Request $q
     */
    public function Services($q){
	
		$getResults = \App\Models\Service::selectRaw('services.id,services.title,services.main_category_type,services.created_at,
		user.name as user_name,user.id as user_id,user.email as user_email,
		category.name_ar as category_name,services.is_approved,services.basic_price,services.basic_delivery_days,(SELECT orders.created_at FROM orders WHERE orders.service_id = services.id ORDER BY services.created_at DESC LIMIT 1) AS last_order_date')->withCount('Image','Orders');
		$getResults = $getResults->leftJoin('categories as category','category.id','=','services.category_id');
		$getResults = $getResults->leftJoin('users as user','user.id','=','services.user_id');
		$getResults = $getResults->groupBy('services.id');

		// Date
		$services_date_field = 'services.created_at';
		$services_start_date = ($q->created_date_start_date) ? $q->created_date_start_date : false;
		$services_end_date = ($q->created_date_end_date) ? $q->created_date_end_date : false;
		if($services_start_date){
			$getResults = $getResults->whereDate(DB::raw($services_date_field),'>=',$services_start_date);
		}
		if($services_end_date){
			$getResults = $getResults->whereDate(DB::raw($services_date_field),'<=',$services_end_date);
		}

		// Last Order Date
		$order_start_date = ($q->last_order_date_start_date) ? $q->last_order_date_start_date : false;
		$order_end_date = ($q->last_order_date_end_date) ? $q->last_order_date_end_date : false;
		if($order_start_date || $order_end_date){
			$getResults = $getResults->whereHas('Orders',function($Orders) use($order_start_date,$order_end_date){
				if($order_start_date){
					$Orders = $Orders->whereDate('created_at','>=',$order_start_date);
				}
				if($order_end_date){
					$Orders = $Orders->whereDate('created_at','<=',$order_end_date);
				}
				return $Orders;
			});
		}

		// User
		if($q->user_id && $q->user_id != 'all'){
			$getResults = $getResults->where(DB::raw('services.user_id'),$q->user_id);
		}

		// Main Category Type
		if($q->main_category_type && $q->main_category_type != 'all'){
			$getResults = $getResults->where('main_category_type',$q->main_category_type);
		}

		// Category
		if($q->category_id && $q->category_id != 'all'){
			$getResults = $getResults->where('category_id',$q->category_id);
		}
		
		// Is Featured & Is Approved
		if($q->approval_type && $q->approval_type != 'all'){
			$is_approved = ($q->approval_type == 'approved') ? 1 : 0;
			$getResults = $getResults->where(DB::raw('services.is_approved'),$is_approved);
		}


        if($this->is_export){
			return $this->exportToExcel($getResults);
		}else {
            $dt = datatables()->of($getResults);
        }
		return $dt
		->addColumn('DT_RowId','{{ strtolower($id) }}')
		->filterColumn('category_name', function($query, $keyword) {
			$query->whereRaw("category.name_ar like ?", ["%{$keyword}%"]);
		})
		->filterColumn('user_name', function($query, $keyword) {
			$query->whereRaw("user.name like ?", ["%{$keyword}%"]);
		})
		->make(true);
	}

    /**
     * Get Orders
	 * 
	 * @param Request $q
     */
    public function Orders($q){

		$getResults = \App\Models\Order::selectRaw('orders.id,orders.id as order_no,orders.status,orders.paid_total,orders.paid_total*(0.01*orders.commission_rate) as commission_amount,orders.paid_total-(orders.paid_total*(0.01*orders.commission_rate)) as net_amount,
		orders.commission_rate,orders.created_at,
		users.name as buyer_name,users.email as buyer_email,
		services.title as service_title,
		service_owner.name as service_owner_name,service_owner.id as service_owner_id');
		$getResults = $getResults->leftJoin('users','users.id','=','orders.user_id');
		$getResults = $getResults->leftJoin('services','services.id','=','orders.service_id');
		$getResults = $getResults->leftJoin('users as service_owner','service_owner.id','=','services.user_id');
		$getResults = $getResults->groupBy('orders.id');

		// Order date filter
		$order_date_field = 'orders.created_at';
		$order_start_date = ($q->created_date_start_date) ? $q->created_date_start_date : false;
		$order_end_date = ($q->created_date_end_date) ? $q->created_date_end_date : false;
		if($order_start_date){
			$getResults = $getResults->whereDate(DB::raw($order_date_field),'>=',$order_start_date);
		}
		if($order_end_date){
			$getResults = $getResults->whereDate(DB::raw($order_date_field),'<=',$order_end_date);
		}

		if($this->isVal($q->service_id)){
			$getResults = $getResults->where('service_id',intval($q->service_id));
		}


		if($this->isVal($q->service_owner_id) || $this->isVal($q->category_id) || $this->isVal($q->main_category_type)){
			$getResults = $getResults->whereHas('Service',function($Service) use($q){
				if($this->isVal($q->service_owner_id)){
					$Service = $Service->where('user_id',$q->service_owner_id);
				}
				if($this->isVal($q->category_id)){
					$Service = $Service->where('category_id',$q->category_id);
				}
				if($this->isVal($q->main_category_type)){
					$Service = $Service->where('main_category_type',$q->main_category_type);
				}
				return $Service;
			});
		}

		// Status filter
		if($this->isVal($q->status)){
			$getResults = $getResults->where(DB::raw('orders.status'),$q->status);
		}


		// Buyer User Filter
		if($this->isVal($q->user_id)){
			$getResults = $getResults->where(DB::raw('orders.user_id'),$q->user_id);
		}

		// Min and Max Order Amount
		if($this->isVal($q->min_amount) || $this->isVal($q->max_amount)){
			$price_field = 'orders.paid_total';
			if($this->isVal($q->min_amount)){
				$getResults = $getResults->where(DB::raw($price_field),'>=',$q->min_amount);
			}
			if($this->isVal($q->max_amount)){
				$getResults = $getResults->where(DB::raw($price_field),'<=',$q->max_amount);
			}
		}

        if($this->is_export){
			return $this->exportToExcel($getResults);
		}else {
            $dt = datatables()->of($getResults);
        }
		return $dt
		->addColumn('DT_RowId','{{ strtolower($id) }}')
		->filterColumn('buyer_name', function($query, $keyword) {
			$query->whereRaw("users.name like ?", ["%{$keyword}%"]);
		})
		->filterColumn('buyer_email', function($query, $keyword) {
			$query->whereRaw("users.email like ?", ["%{$keyword}%"]);
		})
		->filterColumn('service_title', function($query, $keyword) {
			$query->whereRaw("services.title like ?", ["%{$keyword}%"]);
		})
		->filterColumn('service_owner_name', function($query, $keyword) {
			$query->whereRaw("service_owner.name like ?", ["%{$keyword}%"]);
		})
		->filterColumn('order_no', function($query, $keyword) {
			$query->whereRaw("CONCAT('T',services.id) = ?", [$keyword]);
		})
		->make(true);
	}
	
    /**
     * Get Users List
	 * 
	 * @param Request $q
     */
    public function Users($q){
	
		$getResults = \App\Models\User::selectRaw('users.id,users.balance,users.email,users.phone,users.name,users.created_at,
		IFNULL((SELECT COUNT(id) FROM services WHERE services.user_id = users.id GROUP BY services.user_id),0) AS services_count,
		IFNULL((SELECT COUNT(id) FROM orders WHERE orders.user_id = users.id GROUP BY orders.user_id),0) AS orders_count,
		IFNULL((SELECT SUM(paid_total) FROM orders WHERE orders.user_id = users.id GROUP BY orders.user_id),0) AS orders_amount,
		IFNULL((SELECT SUM(amount) FROM financial_transactions ft WHERE ft.user_id = users.id AND ft.type = "profit" GROUP BY ft.user_id),0) AS profit_amount
		');
		$getResults = $getResults->groupBy('users.id');

		// Registration Date filter
		$register_date_date_field = 'users.created_at';
		$register_date_start_date = ($q->register_date_start_date) ? $q->register_date_start_date : false;
		$register_date_end_date = ($q->register_date_end_date) ? $q->register_date_end_date : false;
		if($register_date_start_date){
			$getResults = $getResults->whereDate(DB::raw($register_date_date_field),'>=',$register_date_start_date);
		}
		if($register_date_end_date){
			$getResults = $getResults->whereDate(DB::raw($register_date_date_field),'<=',$register_date_end_date);
		}
		
		// Last order date filter
		$last_order_date_start_date = ($q->last_order_date_start_date) ? $q->last_order_date_start_date : false;
		$last_order_date_end_date = ($q->last_order_date_end_date) ? $q->last_order_date_end_date : false;
		if($last_order_date_start_date || $last_order_date_end_date){
			$getResults = $getResults->whereHas('Orders',function($Orders) use($last_order_date_start_date,$last_order_date_end_date){
				$last_order_date_field = 'orders.created_at';
				if($last_order_date_start_date){
					$Orders = $Orders->whereDate(DB::raw($last_order_date_field),'>=',$last_order_date_start_date);
				}
				if($last_order_date_end_date){
					$Orders = $Orders->whereDate(DB::raw($last_order_date_field),'<=',$last_order_date_end_date);
				}
			});
		}
		// User type
		if($q->is_service_owner){
			$getResults = $getResults->whereHas('Services');
		}


		if($this->is_export){
			return $this->exportToExcel($getResults);
		}else {
		    $dt = datatables()->of($getResults);
		}

		return $dt
		->addColumn('DT_RowId','{{ strtolower($id) }}')
		->make(true);
	}

	/**
     * Get Financial Transactions
	 * 
	 * @param Request $q
     */
    public function FinancialTransactions($q){

		$getResults = \App\Models\FinancialTransaction::selectRaw('financial_transactions.*,services.title as service_title,user.name as user_name,services.user_id as service_owner_id');
		$getResults = $getResults->leftJoin('services','services.id','=','financial_transactions.service_id');
		$getResults = $getResults->leftJoin('users as user','user.id','=','financial_transactions.user_id');
		$getResults = $getResults->groupBy('financial_transactions.id');


		// Create date filter
		$created_date_start_date = ($q->created_date_start_date) ? $q->created_date_start_date : false;
		$created_date_end_date = ($q->created_date_end_date) ? $q->created_date_end_date : false;
		if($created_date_start_date || $created_date_end_date){
			$created_date_date_field = 'financial_transactions.created_at';
			if($created_date_start_date){
				$getResults = $getResults->whereDate(DB::raw($created_date_date_field),'>=',$created_date_start_date);
			}
			if($created_date_end_date){
				$getResults = $getResults->whereDate(DB::raw($created_date_date_field),'<=',$created_date_end_date);
			}
		}


		// Type filter
		if($q->type && $q->type != 'all'){
			$getResults = $getResults->where('type',$q->type);
		}

		// Amount filter
		if($q->min_amount || $q->max_amount){
			$amount_field = 'financial_transactions.amount';
			if($q->min_amount){
				$getResults = $getResults->where(DB::raw($amount_field),'>=',$q->min_amount);
			}
			if($q->max_amount){
				$getResults = $getResults->where(DB::raw($amount_field),'<=',$q->max_amount);
			}
		}

		// User filter
		if($q->user_id && $q->user_id != 'all'){
			$getResults = $getResults->where(DB::raw('financial_transactions.user_id'),$q->user_id);
		}

        if($this->is_export){
			return $this->exportToExcel($getResults);
		}else {
            $dt = datatables()->of($getResults);
        }
		return $dt
		->filterColumn('service_title', function($query, $keyword) {
			$query->whereRaw("services.title like ?", ["%{$keyword}%"]);
		})
		->filterColumn('user_name', function($query, $keyword) {
			$query->whereRaw("user.name like ?", ["%{$keyword}%"]);
		})
		->addColumn('DT_RowId','{{ strtolower($id) }}')
		->make(true);
    }

	/**
     * Get Financial Withdraw Requests
	 * 
	 * @param Request $q
     */
    public function FinancialWithdrawRequests($q){

		$getResults = \App\Models\FinancialWithdrawRequest::selectRaw('financial_withdraw_requests.*,user.name as user_name');
		$getResults = $getResults->leftJoin('users as user','user.id','=','financial_withdraw_requests.user_id');
		$getResults = $getResults->groupBy('financial_withdraw_requests.id');


		// Request date filter
		$request_date_start_date = ($q->request_date_start_date) ? $q->request_date_start_date : false;
		$request_date_end_date = ($q->request_date_end_date) ? $q->request_date_end_date : false;
		if($request_date_start_date || $request_date_end_date){
			$request_date_date_field = 'financial_withdraw_requests.requested_at';
			if($request_date_start_date){
				$getResults = $getResults->whereDate(DB::raw($request_date_date_field),'>=',$request_date_start_date);
			}
			if($request_date_end_date){
				$getResults = $getResults->whereDate(DB::raw($request_date_date_field),'<=',$request_date_end_date);
			}
		}

		// Status date filter
		$status_date_start_date = ($q->status_date_start_date) ? $q->status_date_start_date : false;
		$status_date_end_date = ($q->status_date_end_date) ? $q->status_date_end_date : false;
		if($status_date_start_date || $status_date_end_date){
			$status_date_date_field = 'financial_withdraw_requests.status_updated_at';
			if($status_date_start_date){
				$getResults = $getResults->whereDate(DB::raw($status_date_date_field),'>=',$status_date_start_date);
			}
			if($status_date_end_date){
				$getResults = $getResults->whereDate(DB::raw($status_date_date_field),'<=',$status_date_end_date);
			}
		}


		// Status filter
		if($q->status){
			$getResults = $getResults->where('status',$q->status);
		}

		// Amount filter
		if($q->min_amount || $q->max_amount){
			$amount_field = 'financial_withdraw_requests.amount';
			if($q->min_amount){
				$getResults = $getResults->where(DB::raw($amount_field),'>=',$q->min_amount);
			}
			if($q->max_amount){
				$getResults = $getResults->where(DB::raw($amount_field),'<=',$q->max_amount);
			}
		}

		// User filter
		if($q->user_id && $q->user_id != 'all'){
			$getResults = $getResults->where(DB::raw('financial_withdraw_requests.user_id'),$q->user_id);
		}


        if($this->is_export){
			return $this->exportToExcel($getResults);
		}else {
            $dt = datatables()->of($getResults);
        }
		return $dt
		->filterColumn('service_title', function($query, $keyword) {
			$query->whereRaw("services.title like ?", ["%{$keyword}%"]);
		})
		->filterColumn('user_name', function($query, $keyword) {
			$query->whereRaw("user.name like ?", ["%{$keyword}%"]);
		})
		->addColumn('DT_RowId','{{ strtolower($id) }}')
		->make(true);
	}
	
	/**
     * Get Services Reviews
	 * 
	 * @param Request $q
     */
    public function ServicesReviews($q){

		$getResults = \App\Models\ServiceReview::selectRaw('services_reviews.*,user.name as user_name,user.email as user_email,service.title as service_title,service_owner.name as service_owner_name,service_owner.email as service_owner_email');
		$getResults = $getResults->leftJoin('users as user','user.id','=','services_reviews.user_id');
		$getResults = $getResults->leftJoin('services as service','service.id','=','services_reviews.service_id');
		$getResults = $getResults->leftJoin('users as service_owner','service_owner.id','=','services.user_id');
		$getResults = $getResults->groupBy('services_reviews.id');


		// Create date filter
		$create_date_start_date = ($q->create_date_start_date) ? $q->create_date_start_date : false;
		$create_date_end_date = ($q->create_date_end_date) ? $q->create_date_end_date : false;
		if($create_date_start_date || $create_date_end_date){
			$create_date_date_field = 'services_reviews.createed_at';
			if($create_date_start_date){
				$getResults = $getResults->whereDate(DB::raw($create_date_date_field),'>=',$create_date_start_date);
			}
			if($create_date_end_date){
				$getResults = $getResults->whereDate(DB::raw($create_date_date_field),'<=',$create_date_end_date);
			}
		}

		// Rating filter
		if($q->rating){
			$getResults = $getResults->where(DB::raw('services_reviews.rating'),$q->rating);
		}

		// User filter
		if($q->user_id && $q->user_id != 'all'){
			$getResults = $getResults->where(DB::raw('services_reviews.user_id'),$q->user_id);
		}

		// Service filter
		if($q->service_id && $q->service_id != 'all'){
			$getResults = $getResults->where(DB::raw('services_reviews.service_id'),$q->service_id);
		}


        if($this->is_export){
			return $this->exportToExcel($getResults);
		}else {
            $dt = datatables()->of($getResults);
        }
		return $dt
		->filterColumn('user_name', function($query, $keyword) {
			$query->whereRaw("user.name like ?", ["%{$keyword}%"]);
		})
		->filterColumn('user_email', function($query, $keyword) {
			$query->whereRaw("user.email like ?", ["%{$keyword}%"]);
		})
		->filterColumn('service_title', function($query, $keyword) {
			$query->whereRaw("services.title like ?", ["%{$keyword}%"]);
		})
		->filterColumn('service_owner_name', function($query, $keyword) {
			$query->whereRaw("service_owner.name like ?", ["%{$keyword}%"]);
		})
		->filterColumn('service_owner_email', function($query, $keyword) {
			$query->whereRaw("service_owner.email like ?", ["%{$keyword}%"]);
		})
		->addColumn('DT_RowId','{{ strtolower($id) }}')
		->make(true);
	}
	
	/**
     * Get Conversations
	 * 
	 * @param Request $q
     */
    public function Conversations($q){

		$getResults = \App\Models\Conversation::selectRaw('conversations.id,conversations.title,conversations.created_at,user_sender.name as user_sender_name,user_sender.email as user_sender_email,user_recipient.name as user_recipient_name,user_recipient.email as user_recipient_email,(SELECT cm.created_at FROM conversations_messages cm WHERE cm.conversation_id = conversations.id ORDER BY cm.created_at LIMIT 1) AS last_message_date')
		->withCount('Messages')->with(['LastMessage' => function($LastMessage){
			return  $LastMessage->with('User');
		}]);
		$getResults = $getResults->leftJoin('users as user_recipient','user_recipient.id','=','conversations.user_recipient_id');
		$getResults = $getResults->leftJoin('users as user_sender','user_sender.id','=','conversations.user_sender_id');
		$getResults = $getResults->groupBy('conversations.id');


		// Create date filter
		$create_date_start_date = ($q->create_date_start_date) ? $q->create_date_start_date : false;
		$create_date_end_date = ($q->create_date_end_date) ? $q->create_date_end_date : false;
		if($create_date_start_date || $create_date_end_date){
			$create_date_date_field = 'conversations.createed_at';
			if($create_date_start_date){
				$getResults = $getResults->whereDate(DB::raw($create_date_date_field),'>=',$create_date_start_date);
			}
			if($create_date_end_date){
				$getResults = $getResults->whereDate(DB::raw($create_date_date_field),'<=',$create_date_end_date);
			}
		}



        if($this->is_export){
			return $this->exportToExcel($getResults);
		}else {
            $dt = datatables()->of($getResults);
        }
		return $dt
		->filterColumn('user_sender_name', function($query, $keyword) {
			$query->whereRaw("user_sender.name like ?", ["%{$keyword}%"]);
		})
		->filterColumn('user_sender_email', function($query, $keyword) {
			$query->whereRaw("user_sender.email like ?", ["%{$keyword}%"]);
		})
		->filterColumn('user_recipient_name', function($query, $keyword) {
			$query->whereRaw("user_recipient.name like ?", ["%{$keyword}%"]);
		})
		->filterColumn('user_recipient_email', function($query, $keyword) {
			$query->whereRaw("user_recipient.email like ?", ["%{$keyword}%"]);
		})
		->addColumn('DT_RowId','{{ strtolower($id) }}')
		->make(true);
    }
}
