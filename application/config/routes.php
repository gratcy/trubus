<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "home";
$route['404_override'] = '';

$route['login'] = 'login/home';
$route['login/logging'] = 'login/home/logging';
$route['login/logout'] = 'login/home/logout';

$route['settings'] = 'settings/home';
$route['settings/settings'] = 'settings/home/settings';

$route['users/?(:num)?'] = 'users/home/index/$1';
$route['users/users_add'] = 'users/home/users_add';
$route['users/users_update/?(:num)?'] = 'users/home/users_update/$1';
$route['users/users_delete/(:num)'] = 'users/home/users_delete/$1';
$route['users/users_group/?(:num)?'] = 'users/home/users_group/$1';
$route['users/users_group_add'] = 'users/home/users_group_add';
$route['users/users_group_update/?(:num)?'] = 'users/home/users_group_update/$1';
$route['users/users_group_delete/(:num)'] = 'users/home/users_group_delete/$1';

$route['branch/?(:num)?'] = 'branch/home/index/$1';
$route['branch/branch_add'] = 'branch/home/branch_add';
$route['branch/branch_update/?(:num)?'] = 'branch/home/branch_update/$1';
$route['branch/branch_delete/(:num)'] = 'branch/home/branch_delete/$1';
$route['branch/branch_search'] = 'branch/home/branch_search';
$route['branch/branch_search_result/(:any)'] = 'branch/home/branch_search_result/$1';
$route['branch/get_suggestion'] = 'branch/home/get_suggestion';

$route['hasil_penjualan/?(:num)?'] = 'hasil_penjualan/home/index/$1';
$route['hasil_penjualan/hasil_penjualan_add'] = 'hasil_penjualan/home/hasil_penjualan_add';
$route['hasil_penjualan/hasil_penjualan_update/?(:num)?'] = 'hasil_penjualan/home/hasil_penjualan_update/$1';
$route['hasil_penjualan/hasil_penjualan_delete/(:num)'] = 'hasil_penjualan/home/hasil_penjualan_delete/$1';

$route['hasil_penjualan_detail/?(:num)?'] = 'hasil_penjualan_detail/home/index/$1';
$route['hasil_penjualan_details/?(:num)?'] = 'hasil_penjualan_detail/home/hasil_penjualan_details/$1';
$route['hasil_penjualan_detail/hasil_penjualan_detail_add/?(:num)?'] = 'hasil_penjualan_detail/home/hasil_penjualan_detail_add/$1';
$route['hasil_penjualan_detail/hasil_penjualan_detail_update/?(:num)?'] = 'hasil_penjualan_detail/home/hasil_penjualan_detail_update/$1';
$route['hasil_penjualan_detail/hasil_penjualan_detail_delete/(:num)'] = 'hasil_penjualan_detail/home/hasil_penjualan_detail_delete/$1';
$route['hasil_penjualan_detail/hasil_penjualan_faktur/?(:num)?'] = 'hasil_penjualan_detail/home/hasil_penjualan_faktur/$1';

$route['penjualan_kredit_detail/penjualan_kredit_faktur/?(:num)?'] = 'penjualan_kredit_detail/home/penjualan_kredit_faktur/$1';
$route['hasil_penjualan_detail/hasil_penjualan_update'] = 'hasil_penjualan_detail/home/hasil_penjualan_update';
$route['penjualan_kredit/?(:num)?'] = 'penjualan_kredit/home/index/$1';
$route['penjualan_kredit/penjualan_kredit_add'] = 'penjualan_kredit/home/penjualan_kredit_add';
$route['penjualan_kredit/penjualan_kredit_update/?(:num)?'] = 'penjualan_kredit/home/penjualan_kredit_update/$1';
$route['penjualan_kredit/penjualan_kredit_delete/(:num)'] = 'penjualan_kredit/home/penjualan_kredit_delete/$1';

$route['pembelian_kredit/?(:num)?'] = 'pembelian_kredit/home/index/$1';
$route['pembelian_kredit/pembelian_kredit_add'] = 'pembelian_kredit/home/pembelian_kredit_add';
$route['pembelian_kredit/pembelian_kredit_update/?(:num)?'] = 'pembelian_kredit/home/pembelian_kredit_update/$1';
$route['pembelian_kredit/pembelian_kredit_delete/(:num)'] = 'pembelian_kredit/home/pembelian_kredit_delete/$1';

