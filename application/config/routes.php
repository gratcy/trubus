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


$route['pembayaran/pembayaran_faktur/?(:num)?'] = 'pembayaran/home/pembayaran_faktur/$1';
$route['pembayaran/?(:num)?'] = 'pembayaran/home/index/$1';
$route['pembayaran/pembayaran_add'] = 'pembayaran/home/pembayaran_add';
$route['pembayaran/pembayaran_update/?(:num)?'] = 'pembayaran/home/pembayaran_update/$1';
$route['pembayaran/pembayaran_delete/(:num)'] = 'pembayaran/home/pembayaran_delete/$1';
$route['pembayaran/pembayaran_excel'] = 'pembayaran/home/pembayaran_excel';
$route['pembayaran/pembayaran_search'] = 'pembayaran/home/pembayaran_search';
$route['pembayaran/pembayaran_search_result/(:any)'] = 'pembayaran/home/pembayaran_search_result/$1';

$route['pembayaran_detail/?(:num)?'] = 'pembayaran_detail/home/index/$1';
$route['pembayaran_details/?(:num)?/?(:num)?'] = 'pembayaran_detail/home/pembayaran_details/$1/$2';
$route['pembayaran_detail/pembayaran_detail_add/?(:num)?/?(:num)?'] = 'pembayaran_detail/home/pembayaran_detail_add/$1/$2';
$route['pembayaran_detail/pembayaran_detail_update/?(:num)?'] = 'pembayaran_detail/home/pembayaran_detail_update/$1';
$route['pembayaran_detail/pembayaran_detail_delete/?(:num)?/?(:num)?'] = 'pembayaran_detail/home/pembayaran_detail_delete/$1/$2';
$route['pembayaran_detail/pembayaran_faktur/?(:num)?'] = 'pembayaran_detail/home/pembayaran_faktur/$1';



$route['hasil_penjualan/?(:num)?'] = 'hasil_penjualan/home/index/$1';
$route['hasil_penjualan/hasil_penjualan_add'] = 'hasil_penjualan/home/hasil_penjualan_add';
$route['hasil_penjualan/hasil_penjualan_update/?(:num)?'] = 'hasil_penjualan/home/hasil_penjualan_update/$1';
$route['hasil_penjualan/hasil_penjualan_delete/(:num)'] = 'hasil_penjualan/home/hasil_penjualan_delete/$1';
$route['hasil_penjualan/hasil_penjualan_excel'] = 'hasil_penjualan/home/hasil_penjualan_excel';
$route['hasil_penjualan/hasil_penjualan_search'] = 'hasil_penjualan/home/hasil_penjualan_search';
$route['hasil_penjualan/hasil_penjualan_search_result/(:any)'] = 'hasil_penjualan/home/hasil_penjualan_search_result/$1';

$route['penjualan_konsinyasi/hasil_penjualan_excel'] = 'penjualan_konsinyasi/home/hasil_penjualan_excel';
$route['penjualan_kredit/hasil_penjualan_excel'] = 'penjualan_kredit/home/hasil_penjualan_excel';
$route['retur_hp/hasil_retur_excel'] = 'retur_hp/home/hasil_retur_excel';
$route['retur_jc/hasil_retur_excel'] = 'retur_jc/home/hasil_retur_excel';
$route['retur_jk/hasil_retur_excel'] = 'retur_jk/home/hasil_retur_excel';
$route['retur_bk/hasil_retur_excel'] = 'retur_bk/home/hasil_retur_excel';


$route['hasil_penjualan_detail/?(:num)?'] = 'hasil_penjualan_detail/home/index/$1';
$route['hasil_penjualan_details/?(:num)?/?(:num)?'] = 'hasil_penjualan_detail/home/hasil_penjualan_details/$1/$2';
$route['hasil_penjualan_detail/hasil_penjualan_detail_add/?(:num)?/?(:num)?'] = 'hasil_penjualan_detail/home/hasil_penjualan_detail_add/$1/$2';
$route['hasil_penjualan_detail/hasil_penjualan_detail_update/?(:num)?'] = 'hasil_penjualan_detail/home/hasil_penjualan_detail_update/$1';
$route['hasil_penjualan_detail/hasil_penjualan_detail_delete/?(:num)?/?(:num)?'] = 'hasil_penjualan_detail/home/hasil_penjualan_detail_delete/$1/$2';
$route['hasil_penjualan_detail/hasil_penjualan_faktur/?(:num)?'] = 'hasil_penjualan_detail/home/hasil_penjualan_faktur/$1';

$route['penjualan_konsinyasi_detail/penjualan_konsinyasi_faktur/?(:num)?'] = 'penjualan_konsinyasi_detail/home/penjualan_konsinyasi_faktur/$1';


