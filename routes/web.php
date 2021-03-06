<?php


Route::get('clear-cache', function () {
	$exitCode = Artisan::call('config:clear');
	$exitCode = Artisan::call('cache:clear');
	$exitCode = Artisan::call('config:cache');
	$exitCode = Artisan::call('view:clear');
	Session::flash('success', 'All Clear');
	echo "DONE";
});

Route::get('update-site', function () {
	$data['content'] = 'errors.comming-soon';
	return view('layouts.content', compact('data'));
});

Route::get('/', function () {
	return view('admin.admin-login');
});
Auth::routes();
Route::get('user-profile', 'HomeController@UserProfile');
Route::any('edit-userprofile', 'HomeController@UpdateProfile');

Route::get('home', 'HomeController@index')->name('home');
Route::get('dashboard', 'HomeController@Dashboard');


// Route::prefix('sale')->group(function () 
// {

// 	// Route::get('all-sale',function(){
// 	// 	$data['content'] ='sale.allsale';
// 	// 	return view('layouts.content',compact('data'));
// 	// });
 	// Route::get('invoice',function(){
	// 	$data['content'] ='sale.invoice';
	// return view('layouts.content',compact('data'));
	// });
// 	Route::get('customers',function(){
// 		$data['content'] ='sale.customer';
// 		return view('layouts.content',compact('data'));
// 	});
// 	Route::get('products&services',function(){
// 		$data['content'] ='sale.products-services';
// 		return view('layouts.content',compact('data'));
// 	});
// });

/* Sale */
//sweta
Route::get('sales_order/fetch_sales_order_details/{id}','SalesController@fetch_sales_order_details');
Route::get('sales_order/get_sales_order_details/{id}','SalesController@get_sales_orderdetails');


// All Sales
Route::get('sale/all-sale','SalesController@view_all_sales');
Route::get('sale/all-sale/print/{id}','SalesController@print_all_sales');
Route::post('sale/all-sale/remainder_mail/{id}','SalesController@all_sales_remainder_email');
Route::get('sale/allsales/delivery_challan/{id}','SalesController@all_sales_delivery_challan');
Route::any('sale/invoice/add_new_terms','SalesController@add_new_terms');
// Invoices
Route::get('sale/invoice','SalesController@view_invoices');
Route::post('sale/invoice/add-edit','SalesController@add_edit_invoice');
Route::get('sale/invoice/email/{id}','SalesController@invoice_mail');
Route::get('sale/invoice/print/{id}','SalesController@print_invoice');
Route::get('sale/invoice/delivery_challan/{id}','SalesController@invoice_delivery_challan');
Route::get('sale/invoice/delete/{id}','SalesController@invoice_delete');
Route::get('sale/invoice/get-invoice-details/{id}','SalesController@get_invoice_details');
Route::post('sale/invoice/remainder_mail/{id}','SalesController@invoice_remainder_email');
Route::post('sale/invoice/payment_received','SalesController@receive_payment');
// abhishek 
Route::get('sale/invoice/get-invoice-details_bill/{id}','SalesController@get_invoice_details_bill');
Route::get('sale/invoice/add_new_customer','SalesController@add_new_customer');
Route::post('sale/invoice/add_new_terms','SalesController@add_new_terms');
Route::get('sale/invoice/get-invoice-details_terms/{id}','SalesController@get_terms_details');
Route::get('sale/invoice/get-product-details/{id}','SalesController@get_product_details');
//Customer
Route::get('sale/customers','SalesController@view_customers');
Route::post('sale/customers/add','SalesController@add_customers');
Route::get('sale/customer/delete/{id}','SalesController@delete_customer');
Route::get('sale/customer/view/{id}','SalesController@view_customer');
Route::get('sale/customer_estimate/{id}', 'SalesController@view_customer_statement');
Route::get('sale/customer/get_customer_details/{id}','SalesController@get_customer_details');