$route['pembelian_kredit_detail/?(:num)?'] = 'pembelian_kredit_detail/home/index/$1';
$route['pembelian_kredit_details/?(:num)?'] = 'pembelian_kredit_detail/home/pembelian_kredit_details/$1';
$route['pembelian_kredit_detail/pembelian_kredit_detail_add/?(:num)?'] = 'pembelian_kredit_detail/home/pembelian_kredit_detail_add/$1';
$route['pembelian_kredit_detail/pembelian_kredit_detail_update/?(:num)?'] = 'pembelian_kredit_detail/home/pembelian_kredit_detail_update/$1';
$route['pembelian_kredit_detail/pembelian_kredit_detail_delete/(:num)'] = 'pembelian_kredit_detail/home/pembelian_kredit_detail_delete/$1';
$route['pembelian_kredit_detail/pembelian_kredit_update/?(:num)?'] = 'pembelian_kredit_detail/home/pembelian_kredit_update/$1';

$route['penjualan_kredit_detail/?(:num)?'] = 'penjualan_kredit_detail/home/index/$1';
$route['penjualan_kredit_details/?(:num)?'] = 'penjualan_kredit_detail/home/penjualan_kredit_details/$1';
$route['penjualan_kredit_detail/penjualan_kredit_detail_add/?(:num)?'] = 'penjualan_kredit_detail/home/penjualan_kredit_detail_add/$1';
$route['penjualan_kredit_detail/penjualan_kredit_detail_update/?(:num)?'] = 'penjualan_kredit_detail/home/penjualan_kredit_detail_update/$1';
$route['penjualan_kredit_detail/penjualan_kredit_detail_delete/(:num)'] = 'penjualan_kredit_detail/home/penjualan_kredit_detail_delete/$1';
$route['penjualan_kredit_detail/penjualan_kredit_update/?(:num)?'] = 'penjualan_kredit_detail/home/penjualan_kredit_update/$1';

$route['penjualan_konsinyasi/?(:num)?'] = 'penjualan_konsinyasi/home/index/$1';
$route['penjualan_konsinyasi/penjualan_konsinyasi_add'] = 'penjualan_konsinyasi/home/penjualan_konsinyasi_add';
$route['penjualan_konsinyasi/penjualan_konsinyasi_update/?(:num)?'] = 'penjualan_konsinyasi/home/penjualan_konsinyasi_update/$1';
$route['penjualan_konsinyasi/penjualan_konsinyasi_delete/(:num)'] = 'penjualan_konsinyasi/home/penjualan_konsinyasi_delete/$1';

$route['arsip/?(:num)?'] = 'arsip/home/index/$1';
$route['arsip/arsip_add'] = 'arsip/home/arsip_add';
$route['arsip/arsip_update/?(:num)?'] = 'arsip/home/arsip_update/$1';
$route['arsip/arsip_delete/(:num)'] = 'arsip/home/arsip_delete/$1';
$route['arsip/arsip_search'] = 'arsip/home/arsip_search';
$route['arsip/arsip_search_result/(:any)'] = 'arsip/home/arsip_search_result/$1';
$route['arsip/get_suggestion'] = 'arsip/home/get_suggestion';

$route['category_arsip/?(:num)?'] = 'category_arsip/home/index/$1';
$route['category_arsip/category_arsip_add'] = 'category_arsip/home/category_arsip_add';
$route['category_arsip/category_arsip_update/?(:num)?'] = 'category_arsip/home/category_arsip_update/$1';
$route['category_arsip/category_arsip_delete/(:num)'] = 'category_arsip/home/category_arsip_delete/$1';
$route['category_arsip/category_arsip_search'] = 'category_arsip/home/category_arsip_search';
$route['category_arsip/category_arsip_search_result/(:any)'] = 'category_arsip/home/category_arsip_search_result/$1';
$route['category_arsip/get_suggestion'] = 'category_arsip/home/get_suggestion';

$route['tax/?(:num)?'] = 'tax/home/index/$1';
$route['tax/tax_add'] = 'tax/home/tax_add';
$route['tax/tax_update/?(:num)?'] = 'tax/home/tax_update/$1';
$route['tax/tax_delete/(:num)'] = 'tax/home/tax_delete/$1';