$route['pembelian_spo_detail/pembelian_spo_faktur/?(:num)?'] = 'pembelian_spo_detail/home/pembelian_spo_faktur/$1';


$route['penjualan_kredit_detail/penjualan_kredit_faktur/?(:num)?'] = 'penjualan_kredit_detail/home/penjualan_kredit_faktur/$1';
$route['hasil_penjualan_detail/hasil_penjualan_update'] = 'hasil_penjualan_detail/home/hasil_penjualan_update';
$route['penjualan_kredit/?(:num)?'] = 'penjualan_kredit/home/index/$1';
$route['penjualan_kredit/penjualan_kredit_add'] = 'penjualan_kredit/home/penjualan_kredit_add';
$route['penjualan_kredit/penjualan_kredit_addx'] = 'penjualan_kredit/home/penjualan_kredit_addx';
$route['penjualan_kredit/penjualan_kredit_update/?(:num)?'] = 'penjualan_kredit/home/penjualan_kredit_update/$1';
$route['penjualan_kredit/penjualan_kredit_delete/(:num)'] = 'penjualan_kredit/home/penjualan_kredit_delete/$1';
$route['penjualan_kredit/penjualan_kredit_search'] = 'penjualan_kredit/home/penjualan_kredit_search';
$route['penjualan_kredit/penjualan_kredit_search_result/(:any)'] = 'penjualan_kredit/home/penjualan_kredit_search_result/$1';

$route['pembelian_kredit/?(:num)?'] = 'pembelian_kredit/home/index/$1';
$route['penjualan_kredit/index_upload/?(:num)?'] = 'penjualan_kredit/home/index_upload/$1';
$route['penjualan_kredit/index_uploadz'] = 'penjualan_kredit/home/index_uploadz';
$route['penjualan_kredit/upload'] = 'penjualan_kredit/home/upload';
$route['penjualan_kredit/upload_shadow'] = 'penjualan_kredit/home/upload_shadow';
$route['pembelian_kredit/pembelian_kredit_add'] = 'pembelian_kredit/home/pembelian_kredit_add';
$route['pembelian_kredit/pembelian_kredit_update/?(:num)?'] = 'pembelian_kredit/home/pembelian_kredit_update/$1';
$route['pembelian_kredit/pembelian_kredit_delete/(:num)'] = 'pembelian_kredit/home/pembelian_kredit_delete/$1';

$route['pembelian_kredit_detail/?(:num)?'] = 'pembelian_kredit_detail/home/index/$1';
$route['pembelian_kredit_details/?(:num)?'] = 'pembelian_kredit_detail/home/pembelian_kredit_details/$1';
$route['pembelian_kredit_detail/pembelian_kredit_detail_add/?(:num)?'] = 'pembelian_kredit_detail/home/pembelian_kredit_detail_add/$1';
$route['pembelian_kredit_detail/pembelian_kredit_detail_update/?(:num)?'] = 'pembelian_kredit_detail/home/pembelian_kredit_detail_update/$1';
$route['pembelian_kredit_detail/pembelian_kredit_detail_delete/?(:num)?/?(:num)?'] = 'pembelian_kredit_detail/home/pembelian_kredit_detail_delete/$1/$2';
$route['pembelian_kredit_detail/pembelian_kredit_update/?(:num)?'] = 'pembelian_kredit_detail/home/pembelian_kredit_update/$1';



$route['pembelian_spo/?(:num)?'] = 'pembelian_spo/home/index/$1';
$route['pembelian_spo/pembelian_spo_add'] = 'pembelian_spo/home/pembelian_spo_add';
$route['pembelian_spo/pembelian_spo_update/?(:num)?'] = 'pembelian_spo/home/pembelian_spo_update/$1';
$route['pembelian_spo/pembelian_spo_delete/(:num)'] = 'pembelian_spo/home/pembelian_spo_delete/$1';

$route['pembelian_spo_detail/pembelian_spo_detail/(:num)/(:num)'] = 'pembelian_spo_detail/home/pembelian_spo_detail/$1/$2';
$route['pembelian_spo_detail/pembelian_spo_detail_update/(:num)/(:num)/?(:num)?'] = 'pembelian_spo_detail/home/pembelian_spo_detail_update/$1/$2/$3';

$route['pembelian_spo_details/?(:num)?'] = 'pembelian_spo_detail/home/pembelian_spo_details/$1';
$route['pembelian_spo_detail/pembelian_spo_detail_add/(:num)/(:num)/?(:num)?'] = 'pembelian_spo_detail/home/pembelian_spo_detail_add/$1/$2/$3';
$route['pembelian_spo_detail/pembelian_spo_detail_update/?(:num)?'] = 'pembelian_spo_detail/home/pembelian_spo_detail_update/$1';
$route['pembelian_spo_detail/pembelian_spo_detail_delete/(:num)/(:num)/(:num)'] = 'pembelian_spo_detail/home/pembelian_spo_detail_delete/$1/$2/$3';
$route['pembelian_spo_detail/pembelian_spo_update/?(:num)?'] = 'pembelian_spo_detail/home/pembelian_spo_update/$1';