//Product & Services
Route::get('sale/products-and-services','SalesController@view_products_and_services');
Route::post('sale/products-and-services/add-edit','SalesController@add_edit_products_and_services');
Route::get('sale/products-and-services/delete/{id}','SalesController@delete_products_and_services');
Route::get('sale/products-and-services/get_products_and_services_details/{id}','SalesController@get_products_and_services_details');


/* Taxes */
// Route::prefix('tax')->group(function () {
// 	Route::any('return', function(){
// 		$data['content'] = 'taxes.return';
// 		return view('layouts.content',compact('data'));
// 	});
	//  Route::any('payment-history', function(){
	//  	$data['content'] = 'taxes.payment_history';
	//  	return view('layouts.content',compact('data'));
	//  });

// });

/* Setting */
	Route::prefix('company')->group(function () {
	Route::resource('', 'CompanyController');
	Route::post('store', 'CompanyController@store');
	Route::get('destroy/{id}', 'CompanyController@destroy');
	Route::any('edit/{id}', 'CompanyController@edit');
	Route::get('setting/user{id}','CompanyController@view');
});


/* Expenses */
Route::get('expenses','ExpensesController@index');
Route::post('expenses/add-edit','ExpensesController@add_edit_expenses');
Route::get('expenses/delete/{id}','ExpensesController@delete_expenses');
Route::get('expenses/get-expanses-details/{id}','ExpensesController@get_expenses_details');

Route::get('expenses/suppliers','ExpensesController@suppliers_index');
Route::post('expenses/suppliers/add-edit','ExpensesController@add_edit_suppliers');
Route::get('expenses/suppliers/delete/{id}','ExpensesController@delete_suppliers');
Route::get('expenses/suppliers/get-suppliers-details/{id}','ExpensesController@get_suppliers_details');


/* employee */
Route::get('employee','EmployeesController@index');
Route::post('employee/add-edit-employee','EmployeesController@add_edit_employee');
Route::get('employee/delete/{id}','EmployeesController@delete_employee');
Route::get('employee/get-employee-details/{id}','EmployeesController@get_employee_details');

//purchase-vendor
Route::get('purchases/vendor','purchaseController@index');
Route::post('purchases/vendor/add_edit_vendor','purchaseController@add_edit_vendor');
Route::get('purchases/vendor/delete/{id}','purchaseController@delete_vendor');
Route::get('purchases/vendor/get-vendor-details/{id}','purchaseController@get_vendor_details');
/* accounting */
// Route::get('accounting', function () {
// 	$data['content'] ='accounting.accounting';
// 	return view('layouts.content',compact('data'));
// });
Route::get('accounting','AccountingController@view_accounting');
Route::post('accounting/add','AccountingController@add_account');
Route::get('accounting/delete/{id}','AccountingController@delete_account');
Route::get('accounting/get_account_details/{id}','AccountingController@get_account_details');
Route::get('accounting/view_accounts','AccountingController@view_accounts');

/* taxes */
Route::post('tax/return/add','TaxesController@insert_tax_return');
Route::get('tax/return/calender','TaxesController@calender');
Route::post('tax/payment-history/add','TaxesController@record_cst_payment');
Route::get('tax/payment-history','TaxesController@tax_payment_history_view');
Route::get('tax/return','TaxesController@tax_return_view');
Route::get('tax/payment-history/delete/{id}','TaxesController@payment_history_del');

Route::get('tax/payment-history/get-payment-details/{id}','TaxesController@get_payment_details');

// purchases

//recurring expanses

Route::get('purchases/recurring-expenses', function () {
	$data['content'] = 'purchases.recurring-expenses';
	return view('layouts.content', compact('data'));
});

//purchase order

// Route::get('purchases/purchase-order', function () {
// 	$data['content'] = 'purchases.purchase-order';
// 	return view('layouts.content', compact('data'));
// });
Route::get('purchases/purchase-order','purchaseController@view_purchase_order');
Route::post('purchases/add','purchaseController@purchase_add');

//bill

Route::get('purchases/bill', function () {
	$data['content'] = 'purchases.bill';
	return view('layouts.content', compact('data'));
});

