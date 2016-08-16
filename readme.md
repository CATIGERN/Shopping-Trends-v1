# Shopping Trends v1

This is a simple application built in the PHP Laravel framework. The application basically is a sort of a shopping list manager, where you can create new shopping lists, and add and mark the items in those shopping lists. You can also, delete items or carts. Apart from this, you can analyse the spending that your doing in each store. The application is really simple, and it is built using Restful Web APIs. The technologies used in this project are
1) PHP
2) HTML
3) CSS
4) JavaScript
5) Angular JS
6) Laravel Blade
7) MySQL

If you would like to run this application on your own PC. Follow these steps
1) Install PHP >= 5.5.9
2) Get [Composer](https://getcomposer.org/)
3) On the [repo](https://github.com/CATIGERN/Shopping-Trends-v1) page, click Clone or Download and select Download Zip.
4) Extract the zip to some location on your PC, eg: C:/Shopping-Trends.
5) Now rename the '.env.example' file in your C:/Shopping-Trends to '.env' (windows users can type : 'move .env.example .env')
6) Open the console and go to your project directory eg: C:/Shopping-Trends
7) Run 'composer-install' on your terminal.
8) Now you should have a local MySQL server, you should then use the dump.sql file to create the corresponding database. Open the .env file and change the database properties according to your database. Also edit the /config/database.php file according to the username and password of your database.
9) Run 'php artisan serve' and you should have a local copy of the application running.

Thanks for reading. Have a good day :)



# Laravel PHP Framework

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/d/total.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, queueing, and caching.

Laravel is accessible, yet powerful, providing tools needed for large, robust applications. A superb inversion of control container, expressive migration system, and tightly integrated unit testing support give you the tools you need to build any application with which you are tasked.

## Official Documentation

Documentation for the framework can be found on the [Laravel website](http://laravel.com/docs).

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](http://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