$route['spo/?(:num)?'] = 'spo/home/index/$1';
$route['spo/spo_add'] = 'spo/home/spo_add';
$route['spo/spo_update/?(:num)?'] = 'spo/home/spo_update/$1';
$route['spo/spo_delete/(:num)'] = 'spo/home/spo_delete/$1';

$route['spo_detail/?(:num)?'] = 'spo_detail/home/index/$1';
$route['spo_details/?(:num)?'] = 'spo_detail/home/spo_details/$1';
$route['spo_detail/spo_detail_add/?(:num)?'] = 'spo_detail/home/spo_detail_add/$1';
$route['spo_detail/spo_detail_update/?(:num)?'] = 'spo_detail/home/spo_detail_update/$1';
$route['spo_detail/spo_detail_delete/(:num)'] = 'spo_detail/home/spo_detail_delete/$1';
$route['spo_detail/spo_update/?(:num)?'] = 'spo_detail/home/spo_update/$1';


$route['penjualan_kredit_detail/?(:num)?'] = 'penjualan_kredit_detail/home/index/$1';
$route['penjualan_kredit_details/?(:num)?/?(:num)?'] = 'penjualan_kredit_detail/home/penjualan_kredit_details/$1/$2';
$route['penjualan_kredit_detail/penjualan_kredit_detail_add/?(:num)?/?(:num)?'] = 'penjualan_kredit_detail/home/penjualan_kredit_detail_add/$1/$2';
$route['penjualan_kredit_detail/penjualan_kredit_detail_update/?(:num)?'] = 'penjualan_kredit_detail/home/penjualan_kredit_detail_update/$1';
$route['penjualan_kredit_detail/penjualan_kredit_detail_approval1/?(:num)?'] = 'penjualan_kredit_detail/home/penjualan_kredit_detail_approval1/$1';
$route['penjualan_kredit_detail/penjualan_kredit_detail_approval2/?(:num)?'] = 'penjualan_kredit_detail/home/penjualan_kredit_detail_approval2/$1';
$route['penjualan_kredit_detail/penjualan_kredit_detail_delete/?(:num)?/?(:num)?'] = 'penjualan_kredit_detail/home/penjualan_kredit_detail_delete/$1/$2';
$route['penjualan_kredit_detail/penjualan_kredit_update/?(:num)?'] = 'penjualan_kredit_detail/home/penjualan_kredit_update/$1';


$route['retur_jc_detail/retur_jc_detail_approval1/?(:num)?'] = 'retur_jc_detail/home/retur_jc_detail_approval1/$1';
$route['retur_jc_detail/retur_jc_detail_approval2/?(:num)?'] = 'retur_jc_detail/home/retur_jc_detail_approval2/$1';

$route['retur_jk_detail/retur_jk_detail_approval1/?(:num)?'] = 'retur_jk_detail/home/retur_jk_detail_approval1/$1';
$route['retur_jk_detail/retur_jk_detail_approval2/?(:num)?'] = 'retur_jk_detail/home/retur_jk_detail_approval2/$1';


$route['retur_hp_detail/retur_hp_detail_approval1/?(:num)?'] = 'retur_hp_detail/home/retur_hp_detail_approval1/$1';
$route['retur_hp_detail/retur_hp_detail_approval2/?(:num)?'] = 'retur_hp_detail/home/retur_hp_detail_approval2/$1';

$route['retur_hp_detail/retur_hp_faktur/?(:num)?'] = 'retur_hp_detail/home/retur_hp_faktur/$1';
//$route['hasil_penjualan_detail/hasil_penjualan_update'] = 'hasil_penjualan_detail/home/hasil_penjualan_update';

$route['hasil_penjualan_detail/hasil_penjualan_update/?(:num)?'] = 'hasil_penjualan_detail/home/hasil_penjualan_update/$1';


$route['retur_hp/?(:num)?'] = 'retur_hp/home/index/$1';
$route['retur_hp/retur_hp_add'] = 'retur_hp/home/retur_hp_add';
$route['retur_hp/retur_hp_addx'] = 'retur_hp/home/retur_hp_addx';
$route['retur_hp/retur_hp_update/?(:num)?'] = 'retur_hp/home/retur_hp_update/$1';
$route['retur_hp/retur_hp_delete/(:num)'] = 'retur_hp/home/retur_hp_delete/$1';
$route['retur_hp/retur_hp_search'] = 'retur_hp/home/retur_hp_search';
$route['retur_hp/retur_hp_search_result/(:any)'] = 'retur_hp/home/retur_hp_search_result/$1';