$route['promo/?(:num)?'] = 'promo/home/index/$1';
$route['promo/promo_add'] = 'promo/home/promo_add';
$route['promo/promo_update/?(:num)?'] = 'promo/home/promo_update/$1';
$route['promo/promo_delete/(:num)'] = 'promo/home/promo_delete/$1';

$route['city/?(:num)?'] = 'city/home/index/$1';
$route['city/city_add'] = 'city/home/city_add';
$route['city/city_update/?(:num)?'] = 'city/home/city_update/$1';
$route['city/city_delete/(:num)'] = 'city/home/city_delete/$1';

$route['province/?(:num)?'] = 'province/home/index/$1';
$route['province/province_add'] = 'province/home/province_add';
$route['province/province_update/?(:num)?'] = 'province/home/province_update/$1';
$route['province/province_delete/(:num)'] = 'province/home/province_delete/$1';

$route['catalog/?(:num)?'] = 'catalog/home/index/$1';
$route['catalog/catalog_add'] = 'catalog/home/catalog_add';
$route['catalog/catalog_update/?(:num)?'] = 'catalog/home/catalog_update/$1';
$route['catalog/catalog_delete/(:num)'] = 'catalog/home/catalog_delete/$1';
$route['catalog/catalog_search'] = 'catalog/home/catalog_search';
$route['catalog/catalog_search_result/(:any)'] = 'catalog/home/catalog_search_result/$1';
$route['catalog/get_suggestion'] = 'catalog/home/get_suggestion';
$route['catalog/books_add/(:num)'] = 'catalog/home/books_add/$1';
$route['catalog/books_tmp/(:num)'] = 'catalog/home/books_tmp/$1';
$route['catalog/books_delete/(:num)'] = 'catalog/home/books_delete/$1';
$route['catalog/books_search'] = 'catalog/home/books_search';
$route['catalog/books_search_result/(:num)/(:any)'] = 'catalog/home/books_search_result/$1/$2';

$route['area/?(:num)?'] = 'area/home/index/$1';
$route['area/area_add'] = 'area/home/area_add';
$route['area/area_update/?(:num)?'] = 'area/home/area_update/$1';
$route['area/area_delete/(:num)'] = 'area/home/area_delete/$1';
$route['area/area_search'] = 'area/home/area_search';
$route['area/area_search_result/(:any)'] = 'area/home/area_search_result/$1';
$route['area/get_suggestion'] = 'area/home/get_suggestion';

$route['books_group/?(:num)?'] = 'books_group/home/index/$1';
$route['books_group/books_group_add'] = 'books_group/home/books_group_add';
$route['books_group/books_group_update/?(:num)?'] = 'books_group/home/books_group_update/$1';
$route['books_group/books_group_delete/(:num)'] = 'books_group/home/books_group_delete/$1';
$route['books_group/books_group_search'] = 'books_group/home/books_group_search';
$route['books_group/books_group_search_result/(:any)'] = 'books_group/home/books_group_search_result/$1';
$route['books_group/get_suggestion'] = 'books_group/home/get_suggestion';

$route['books/?(:num)?'] = 'books/home/index/$1';
$route['books/books_add'] = 'books/home/books_add';
$route['books/books_update/?(:num)?'] = 'books/home/books_update/$1';
$route['books/books_delete/(:num)'] = 'books/home/books_delete/$1';
$route['books/books_search'] = 'books/home/books_search';
$route['books/books_search_result/(:any)'] = 'books/home/books_search_result/$1';
$route['books/get_suggestion'] = 'books/home/get_suggestion';

$route['locator/?(:num)?'] = 'locator/home/index/$1';
$route['locator/locator_add'] = 'locator/home/locator_add';
$route['locator/locator_update/?(:num)?'] = 'locator/home/locator_update/$1';
$route['locator/locator_delete/(:num)'] = 'locator/home/locator_delete/$1';
$route['locator/locator_search'] = 'locator/home/locator_search';
$route['locator/locator_search_result/(:any)'] = 'locator/home/locator_search_result/$1';
$route['locator/get_suggestion'] = 'locator/home/get_suggestion';
$route['locator/books_add/(:num)'] = 'locator/home/books_add/$1';
$route['locator/books_tmp/(:num)'] = 'locator/home/books_tmp/$1';
$route['locator/books_delete/(:num)'] = 'locator/home/books_delete/$1';
$route['locator/books_search'] = 'locator/home/books_search';
$route['locator/books_search_result/(:num)/(:any)'] = 'locator/home/books_search_result/$1/$2';