//payments made

Route::get('purchases/payments-made', function () {
	$data['content'] = 'purchases.payments-made';
	return view('layouts.content', compact('data'));
});

//vendor credits

Route::get('purchases/vendor-credits', function () {
	$data['content'] = 'purchases.vendor-credits';
	return view('layouts.content', compact('data'));
});

//tax rate
Route::get('tools-master/tax_rate', function () {
	$data['content'] = 'tools-master.tax_rate';
	return view('layouts.content', compact('data'));
});


Route::get('tools-master/currency', function () {
	$data['content'] = 'tools-master.currency';
	return view('layouts.content', compact('data'));
});

//customer2


Route::get('sale/customer2', function () {
	$data['content'] = 'sale.customer2';
	return view('layouts.content', compact('data'));
});





// ================================= 18/11/19 abhishek anand ===========================================
Route::get('tools-master/show_country','settingController@view_country');
Route::post('tools-master/add_country','settingController@add_new_country');
Route::post('tools-master/update_country','settingController@update');
Route::get('tools-master/delete_country/{id}','settingController@delete_country');


// state 
Route::get('tools-master/state','settingController@view_state');
Route::post('tools-master/add_new_state','settingController@add_new_state');
Route::post('tools-master/update_state','settingController@update_state');
Route::get('tools-master/delete_state/{id}','settingController@delete_state');


// city
Route::get('tools-master/city','settingController@view_city');
Route::post('tools-master/add_new_city','settingController@add_new_city');
Route::post('tools-master/update_city','settingController@update_city');
Route::get('tools-master/delete_city/{id}','settingController@delete_city');
Route::get('tools-master/fetch_according_to_country/{id}','settingController@fetch_according_to_country');


// time zone 
Route::get('tools-master/show_time_zone','settingController@view_time_zone');
Route::post('tools-master/add_time_zone','settingController@add_time_zone');
Route::post('tools-master/update_time_zone','settingController@update_time_zone');
Route::get('tools-master/delete_time_zone/{id}','settingController@delete_time_zone');

// currency 
Route::get('tools-master/currency','settingController@view_currency');
Route::post('tools-master/add_currency','settingController@add_currency');
Route::post('tools-master/update_currency','settingController@update_currency');
Route::get('tools-master/delete_currency/{id}','settingController@delete_currency');

//department
// tax Rate
Route::get('tools-master/tax_rate','settingController@view_tax_rate');
Route::post('tools-master/add_tax_rate','settingController@add_tax_rate');
Route::post('tools-master/update_tax_rate','settingController@update_tax_rate');
Route::get('tools-master/delete_tax_rate/{id}','settingController@delete_tax_rate');

// customer terms 
Route::get('tools-master/terms','settingController@view_terms');
Route::post('terms/add_new_terms','settingController@add_new_terms');
Route::post('terms/update_terms','settingController@update_terms');
Route::get('terms/delete_terms/{id}','settingController@delete_terms');
//==========Nikhil Setting User=====
Route::get('setting/user', "settingController@index");
Route::post('setting/user/add', "settingController@add_user");
Route::get('setting/user/delete/{id}','settingController@delete_user');
Route::get('setting/user/get_user_details/{id}','settingController@get_user_details');

///////////////////////////nikhil///////////////////////
//add-department
Route::get('tools-master/department','settingController@view_department');
Route::post('tools-master/add_department','settingController@add_department');
Route::get('tools-master/delete/department/{id}','settingController@delete_department');
Route::get('tools-master/get-department-details/{id}','settingController@get_department_details');

//setting-module
Route::get('setting/module','settingController@view_module');
Route::post('setting/module/add','settingController@add_module');
Route::get('setting/module/get-module-details/{id}','settingController@get_module_details');

// user_role

Route::get('setting/user_role','settingController@view_user_role');
Route::post('setting/user_role/add','settingController@add_user_role');
Route::get('setting/user_role/get_user_role_details/{id}','settingController@get_user_role_details');