$route['retur_hp_detail/?(:num)?'] = 'retur_hp_detail/home/index/$1';
$route['retur_hp_details/?(:num)?/?(:num)?'] = 'retur_hp_detail/home/retur_hp_details/$1/$2';
$route['retur_hp_detail/retur_hp_detail_add/?(:num)?/?(:num)?'] = 'retur_hp_detail/home/retur_hp_detail_add/$1/$2';
$route['retur_hp_detail/retur_hp_detail_update/?(:num)?'] = 'retur_hp_detail/home/retur_hp_detail_update/$1';
$route['retur_hp_detail/retur_hp_detail_delete/?(:num)?/?(:num)?'] = 'retur_hp_detail/home/retur_hp_detail_delete/$1/$2';
$route['retur_hp_detail/retur_hp_update/?(:num)?'] = 'retur_hp_detail/home/retur_hp_update/$1';


$route['retur_jc_detail/?(:num)?'] = 'retur_jc_detail/home/index/$1';
$route['retur_jc_details/?(:num)?/?(:num)?'] = 'retur_jc_detail/home/retur_jc_details/$1/$2';
$route['retur_jc_detail/retur_jc_detail_add/?(:num)?/?(:num)?'] = 'retur_jc_detail/home/retur_jc_detail_add/$1/$2';
$route['retur_jc_detail/retur_jc_detail_update/?(:num)?'] = 'retur_jc_detail/home/retur_jc_detail_update/$1';
$route['retur_jc_detail/retur_jc_detail_delete/?(:num)?/?(:num)?'] = 'retur_jc_detail/home/retur_jc_detail_delete/$1/$2';
$route['retur_jc_detail/retur_jc_update/?(:num)?'] = 'retur_jc_detail/home/retur_jc_update/$1';



$route['retur_jk_detail/?(:num)?'] = 'retur_jk_detail/home/index/$1';
$route['retur_jk_details/?(:num)?/?(:num)?'] = 'retur_jk_detail/home/retur_jk_details/$1/$2';
$route['retur_jk_detail/retur_jk_detail_add/?(:num)?/?(:num)?'] = 'retur_jk_detail/home/retur_jk_detail_add/$1/$2';
$route['retur_jk_detail/retur_jk_detail_update/?(:num)?'] = 'retur_jk_detail/home/retur_jk_detail_update/$1';
$route['retur_jk_detail/retur_jk_detail_delete/?(:num)?/?(:num)?'] = 'retur_jk_detail/home/retur_jk_detail_delete/$1/$2';
$route['retur_jk_detail/retur_jk_update/?(:num)?'] = 'retur_jk_detail/home/retur_jk_update/$1';


$route['retur_jk_detail/retur_jk_faktur/?(:num)?'] = 'retur_jk_detail/home/retur_jk_faktur/$1';

$route['retur_jc_detail/retur_jc_faktur/?(:num)?'] = 'retur_jc_detail/home/retur_jc_faktur/$1';
$route['hasil_penjualan_detail/hasil_penjualan_update'] = 'hasil_penjualan_detail/home/hasil_penjualan_update';
$route['retur_jc/?(:num)?'] = 'retur_jc/home/index/$1';
$route['retur_jc/retur_jc_add'] = 'retur_jc/home/retur_jc_add';
$route['retur_jc/retur_jc_update/?(:num)?'] = 'retur_jc/home/retur_jc_update/$1';
$route['retur_jc/retur_jc_delete/(:num)'] = 'retur_jc/home/retur_jc_delete/$1';
$route['retur_jc/retur_jc_search'] = 'retur_jc/home/retur_jc_search';
$route['retur_jc/retur_jc_search_result/(:any)'] = 'retur_jc/home/retur_jc_search_result/$1';


$route['retur_jk/?(:num)?'] = 'retur_jk/home/index/$1';
$route['retur_jk/retur_jk_add'] = 'retur_jk/home/retur_jk_add';
$route['retur_jk/retur_jk_update/?(:num)?'] = 'retur_jk/home/retur_jk_update/$1';
$route['retur_jk/retur_jk_delete/(:num)'] = 'retur_jk/home/retur_jk_delete/$1';
$route['retur_jk/retur_jk_search'] = 'retur_jk/home/retur_jk_search';
$route['retur_jk/retur_jk_search_result/(:any)'] = 'retur_jk/home/retur_jk_search_result/$1';


