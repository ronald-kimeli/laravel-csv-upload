# Laravel 

## Installation

* Create .env file through copy

```bash
cp .env.example .env
```
  
* Install project dependencies

```php
composer install
```

* Generate laravel key for application to run

```php
php artisan key:generate
```

* Install nodejs dependencies

```javascript
npm install
```

* Provide database credentials below in .env file.

```php
    DB_DATABASE=?
    DB_USERNAME=?
    DB_PASSWORD=?
```

> Incase you want multidatabase connection then uncomment commented database and provide credentials

* To run the project

```php
php artisan key:generate
```

```php
php artisan migrate --seed
```

* Spin development servers

```javascript
npm run dev
```

```php
php artisan serve
```

* Then check localhost:8000 or click the link provided on npm run dev and check your browser

```php
localhost:8000
```
