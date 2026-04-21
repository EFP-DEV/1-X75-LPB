<?php

$urls = [
    '/',
    '/home',
    '/home/index',

    '/products',
    '/products/index',
    '/products/list',
    '/products/show/12',
    '/products/show/999',
    '/products/show/abc',
    '/products/edit/5',
    '/products/delete/8',
    '/products/create',

    '/users',
    '/users/index',
    '/users/show/3',
    '/users/show',
    '/users/edit/42',
    '/users/delete/7',
    '/users/create',

    '/admin',
    '/admin/index',
    '/admin/dashboard',
    '/admin/products',
    '/admin/users',

    '/orders',
    '/orders/list',
    '/orders/show/15',

    '/blog',
    '/blog/show/4',
    '/blog/edit/2',

    '/unknown',
    '/unknown/test',
    '/nothing/here/123',

    '//products//show//12//',
    '/products/show/12/',
    '/products/show/12?sort=asc',
    '/users/edit/42?debug=true',

    '/PRODUCTS/SHOW/12',
    '/Users/Edit/5',

    '/products/show',
    '/products//edit',
    '/products/show/12/extra',
    '/users/edit/42/now',
];

// var_dump($urls);
$current_url = $urls[0];
var_dump('origianl', $current_url);

$current_url = trim($current_url, '/');
var_dump('trimmed', $current_url);

$current_url = str_replace('//', '/', $current_url);
var_dump('replaced', $current_url);

if($current_url === ''){
    $current_url = 'home/index';
    // $current_url = 'home/home';
    // $current_url = 'index/home';
    // $current_url = 'index/index';
    // $current_url = '/';
    // $current_url = '/';
}

$segments = explode('/', $current_url);
var_dump($segments);
// $first_segment = array_shift($segments);

$controller = $segments[0];
$action = $segments[1];
$id = $segments[2];

echo "URL : " . $current_url .PHP_EOL;
echo "Controller : " . $controller . ".php".PHP_EOL;
echo "Action : " . $action . "()".PHP_EOL;
echo "Identifiant : '" . $id . "'".PHP_EOL;
