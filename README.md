
## Laravel Challenge for Routing 

This is a demo project where `routes/web.php` is kind of a mess. Individual routes, no grouping, repeating middlewares
and so on.

So your task is to make it shorter, more convenient and easy to read, with whatever ways you know. Sky is your limit.

Important part is not to break any functionality, for that there are automated tests, that must still remain "passed"
even after your changes.

<hr/>

## What has been done

1-) Middleware detached individually, merged as a group. <br/>
2-) Fixed launching with "view/welcome.blade.php" instead of opening the dashboard on the login screen.<br/>
3-) "App\Http\Controllers\ArtistController" and "App\Http\Controllers\Admin\ArtistsController" are defined.<br/>
4-) Two ArtistControllers were used. Changed to ArtistsController instead of ArtistController in "Admin".<br/>
5-) Requests have been tested. All of them are doing the right thing.


### Fork and Clone

    git clone https://github.com/Mahmutcano/laravel-routing-case

### Prepare the application

    composer install
    php -r "file_exists('.env') || copy('.env.example','.env');"
    php artisan key:generate
    npm install && npm run dev
    php artisan serve

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
