<p align="center"><a href="https://ogrencibaksana.com" target="_blank"><img src="https://ogrencibaksana.com/img/logos/logo.svg" width="400" style="background-color:#ffd023; border-radius:1rem;"></a></p>

[comment]: <> (![Laravel Routing CI]&#40;https://github.com/ogrencibaksana/laravel-routing-challenge/actions/workflows/routing.yml/badge.svg&#41;)

[comment]: <> (<p align="center">)
 
[comment]: <> (<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>)

[comment]: <> (</p>)

## Laravel Challenge for Routing

This is a demo project where `routes/web.php` is kind of a mess. Individual routes, no grouping, repeating middlewares and so on.

So your task is to make it shorter, more convenient and easy to read, with whatever ways you know. Sky is your limit.

Important part is not to break any functionality, for that there are automated tests, that must still remain "passed" even after your changes.


## How to perform the task
We will be expecting a [Pull Request](#how-to-participate) which contains all code for completely working project to the `main` branch.

We will NOT merge the Pull Request, only review on it, whether it's correct or not. 

If you have any questions, or suggestions for the future challenges, please open an Issue on this repo.


### Fork and Clone your forked repository to your computer  

    git clone https://github.com/<YOUR_USERNAME>/laravel-routing-challenge
  
  
### Prepare the application

    composer install
    php -r "file_exists('.env') || copy('.env.example','.env');"
    php artisan key:generate
    npm install && npm run dev
    php artisan serve


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
