## Native Installation

Requirements:

-   [PHP 8.2](https://www.php.net/)
-   [Composer](https://getcomposer.org/)
-   [MySQL](https://www.mysql.com/) / [XAMPP] (https://www.apachefriends.org/download.html)
    Setup:

1. From the root directory (where this file `README.md` is located) navigate to the application source directory: `cd code/`
2. Execute the installation script `bash init.sh` OR run commands individually:
    - Install dependencies: `composer install`
    - Install XAMPP with MySQL database or MySQL database
    - Run `npm install`
    - Run `cp .env.example .env`
    - Run `php artisan key:generate`
    - Run `composer require spatie/laravel-permission`
    - Start XAMPP with MySQL database or MySQL database
    - Run `php artisan migrate`
    - Run `php artisan migrate:fresh`
    - Run `php artisan migrate:fresh --seed`
    - Run `npm run build`
3. Run web server:
    - With XAMPP (cd code/` from ../xampp/htdocs)
    - Or with laravel: `php artisan serve` (from anywhere)
4. The application should now be available at http://127.0.0.1:8000
5. Users:
    - admin@gmail.com;
    - user@gmail.com;
    - customer@gmail.com.
6. All pass:
    - 123
