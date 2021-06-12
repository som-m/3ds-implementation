<?php

$request = $_SERVER['REQUEST_URI'];

switch ($request) {
  case '':
    require __DIR__ . '/public/index.php';
    break;
  case '/':
    require __DIR__ . '/public/index.php';
    break;
  case '/barcode':
    require __DIR__ . '/public/barcode.php';
    break;
  case '/checkout':
    require __DIR__ . '/app/checkout.php';
    break;
  case '/complete': // need to fix this
    require __DIR__ . '/app/complete.php';
    break;
  default:
    http_response_code(404);
    require __DIR__ . '/public/404.php';
    break;
}
