<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Native Installation

Requirements:
* [PHP 8.2](https://www.php.net/)
* [Composer](https://getcomposer.org/)
* [MySQL](https://www.mysql.com/) / [XAMPP] (https://www.apachefriends.org/download.html)


Setup: 
1. From the root directory (where this file `README.md` is located) navigate to the application source directory: `cd code/` 
2. Execute the installation script `bash init.sh` OR run commands individually:
   * Install dependencies: `composer install`
   * Install  XAMPP with  MySQL database
   * Run `npm install`
   * Run `cp .env.example .env`
   * Run `php artisan key:generate`
   * Start XAMPP with  MySQL database
   * Run `php artisan migrate`
   * Run `php artisan migrate:fresh`
   * Run `php artisan migrate:fresh --seed`
   * Run `npm run dev`
3. Run web server:
   * With XAMPP 
   * Or with laravel: `php artisan serve`
4. The application should now be available at http://127.0.0.1:8000



