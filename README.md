# Omise-PHP Example

This is an unofficial example for implementing [Omise-PHP Library](https://github.com/omise/omise-php).

## Installation

Run `composer install` to install all dependencies.

## Configuration

### .env-example

In **config** folder, rename `.env-example` to `.env` and set your Omise public and secret keys.

```
OMISE_PUBLIC_KEY=pkey_test_
OMISE_SECRET_KEY=skey_test_
```

## Usage

1. Run `php -S localhost:8080` or `docker-compose up`.
2. Open http://localhost:8080 on your browser.

[Here](https://omise-php-example.herokuapp.com/) is the live demo.
