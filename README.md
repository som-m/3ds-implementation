# 3-D Secure Implementation

This is an unofficial example of Omise 3-D Secure implementation using [Omise-PHP Library](https://github.com/omise/omise-php).

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

Set `return_uri`. This should be your store url. For example if you are running this locally: `'http://localhost:8888/complete.php/orderid='`

```php
22: 'return_uri'	=> 'https://merchant-site.com/complete.php/orderid=' . $order_id,
```

## Usage

Start your preferred web server and open index.html on your browser.

### With Docker

run `docker-compose up` to start the application and open http://localhost:8080 on your browser to start testing.