$route['retur_bk_detail/?(:num)?'] = 'retur_bk_detail/home/index/$1';
$route['retur_bk_detail/retur_bk_detail/?(:num)?/?(:num)?'] = 'retur_bk_detail/home/index/$1/$2';
$route['retur_bk_details/?(:num)?'] = 'retur_bk_detail/home/retur_bk_details/$1';
$route['retur_bk_detail/retur_bk_detail_add/?(:num)?/?(:num)?/?(:num)?'] = 'retur_bk_detail/home/retur_bk_detail_add/$1/$2/$3';
$route['retur_bk_detail/retur_bk_detail_update/?(:num)?/?(:num)?/?(:num)?'] = 'retur_bk_detail/home/retur_bk_detail_update/$1/$2/$3';
$route['retur_bk_detail/retur_bk_detail_delete/?(:num)?/?(:num)?/?(:num)?'] = 'retur_bk_detail/home/retur_bk_detail_delete/$1/$2/$3';
$route['retur_bk_detail/retur_bk_update/?(:num)?'] = 'retur_bk_detail/home/retur_bk_update/$1';


$route['retur_bk_detail/retur_bk_faktur/?(:num)?'] = 'retur_bk_detail/home/retur_bk_faktur/$1';
$route['hasil_penjualan_detail/hasil_penjualan_update'] = 'hasil_penjualan_detail/home/hasil_penjualan_update';
$route['retur_bk/?(:num)?'] = 'retur_bk/home/index/$1';
$route['retur_bk/retur_bk_add'] = 'retur_bk/home/retur_bk_add';
$route['retur_bk/retur_bk_update/?(:num)?'] = 'retur_bk/home/retur_bk_update/$1';
$route['retur_bk/retur_bk_delete/(:num)'] = 'retur_bk/home/retur_bk_delete/$1';
$route['retur_bk/retur_bk_search'] = 'retur_bk/home/retur_bk_search';
$route['retur_bk/retur_bk_search_result/(:any)'] = 'retur_bk/home/retur_bk_search_result/$1';




$route['penjualan_konsinyasi/?(:num)?'] = 'penjualan_konsinyasi/home/index/$1';
$route['penjualan_konsinyasi/penjualan_konsinyasi_add'] = 'penjualan_konsinyasi/home/penjualan_konsinyasi_add';
$route['penjualan_konsinyasi/penjualan_konsinyasi_addx'] = 'penjualan_konsinyasi/home/penjualan_konsinyasi_addx';
$route['penjualan_konsinyasi/penjualan_konsinyasi_update/?(:num)?'] = 'penjualan_konsinyasi/home/penjualan_konsinyasi_update/$1';
$route['penjualan_konsinyasi/penjualan_konsinyasi_delete/(:num)'] = 'penjualan_konsinyasi/home/penjualan_konsinyasi_delete/$1';




$route['penjualan_konsinyasi_detail/?(:num)?'] = 'penjualan_konsinyasi_detail/home/index/$1';
$route['penjualan_konsinyasi_details/?(:num)?/?(:num)?'] = 'penjualan_konsinyasi_detail/home/penjualan_konsinyasi_details/$1/$2';
$route['penjualan_konsinyasi_detail/penjualan_konsinyasi_detail_add/?(:num)?/?(:num)?'] = 'penjualan_konsinyasi_detail/home/penjualan_konsinyasi_detail_add/$1/$2';
$route['penjualan_konsinyasi_detail/penjualan_konsinyasi_detail_update/?(:num)?'] = 'penjualan_konsinyasi_detail/home/penjualan_konsinyasi_detail_update/$1';
$route['penjualan_konsinyasi_detail/penjualan_konsinyasi_detail_approval1/?(:num)?'] = 'penjualan_konsinyasi_detail/home/penjualan_konsinyasi_detail_approval1/$1';
$route['penjualan_konsinyasi_detail/penjualan_konsinyasi_detail_approval2/?(:num)?'] = 'penjualan_konsinyasi_detail/home/penjualan_konsinyasi_detail_approval2/$1';
$route['penjualan_konsinyasi_detail/penjualan_konsinyasi_detail_delete/?(:num)?/?(:num)?'] = 'penjualan_konsinyasi_detail/home/penjualan_konsinyasi_detail_delete/$1/$2';
$route['penjualan_konsinyasi_detail/penjualan_konsinyasi_update/?(:num)?'] = 'penjualan_konsinyasi_detail/home/penjualan_konsinyasi_update/$1';
$route['penjualan_konsinyasi/penjualan_konsinyasi_search'] = 'penjualan_konsinyasi/home/penjualan_konsinyasi_search';
$route['penjualan_konsinyasi/penjualan_konsinyasi_search_result/(:any)'] = 'penjualan_konsinyasi/home/penjualan_konsinyasi_search_result/$1';

$route['hasil_penjualan_detail/hasil_penjualan_detail_approval1/?(:num)?'] = 'hasil_penjualan_detail/home/hasil_penjualan_detail_approval1/$1';
$route['hasil_penjualan_detail/hasil_penjualan_detail_approval2/?(:num)?'] = 'hasil_penjualan_detail/home/hasil_penjualan_detail_approval2/$1';