$route['publisher/?(:num)?'] = 'publisher/home/index/$1';
$route['publisher/publisher_add'] = 'publisher/home/publisher_add';
$route['publisher/publisher_update/?(:num)?'] = 'publisher/home/publisher_update/$1';
$route['publisher/publisher_delete/(:num)'] = 'publisher/home/publisher_delete/$1';
$route['publisher/publisher_search'] = 'publisher/home/publisher_search';
$route['publisher/publisher_search_result/(:any)'] = 'publisher/home/publisher_search_result/$1';
$route['publisher/get_suggestion'] = 'publisher/home/get_suggestion';

$route['coa/?(:num)?'] = 'coa/home/index/$1';
$route['coa/coa_add'] = 'coa/home/coa_add';
$route['coa/coa_update/?(:num)?'] = 'coa/home/coa_update/$1';
$route['coa/coa_delete/(:num)'] = 'coa/home/coa_delete/$1';

$route['inventory/?(:num)?'] = 'inventory/home/index/$1';
$route['inventory/inventory_add'] = 'inventory/home/inventory_add';
$route['inventory/inventory_update/?(:num)?'] = 'inventory/home/inventory_update/$1';
$route['inventory/inventory_delete/(:num)'] = 'inventory/home/inventory_delete/$1';

$route['inventory/card_stock/?(:num)?'] = 'inventory/home/card_stock/$1';

$route['inventory_customer/?(:num)?'] = 'inventory_customer/home/index/$1';
$route['inventory_customer/inventory_customer_add/?(:num)?'] = 'inventory_customer/home/inventory_customer_add/$1';
$route['inventory_customer/inventory_customer_detail/?(:num)?/?(:num)?'] = 'inventory_customer/home/inventory_customer_detail/$1/$2';
$route['inventory_customer/inventory_customer_update/?(:num)?'] = 'inventory_customer/home/inventory_customer_update/$1';
$route['inventory_customer/inventory_customer_delete/(:num)'] = 'inventory_customer/home/inventory_customer_delete/$1';

$route['adjustment/?(:num)?'] = 'adjustment/home/index/$1';
$route['adjustment/adjustment_add/(:num)'] = 'adjustment/home/adjustment_add/$1';

$route['opname/?(:num)?'] = 'opname/home/index/$1';
$route['opname/opname_update/?(:num)?'] = 'opname/home/opname_update/$1';

$route['opnamecustomer/?(:num)?'] = 'opnamecustomer/home/index/$1';
$route['opnamecustomer/opnamecustomer_detail/?(:num)?/?(:num)?'] = 'opnamecustomer/home/opnamecustomer_detail/$1/$2';
$route['opnamecustomer/opnamecustomer_update/?(:num)?'] = 'opnamecustomer/home/opnamecustomer_update/$1';

$route['customer/?(:num)?'] = 'customer/home/index/$1';
$route['customer/customer_add'] = 'customer/home/customer_add';
$route['customer/customer_update/?(:num)?'] = 'customer/home/customer_update/$1';
$route['customer/customer_delete/(:num)'] = 'customer/home/customer_delete/$1';
$route['customer/customer_search'] = 'customer/home/customer_search';
$route['customer/customer_search_result/(:any)'] = 'customer/home/customer_search_result/$1';
$route['customer/get_suggestion'] = 'customer/home/get_suggestion';

$route['reportopname/?(:num)?'] = 'reportopname/home/index/$1';
$route['reportopname/sortreport/?(:num)?/?(:num)?'] = 'reportopname/home/sortreport/$1/$2';

$route['reportopnamecustomer/?(:num)?'] = 'reportopnamecustomer/home/index/$1';
$route['reportopnamecustomer/sortreport/?(:num)?/?(:num)?'] = 'reportopnamecustomer/home/sortreport/$1/$2';

