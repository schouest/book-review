<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'books';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['mainpage'] = 'books/view_mainpage';
$route['addbook'] = 'books/view_addbook';
$route['viewuser/(:num)'] = 'books/view_user/$1';
$route['review/(:num)'] = 'books/view_addreview/$1';
$route['register'] = 'books/add_user';
$route['signin'] = 'books/login';
$route['logout'] = 'books/logout';
$route['submitbook'] = 'books/add_book';
$route['review/submitreview/(:num)'] = 'books/add_review/$1';