$route['hasil_penjualan/hasil_penjualan_addx'] = 'hasil_penjualan/home/hasil_penjualan_addx';


$route['arsip/?(:num)?'] = 'arsip/home/index/$1';
$route['arsip/arsip_add'] = 'arsip/home/arsip_add';
$route['arsip/arsip_update/?(:num)?'] = 'arsip/home/arsip_update/$1';
$route['arsip/arsip_delete/(:num)'] = 'arsip/home/arsip_delete/$1';
$route['arsip/arsip_search'] = 'arsip/home/arsip_search';
$route['arsip/arsip_search_result/(:any)'] = 'arsip/home/arsip_search_result/$1';
$route['arsip/get_suggestion'] = 'arsip/home/get_suggestion';

$route['categories/?(:num)?'] = 'categories/home/index/$1';
$route['categories/categories_add'] = 'categories/home/categories_add';
$route['categories/categories_update/?(:num)?'] = 'categories/home/categories_update/$1';
$route['categories/categories_delete/(:num)'] = 'categories/home/categories_delete/$1';
$route['categories/categories_search'] = 'categories/home/categories_search';
$route['categories/categories_search_result/(:any)'] = 'categories/home/categories_search_result/$1';
$route['categories/get_suggestion'] = 'categories/home/get_suggestion';

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
$route['books/export/(excel)'] = 'books/home/export/$1';

$route['locator/?(:num)?'] = 'locator/home/index/$1';
$route['locator/locator_add'] = 'locator/home/locator_add';
$route['locator/locator_update/?(:num)?'] = 'locator/home/locator_update/$1';
$route['locator/locator_delete/(:num)'] = 'locator/home/locator_delete/$1';
$route['locator/locator_search'] = 'locator/home/locator_search';
$route['locator/locator_search_result/(:any)'] = 'locator/home/locator_search_result/$1';
$route['locator/get_suggestion'] = 'locator/home/get_suggestion';
$route['locator/books_add/(:num)/?(:num)?'] = 'locator/home/books_add/$1/$2';
$route['locator/books_tmp/(:num)'] = 'locator/home/books_tmp/$1';
$route['locator/books_delete/(:num)'] = 'locator/home/books_delete/$1';
$route['locator/books_search'] = 'locator/home/books_search';
$route['locator/books_search_result/(:num)/(:any)/?(:num)?'] = 'locator/home/books_search_result/$1/$2/$3';

$route['publisher/?(:num)?'] = 'publisher/home/index/$1';
$route['publisher/publisher_add'] = 'publisher/home/publisher_add';
$route['publisher/publisher_update/?(:num)?'] = 'publisher/home/publisher_update/$1';
$route['publisher/publisher_delete/(:num)'] = 'publisher/home/publisher_delete/$1';
$route['publisher/publisher_search'] = 'publisher/home/publisher_search';
$route['publisher/publisher_search_result/(:any)'] = 'publisher/home/publisher_search_result/$1';
$route['publisher/get_suggestion'] = 'publisher/home/get_suggestion';
$route['publisher/get_description'] = 'publisher/home/get_description';
$route['publisher/export/(excel)'] = 'publisher/home/export/$1';

$route['coa/?(:num)?'] = 'coa/home/index/$1';
$route['coa/coa_add'] = 'coa/home/coa_add';
$route['coa/coa_update/?(:num)?'] = 'coa/home/coa_update/$1';
$route['coa/coa_delete/(:num)'] = 'coa/home/coa_delete/$1';

$route['inventory/?(:num)?'] = 'inventory/home/index/$1';
$route['inventory/export_excel'] = 'inventory/home/export_excel';
$route['inventory/inventory_add'] = 'inventory/home/inventory_add';
$route['inventory/inventory_update/?(:num)?'] = 'inventory/home/inventory_update/$1';
$route['inventory/inventory_delete/(:num)'] = 'inventory/home/inventory_delete/$1';
$route['inventory/card_stock/?(:num)?/?(:num)?'] = 'inventory/home/card_stock/$1/$2';
$route['inventory/inventory_search'] = 'inventory/home/inventory_search';
$route['inventory/inventory_search_result/(:any)'] = 'inventory/home/inventory_search_result/$1';

$route['inventory_shadow/?(:num)?'] = 'inventory_shadow/home/index/$1';
$route['inventory_shadow/inventory_shadow_add'] = 'inventory_shadow/home/inventory_shadow_add';
$route['inventory_shadow/inventory_shadow_update/?(:num)?'] = 'inventory_shadow/home/inventory_shadow_update/$1';
$route['inventory_shadow/inventory_shadow_delete/(:num)'] = 'inventory_shadow/home/inventory_shadow_delete/$1';
$route['inventory_shadow/card_stock/?(:num)?/?(:num)?'] = 'inventory_shadow/home/card_stock/$1/$2';
$route['inventory_shadow/inventory_shadow_search'] = 'inventory_shadow/home/inventory_shadow_search';
$route['inventory_shadow/inventory_shadow_search_result/(:any)'] = 'inventory_shadow/home/inventory_shadow_search_result/$1';

