# 3-D Secure Implementation

This is an unofficial example of Omise 3-D Secure implementation using [Omise-PHP Library](https://github.com/omise/omise-php).

## Setup

This project use [Composer](https://getcomposer.org/) as a dependency manager.

Composer can be installed via [Composer website](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos)
as a standalone executable.

Or via [asdf PHP](https://github.com/asdf-community/asdf-php), which also
install Composer. Please note that asdf PHP requires [asdf](https://asdf-vm.com/#/core-manage-asdf) to run as a plugin manager.

### Install dependencies

Run `composer install` to install dependencies described in `composer.json`. There should be a vendor folder which contain `omise/omise-php` library.

## Configuration

### index.php

Set your Omise public key.

```javascript
17: <script>
18: OmiseCard.configure({
19:   publicKey: "pkey_test_"
20: });
```

### config.php

Set your Omise public and secret keys.

```php
4: define('OMISE_PUBLIC_KEY', 'pkey_test_');
5: define('OMISE_SECRET_KEY', 'skey_test_');
```

### checkout.php

Set `return_uri`. This should be your store url. For example if you are running this locally: `'http://localhost:8080/complete.php/orderid='`

```php
22: 'return_uri'	=> 'https://merchant-site.com/complete.php/orderid=' . $order_id,
```

## Usage

Start your preferred web server and open index.html on your browser.

### With Docker

Run `docker-compose up` to start the application and open http://localhost:8080 on your browser to start testing.
