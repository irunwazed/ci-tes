<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['login'] = "LoginController/login";
$route['logout'] = "LoginController/logout";
$route['login/cek'] = "LoginController/cekLogin";

$route['user'] = "UserController/beranda";


$route['prediksi/ahp'] = "prediksi/AhpController/daftarAhp";
$route['prediksi/ahp/(:num)'] = "prediksi/AhpController/formAhp/$1";
$route['prediksi/ahp/hapus/(:num)'] = "prediksi/AhpController/deleteAhp/$1";
$route['prediksi/ahp/tambah'] = "prediksi/AhpController/addAhp";
$route['prediksi/ahp/insertrespon'] = "prediksi/AhpController/insertResponAhp";
$route['prediksi/ahp/editrespon'] = "prediksi/AhpController/editResponAhp";
$route['prediksi/ahp/(:num)/hapus/(:num)'] = "prediksi/AhpController/deleteResponAhp/$2/$1";

$route['mpe/(:num)'] = "prediksi/MpeController/daftarMpe/1/$1";

$route['prediksi/mpe'] = "prediksi/MpeController/daftarMpe";
$route['prediksi/mpe/tambah'] = "prediksi/MpeController/addMpe";
$route['prediksi/mpe/(:num)'] = "prediksi/MpeController/formMpe/$1";
$route['prediksi/mpe/hapus/(:num)'] = "prediksi/MpeController/deleteMpe/$1";
$route['prediksi/mpe/(:num)/hapus/(:num)'] = "prediksi/MpeController/deleteRespon/$2/$1";
$route['prediksi/mpe/insertrespon'] = "prediksi/MpeController/insertRespon";
$route['prediksi/mpe/editrespon'] = "prediksi/MpeController/editRespon";
$route['prediksi/mpe/(:num)/save'] = "prediksi/MpeController/savePdf/$1";
$route['prediksi/mpe/(:num)/save/(:num)'] = "prediksi/MpeController/savePdf/$1/$2";

$route['prediksi/finansial'] = "prediksi/FinansialController/daftar";
$route['prediksi/finansial/tambah'] = "prediksi/FinansialController/finansialInput";
$route['prediksi/finansial/hapus/(:num)'] = "prediksi/FinansialController/finansialHapus/$1";
$route['prediksi/finansial/(:num)'] = "prediksi/FinansialController/perhitungan/$1";

$route['prediksi/finansial/penetapan'] = "prediksi/FinansialController/daftarPenetapan";
$route['prediksi/finansial/penetapan/tambah'] = "prediksi/FinansialController/finansialnInputPenetapa";
$route['prediksi/finansial/penetapan/(:num)'] = "prediksi/FinansialController/perhitunganPenetapan/$1";

$route['prediksi/finansial/bahan'] = "prediksi/FinansialController/bahan";
$route['prediksi/finansial/bahan/tambah'] = "prediksi/FinansialController/bahanInput";
$route['prediksi/finansial/bahan/edit'] = "prediksi/FinansialController/bahanEdit";
$route['prediksi/finansial/bahan/hapus/(:num)'] = "prediksi/FinansialController/bahanHapus/$1";

$route['prediksi/ekonomi'] = "prediksi/EkonomiController/perhitungan";

$route['prediksi/bahan/penentuan'] = "prediksi/EkonomiController/bahanPenentuan";
$route['prediksi/bahan/penyedia'] = "prediksi/EkonomiController/bahanAllPenyedia";
$route['prediksi/bahan/penyedia/tambah'] = "prediksi/EkonomiController/bahanPenyediaTambah";
$route['prediksi/bahan/penyedia/edit'] = "prediksi/EkonomiController/bahanPenyediaEdit";
$route['prediksi/bahan/penyedia/hapus/(:num)'] = "prediksi/EkonomiController/bahanPenyediaHapus/$1";
$route['prediksi/bahan/penyedia/(:num)'] = "prediksi/EkonomiController/bahanPenyedia/$1";

$route['bahan/penyedia/(:any)'] = "prediksi/EkonomiController/bahanAllPenyedia/$1";
// $route['bahan/penyedia/rop'] = "prediksi/EkonomiController/bahanAllPenyedia/rop";
// $route['bahan/penyedia/rop'] = "prediksi/EkonomiController/bahanAllPenyedia/kll";
$route['bahan/penyedia/(:any)/(:num)'] = "prediksi/EkonomiController/bahanPenyedia/$2/$1";


$route['prediksi/pendukung/satuan'] = "prediksi/PendukungController/satuan";
$route['prediksi/pendukung/satuan/tambah'] = "prediksi/PendukungController/satuanInput";
$route['prediksi/pendukung/satuan/edit'] = "prediksi/PendukungController/satuanEdit";
$route['prediksi/pendukung/satuan/hapus/(:num)'] = "prediksi/PendukungController/satuanHapus/$1";

$route['prediksi/finansial/get-bahan/(:num)'] = "prediksi/FinansialController/apiGetBahan/$1";

$route['prediksi/finansial/barang/tambah'] = "prediksi/FinansialController/barangInput";
$route['prediksi/finansial/barang/edit'] = "prediksi/FinansialController/barangEdit";
$route['prediksi/finansial/(:num)/barang/hapus/(:num)'] = "prediksi/FinansialController/barangHapus/$2/$1";

$route['prediksi/kebutuhan-air'] = "prediksi/AirController/getData";
$route['prediksi/kebutuhan-air/(:num)'] = "prediksi/AirController/hitung/$1";
$route['prediksi/kebutuhan-air/tambah'] = "prediksi/AirController/create";
$route['prediksi/kebutuhan-air/edit'] = "prediksi/AirController/update";
$route['prediksi/kebutuhan-air/hapus/(:num)'] = "prediksi/AirController/delete/$1";


$route['prediksi/pengguna'] = "prediksi/AdminController/penggunaShow";
$route['prediksi/pengguna/tambah'] = "prediksi/AdminController/penggunaInsert";
$route['prediksi/pengguna/edit'] = "prediksi/AdminController/penggunaUpdate";
$route['prediksi/pengguna/hapus/(:num)'] = "prediksi/AdminController/penggunaDelete/$1";

$route['default_controller'] = 'UserController/beranda';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