$route['inventory_customer/?(:num)?'] = 'inventory_customer/home/index/$1';
$route['inventory_customer/inventory_customer_add/?(:num)?'] = 'inventory_customer/home/inventory_customer_add/$1';
$route['inventory_customer/inventory_customer_detail/?(:num)?/?(:num)?'] = 'inventory_customer/home/inventory_customer_detail/$1/$2';
$route['inventory_customer/inventory_customer_update/?(:num)?'] = 'inventory_customer/home/inventory_customer_update/$1';
$route['inventory_customer/inventory_customer_delete/(:num)'] = 'inventory_customer/home/inventory_customer_delete/$1';
$route['inventory_customer/inventory_customer_search'] = 'inventory_customer/home/inventory_customer_search';
$route['inventory_customer/inventory_customer_search_detail'] = 'inventory_customer/home/inventory_customer_search_detail';
$route['inventory_customer/inventory_customer_search_result/(:any)'] = 'inventory_customer/home/inventory_customer_search_result/$1';
$route['inventory_customer/inventory_customer_search_detail_result/(:num)/(:any)'] = 'inventory_customer/home/inventory_customer_search_detail_result/$1/$2';
$route['inventory_customer/export/(:num)/(excel|html)'] = 'inventory_customer/home/export/$1/$2';

$route['adjustment/?(:num)?'] = 'adjustment/home/index/$1';
$route['adjustment/adjustment_add/(:num)'] = 'adjustment/home/adjustment_add/$1';

$route['opname/?(:num)?'] = 'opname/home/index/$1';
$route['opname/opname_update/?(:num)?'] = 'opname/home/opname_update/$1';
$route['opname/opname_search'] = 'opname/home/opname_search';
$route['opname/opname_search_result/(:any)'] = 'opname/home/opname_search_result/$1';

$route['opnamecustomer/?(:num)?'] = 'opnamecustomer/home/index/$1';
$route['opnamecustomer/opnamecustomer_detail/?(:num)?/?(:num)?'] = 'opnamecustomer/home/opnamecustomer_detail/$1/$2';
$route['opnamecustomer/opnamecustomer_update/?(:num)?'] = 'opnamecustomer/home/opnamecustomer_update/$1';
$route['opnamecustomer/opnamecustomer_search'] = 'opnamecustomer/home/opnamecustomer_search';
$route['opnamecustomer/opnamecustomer_search_result/(:any)'] = 'opnamecustomer/home/opnamecustomer_search_result/$1';

$route['customer/?(:num)?'] = 'customer/home/index/$1';
$route['customer/customer_add'] = 'customer/home/customer_add';
$route['customer/customer_update/?(:num)?'] = 'customer/home/customer_update/$1';
$route['customer/customer_delete/(:num)'] = 'customer/home/customer_delete/$1';
$route['customer/customer_search'] = 'customer/home/customer_search';
$route['customer/customer_search_result/(:any)'] = 'customer/home/customer_search_result/$1';
$route['customer/get_suggestion'] = 'customer/home/get_suggestion';
$route['customer/export/(excel)'] = 'customer/home/export/$1';

$route['reportopname/?(:num)?/?(:num)?'] = 'reportopname/home/index/$1/$2';
$route['reportopname/sortreport/?(:num)?/?(:num)?'] = 'reportopname/home/sortreport/$1/$2';

$route['reportopnamecustomer/?(:num)?'] = 'reportopnamecustomer/home/index/$1';
$route['reportopnamecustomer/sortreport/?(:num)?/?(:num)?'] = 'reportopnamecustomer/home/sortreport/$1/$2';

$route['reportstock/?(:num)?'] = 'reportstock/home/index/$1';
$route['reportstock/sortreport/?(:num)?/?(:num)?'] = 'reportstock/home/sortreport/$1/$2';
$route['reportstock/stock_export/?(:num)?/?(:num)?'] = 'reportstock/home/stock_export/$1/$2';

$route['reportstockcustomer/?(:num)?'] = 'reportstockcustomer/home/index/$1';
$route['reportstockcustomer/sortreport/?(:num)?/?(:num)?'] = 'reportstockcustomer/home/sortreport/$1/$2';

$route['reportcardstock'] = 'reportcardstock/home/index';
$route['reportcardstock/print_card_stock'] = 'reportcardstock/home/print_card_stock';

$route['reportitemreceiving'] = 'reportitemreceiving/home/index';
$route['reportitemreceiving/export/(html|excel)'] = 'reportitemreceiving/home/export/$1';

