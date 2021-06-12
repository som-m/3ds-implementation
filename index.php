<?php

require_once __DIR__ . '/config/config.php';

$router = new AltoRouter();

$router->map('GET', '/', function() {
  require __DIR__ . '/public/index.php';
});

$router->map('GET', '/[*:charge_id]/barcode', function($charge_id) {
  require __DIR__ . '/public/barcode.php';
});

$router->map('GET', '/[*:charge_id]/type=[*:type]&status=[a:status]', function($charge_id, $type, $status) {
  require __DIR__ . '/public/status.php';
});

$router->map('GET', '/[i:order_id]/complete', function($order_id) {
  require __DIR__ . '/app/complete.php';
});

$router->map('POST', '/checkout', function() {
  require __DIR__ . '/app/checkout.php';
});

$router->map('POST', '/status', function() {
  require __DIR__ . '/app/status.php';
});

$router->map('POST', '/webhook', function() {
  require __DIR__ . '/app/webhook.php';
});

$match = $router->match();

if (is_array($match) && is_callable($match['target'])) {
  call_user_func_array($match['target'], $match['params']);
} else {
  require __DIR__ . '/public/404.php';
}
