# Divulga Usados PHP Application

[![Build Status](https://travis-ci.org/murilocosta/divulgausados.svg?branch=master)](https://travis-ci.org/murilocosta/divulgausados)

An application to gather people who wish to share information about their cars.

## Project Setup

This project uses the Continuous Integration tool [Travis CI](https://travis-ci.org/), to control application builds and dependencies. 

Project main frameworks are basically [Laravel 4 Framework](http://laravel.com/docs) used in backend development, and [Angular JS 1.2.x](https://docs.angularjs.org/guide) used in frontend development, to handle interface elements [Bootstrap 3.1.x](http://getbootstrap.com/components/) was used, since it covers the css standardization problems and provides simple, clean and reusable components using HTML5.

For dependency management in PHP, [Composer](https://getcomposer.org/doc/) was the best choice, since it have great documentation, it's easy to use and configure, and it provides great amount of packages in it's repository. Javascript and CSS dependencies are managed by [Grunt](http://gruntjs.com/getting-started) + [Bower](http://bower.io/), to keep javascript tasks, packages and version under control.

### Project Build

First, install [Node.JS](http://nodejs.org/) and run `npm install -g bower` to download and install Bower, then `npm install -g grunt-cli` to install Grunt, having done that, download and install Composer for PHP dependency management. Clone the project from [GitHub](https://github.com/murilocosta/divulgausados.git) to your workspace, navigate to your project folder and run the following commands:

```
composer install
npm install
bower install
grunt
```

The project is built, now setup your favorite RDBM (MySQL is recommended) and provide it's configuration to `app/config/database.php`, create a database and run `php artisan migrate`. Execute `php artisan serve` to initialize embedded web server, then the application should be up and running on `http://localhost:8000`.

### License

The Divulga Usados application is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