$route['reportingstock'] = 'reportingstock/home/index';
$route['reportingtock/print_reporting_stock'] = 'reportingstock/home/print_reporting_stock';

$route['request/?(:num)?'] = 'request/home/index/$1';
$route['request/request_add'] = 'request/home/request_add';
$route['request/request_update/?(:num)?'] = 'request/home/request_update/$1';
$route['request/request_delete/(:num)'] = 'request/home/request_delete/$1';
$route['request/request_detail/(:num)'] = 'request/home/request_detail/$1';
$route['request/request_books/?(:num)?'] = 'request/home/request_books/$1';
$route['request/request_list_books/(:num)/?(:num)?/?(:num)?'] = 'request/home/request_list_books/$1/$2/$3';
$route['request/request_books_delete/(:num)'] = 'request/home/request_books_delete/$1';
$route['request/request_books_add/(:num)'] = 'request/home/request_books_add/$1';
$route['request/export/(excel|excel_detail)/?(:num)?'] = 'request/home/export/$1/$2';
$route['request/request_search'] = 'request/home/request_search';
$route['request/request_search_result/(:any)'] = 'request/home/request_search_result/$1';
$route['request/get_suggestion'] = 'request/home/get_suggestion';

$route['receiving/?(:num)?'] = 'receiving/home/index/$1';
$route['receiving/receiving_add'] = 'receiving/home/receiving_add';
$route['receiving/receiving_update/?(:num)?'] = 'receiving/home/receiving_update/$1';
$route['receiving/receiving_delete/(:num)'] = 'receiving/home/receiving_delete/$1';
$route['receiving/receiving_detail/(:num)'] = 'receiving/home/receiving_detail/$1';
$route['receiving/receiving_types/(:num)/?(:num)?'] = 'receiving/home/receiving_types/$1/$2';
$route['receiving/receiving_books/?(:num)?'] = 'receiving/home/receiving_books/$1';
$route['receiving/receiving_list_books/(:num)/?(:num)?'] = 'receiving/home/receiving_list_books/$1/$2';
$route['receiving/receiving_books_add/(:num)'] = 'receiving/home/receiving_books_add/$1';
$route['receiving/receiving_books_delete/(:num)'] = 'receiving/home/receiving_books_delete/$1';
$route['receiving/export/(excel|excel_detail)/?(:num)?'] = 'receiving/home/export/$1/$2';

$route['transfer/?(:num)?'] = 'transfer/home/index/$1';
$route['transfer/transfer_add'] = 'transfer/home/transfer_add';
$route['transfer/transfer_update/?(:num)?'] = 'transfer/home/transfer_update/$1';
$route['transfer/transfer_delete/(:num)'] = 'transfer/home/transfer_delete/$1';
$route['transfer/transfer_detail/(:num)'] = 'transfer/home/transfer_detail/$1';
$route['transfer/transfer_request_books/(:num)'] = 'transfer/home/transfer_request_books/$1';
$route['transfer/export/(excel|excel_detail)/?(:num)?'] = 'transfer/home/export/$1/$2';
$route['transfer/transfer_search'] = 'transfer/home/transfer_search';
$route['transfer/transfer_search_result/(:any)'] = 'transfer/home/transfer_search_result/$1';
$route['transfer/get_suggestion'] = 'transfer/home/get_suggestion';

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

$route['printpage/(penawaran|letter|receiving|dist_request|dist_transfer)/(:num)'] = 'printpage/home/$1/$2';

$route['coa/?(:num)?'] = 'coa/home/index/$1';
$route['coa/coa_add'] = 'coa/home/coa_add';
$route['coa/coa_update/?(:num)?'] = 'coa/home/coa_update/$1';
$route['coa/coa_delete/(:num)'] = 'coa/home/coa_delete/$1';

$route['coagroup/?(:num)?'] = 'coagroup/home/index/$1';
$route['coagroup/coagroup_add'] = 'coagroup/home/coagroup_add';
$route['coagroup/coagroup_update/?(:num)?'] = 'coagroup/home/coagroup_update/$1';
$route['coagroup/coagroup_delete/(:num)'] = 'coagroup/home/coagroup_delete/$1';

$route['closingperiod'] = 'closingperiod/home';
$route['generalledger'] = 'generalledger/home';

$route['journal/?(:num)?'] = 'journal/home/index/$1';
$route['journal/journal_add'] = 'journal/home/journal_add';
$route['journal/journal_update/?(:num)?'] = 'journal/home/journal_update/$1';
$route['journal/journal_delete/(:num)'] = 'journal/home/journal_delete/$1';
$route['journal/journal_child_delete/(:num)'] = 'journal/home/journal_child_delete/$1';

/* End of file routes.php */
/* Location: ./application/config/routes.php */
