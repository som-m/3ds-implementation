<?php

require_once __DIR__ . '/config/config.php';

$router = new AltoRouter();

$router->map('GET', '/', function() {
	require __DIR__ . '/public/index.php';
});

$router->map('GET', '/barcode/[*:charge_id]', function($charge_id) {
	require __DIR__ . '/public/barcode.php';
});

$router->map('POST', '/checkout', function() {
	require __DIR__ . '/app/checkout.php';
});

$router->map('GET', '/complete/[i:order_id]', function($order_id) {
	require __DIR__ . '/app/complete.php';
});

$match = $router->match();

if (is_array($match) && is_callable($match['target'])) {
	call_user_func_array($match['target'], $match['params']); 
} else {
	require __DIR__ . '/public/404.php';
}
