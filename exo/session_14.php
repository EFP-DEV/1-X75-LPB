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

/*
// var_dump($urls);
for($i = 0; $i < count($urls); ++$i){
    $current_url = $urls[$i];
    // reste du code
}
*/

foreach($urls as $i => $current_url){

    $current_url = trim($current_url, '/');
    $current_url = str_replace('//', '/', $current_url);

    $segments = [];
    $controller = 'home';
    $action = 'index';
    $id = null;

    if(str_contains($current_url, '/')){
        $segments = explode('/', $current_url);
    }
    if(isset($segments[0])){
        $controller = $segments[0];
    }
    if(isset($segments[1])){
        $action = $segments[1];
    }
    if(isset($segments[2])){
        $id = $segments[2];
    }
    echo "URL : " . $urls[$i] .PHP_EOL;
    echo "Controller : " . $controller . ".php".PHP_EOL;
    echo "Action : " . $action . "()".PHP_EOL;
    echo "Identifiant : '" . $id . "'".PHP_EOL.PHP_EOL;
}

