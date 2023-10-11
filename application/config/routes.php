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
$route['default_controller'] = 'home/index';
$route['404_override'] = '404';
$route['translate_uri_dashes'] = FALSE;


$route['key'] = 'articles/key';

$route['articles/(:num)'] = 'articles/index/$1';
$route['articles/tags/(:any)'] = 'articles/tags/$1';
$route['articles/tags/(:any)/(:num)'] = 'articles/tags/$1/$2';

$route['articles/category/(:any)'] = 'articles/category/$1';
$route['articles/category/(:any)/(:num)'] = 'articles/category/$1/$2';

$route['articles/(:any)/(:any)'] = 'articles/show/$1/$2';

$route['author/(:any)'] = 'author/index/$1';

$route['category'] = 'category';
$route['contact']  = 'contact';
$route['contact/simpan']  = 'contact/simpan';

/* BAGIAN BACKEND */
$route['cpanel'] = 'backend/dashboard/index';
$route['cpanel/dashboard'] = 'backend/dashboard/index';

$route['cpanel/master-data/kategori'] = 'backend/master-data/kategori/index';
$route['cpanel/master-data/kategori/ajax'] = 'backend/master-data/kategori/ajax';
$route['cpanel/master-data/kategori/modal-add'] = 'backend/master-data/kategori/modal_add';
$route['cpanel/master-data/kategori/simpan'] = 'backend/master-data/kategori/simpan';
$route['cpanel/master-data/kategori/modal-edit'] = 'backend/master-data/kategori/modal_edit';
$route['cpanel/master-data/kategori/perbarui'] = 'backend/master-data/kategori/perbarui';
$route['cpanel/master-data/kategori/delete'] = 'backend/master-data/kategori/delete';
$route['cpanel/master-data/kategori/hapus']  = 'backend/master-data/kategori/hapus';

$route['cpanel/master-data/tag'] = 'backend/master-data/tag/index';
$route['cpanel/master-data/tag/ajax'] = 'backend/master-data/tag/ajax';
$route['cpanel/master-data/tag/modal-add'] = 'backend/master-data/tag/modal_add';
$route['cpanel/master-data/tag/simpan'] = 'backend/master-data/tag/simpan';
$route['cpanel/master-data/tag/modal-edit'] = 'backend/master-data/tag/modal_edit';
$route['cpanel/master-data/tag/perbarui'] = 'backend/master-data/tag/perbarui';
$route['cpanel/master-data/tag/delete'] = 'backend/master-data/tag/delete';
$route['cpanel/master-data/tag/hapus']  = 'backend/master-data/tag/hapus';

$route['cpanel/master-data/user'] = 'backend/master-data/user/index';
$route['cpanel/master-data/user/ajax'] = 'backend/master-data/user/ajax';
$route['cpanel/master-data/user/modal-add'] = 'backend/master-data/user/modal_add';
$route['cpanel/master-data/user/simpan'] = 'backend/master-data/user/simpan';
$route['cpanel/master-data/user/modal-edit'] = 'backend/master-data/user/modal_edit';
$route['cpanel/master-data/user/perbarui'] = 'backend/master-data/user/perbarui';
$route['cpanel/master-data/user/delete'] = 'backend/master-data/user/delete';
$route['cpanel/master-data/user/hapus']  = 'backend/master-data/user/hapus';

$route['cpanel/pages/artikel'] = 'backend/pages/artikel/index';
$route['cpanel/pages/artikel/(:num)'] = 'backend/pages/artikel/index/$1';
$route['cpanel/pages/artikel/create'] = 'backend/pages/artikel/create';
$route['cpanel/pages/artikel/perbarui'] = 'backend/pages/artikel/perbarui';
$route['cpanel/pages/artikel/show/(:any)'] = 'backend/pages/artikel/show/$1';
$route['cpanel/pages/artikel/edit/(:any)'] = 'backend/pages/artikel/edit/$1';
$route['cpanel/pages/artikel/delete'] = 'backend/pages/artikel/delete';
$route['cpanel/pages/artikel/hapus']  = 'backend/pages/artikel/hapus';

$route['cpanel/pages/about'] = 'backend/pages/about/index';
$route['cpanel/pages/about/create'] = 'backend/pages/about/create';
$route['cpanel/pages/about/simpan'] = 'backend/pages/about/simpan';
$route['cpanel/pages/about/perbarui'] = 'backend/pages/about/perbarui';
$route['cpanel/pages/about/show/(:any)'] = 'backend/pages/about/show/$1';
$route['cpanel/pages/about/edit/(:any)'] = 'backend/pages/about/edit/$1';
$route['cpanel/pages/about/delete'] = 'backend/pages/about/delete';
$route['cpanel/pages/about/hapus']  = 'backend/pages/about/hapus';

$route['cpanel/pages/portofolio'] = 'backend/pages/portofolio/index';
$route['cpanel/pages/portofolio/create']   = 'backend/pages/portofolio/create';
$route['cpanel/pages/portofolio/simpan']   = 'backend/pages/portofolio/simpan';
$route['cpanel/pages/portofolio/perbarui'] = 'backend/pages/portofolio/perbarui';
$route['cpanel/pages/portofolio/show/(:any)'] = 'backend/pages/portofolio/show/$1';
$route['cpanel/pages/portofolio/edit/(:any)'] = 'backend/pages/portofolio/edit/$1';
$route['cpanel/pages/portofolio/delete'] = 'backend/pages/portofolio/delete';
$route['cpanel/pages/portofolio/hapus']  = 'backend/pages/portofolio/hapus';


$route['cpanel/profile'] = 'backend/profile/index';
$route['cpanel/profile/create'] = 'backend/profile/create';
$route['cpanel/profile/simpan'] = 'backend/profile/simpan';
$route['cpanel/profile/edit/(:any)'] = 'backend/profile/edit/$1';
$route['cpanel/profile/perbarui'] = 'backend/profile/perbarui';
$route['cpanel/profile/delete'] = 'backend/profile/delete';
$route['cpanel/profile/hapus']  = 'backend/profile/hapus';

$route['cpanel/kontak'] = 'backend/kontak/index';
$route['cpanel/kontak/ajax'] = 'backend/kontak/ajax';


$route['cpanel/auth'] = 'backend/auth/index';
$route['cpanel/auth/logout'] = 'backend/auth/logout';
