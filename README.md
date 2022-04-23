<p align="center"><a href="https://ogrencibaksana.com" target="_blank"><img src="https://ogrencibaksana.com/img/logos/logo.svg" width="400" style="background-color:#ffd023; border-radius:1rem;"></a></p>

<p align="center">
<a href="https://github.com/ogrencibaksana/laravel-routing-case/actions">
    <img src="https://github.com/ogrencibaksana/laravel-routing-case/actions/workflows/routing.yml/badge.svg" />
</a>
<img src="https://img.shields.io/github/languages/top/ogrencibaksana/laravel-routing-case" />
<img src="https://img.shields.io/github/issues/ogrencibaksana/laravel-routing-case" />
</p>

## Laravel Challenge for Routing

This is a demo project where `routes/web.php` is kind of a mess. Individual routes, no grouping, repeating middlewares
and so on.

So your task is to make it shorter, more convenient and easy to read, with whatever ways you know. Sky is your limit.

Important part is not to break any functionality, for that there are automated tests, that must still remain "passed"
even after your changes.

## How to perform the task

We will be expecting a Pull Request which contains all code for completely working project to the `main` branch.

We will NOT merge the Pull Request, only review on it, whether it's correct or not.

If you have any questions, or suggestions for the future challenges, please open an Issue on this repo.

### Fork and Clone 

    git clone https://github.com/akardev/laravel-routing-case.git
               


### Prepare the application

    composer install
    php -r "file_exists('.env') || copy('.env.example','.env');"
    php artisan key:generate
    npm install && npm run dev
    php artisan serve

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