$route['reportstock/?(:num)?'] = 'reportstock/home/index/$1';
$route['reportstock/sortreport/?(:num)?/?(:num)?'] = 'reportstock/home/sortreport/$1/$2';
$route['reportstock/stock_export/?(:num)?/?(:num)?'] = 'reportstock/home/stock_export/$1/$2';

$route['reportstockcustomer/?(:num)?'] = 'reportstockcustomer/home/index/$1';
$route['reportstockcustomer/sortreport/?(:num)?/?(:num)?'] = 'reportstockcustomer/home/sortreport/$1/$2';

$route['request/?(:num)?'] = 'request/home/index/$1';
$route['request/request_add'] = 'request/home/request_add';
$route['request/request_update/?(:num)?'] = 'request/home/request_update/$1';
$route['request/request_delete/(:num)'] = 'request/home/request_delete/$1';
$route['request/request_detail/(:num)'] = 'request/home/request_detail/$1';
$route['request/request_books/?(:num)?'] = 'request/home/request_books/$1';
$route['request/request_list_books/(:num)/?(:num)?'] = 'request/home/request_list_books/$1/$2';
$route['request/request_books_delete/(:num)'] = 'request/home/request_books_delete/$1';
$route['request/request_books_add/(:num)'] = 'request/home/request_books_add/$1';

$route['receiving/?(:num)?'] = 'receiving/home/index/$1';
$route['receiving/receiving_add'] = 'receiving/home/receiving_add';
$route['receiving/receiving_update/?(:num)?'] = 'receiving/home/receiving_update/$1';
$route['receiving/receiving_delete/(:num)'] = 'receiving/home/receiving_delete/$1';
$route['receiving/receiving_detail/(:num)'] = 'receiving/home/receiving_detail/$1';
$route['receiving/receiving_types/(:num)'] = 'receiving/home/receiving_types/$1';
$route['receiving/receiving_books/?(:num)?'] = 'receiving/home/receiving_books/$1';
$route['receiving/receiving_list_books/(:num)/?(:num)?'] = 'receiving/home/receiving_list_books/$1/$2';
$route['receiving/receiving_books_add/(:num)'] = 'receiving/home/receiving_books_add/$1';
$route['receiving/receiving_books_delete/(:num)'] = 'receiving/home/receiving_books_delete/$1';

$route['transfer/?(:num)?'] = 'transfer/home/index/$1';
$route['transfer/transfer_add'] = 'transfer/home/transfer_add';
$route['transfer/transfer_update/?(:num)?'] = 'transfer/home/transfer_update/$1';
$route['transfer/transfer_delete/(:num)'] = 'transfer/home/transfer_delete/$1';
$route['transfer/transfer_detail/(:num)'] = 'transfer/home/transfer_detail/$1';
$route['transfer/transfer_request_books/(:num)'] = 'transfer/home/transfer_request_books/$1';

$route['letter/?(:num)?'] = 'letter/home/index/$1';
$route['letter/letter_add'] = 'letter/home/letter_add';
$route['letter/letter_update/?(:num)?'] = 'letter/home/letter_update/$1';
$route['letter/letter_delete/(:num)'] = 'letter/home/letter_delete/$1';
$route['letter/letter_types/(:num)'] = 'letter/home/letter_types/$1';
$route['letter/letter_books/(:num)/(:num)'] = 'letter/home/letter_books/$1/$2';

$route['pm/?(:num)?'] = 'pm/home/index/$1';
$route['pm/outbox/?(:num)?'] = 'pm/home/outbox/$1';
$route['pm/pm_read/(:num)'] = 'pm/home/pm_read/$1';
$route['pm/pm_reply/(:num)'] = 'pm/home/pm_reply/$1';
$route['pm/pm_new'] = 'pm/home/pm_new';
$route['pm/get_suggestion'] = 'pm/home/get_suggestion';
$route['pm/pm_delete/(:num)/(:num)'] = 'pm/home/pm_delete/$1/$2';

$route['printpage/(penawaran|letter)/(:num)'] = 'printpage/home/$1/$2';

$route['journal/?(:num)?'] = 'journal/home/index/$1';
$route['journal/journal_export/?(:num)?'] = 'journal/home/journal_export/$1';

/* End of file routes.php */
/* Location: ./application/config/routes.php */
