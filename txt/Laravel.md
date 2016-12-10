# The Basic

## Route

- use `get()`, `post()`, `put()`, `patch()`, `delete()` to match single method
- route processing logic can be defined either in
    + the second Closure, or by
    + `['uses' => <Controller@actioin>]`
- for unsupported method, you can use `method_filed('PUT')` in the form to fake it
- to trigger 404, use `abort(404)` in the route
- use `match()` or `any()` to match multiple method
- use `group()` to group routes
- group route array attributes:
    + `as =>`
    + `middleware =>`
    + `namespace =>`
    + `domain => `
    + `prefix =>`
- use `{}` to define parameter, `{?}` to define optional parameter
- use `where()` to constrain parameter by regex
- route can be given a name by using `['as' => ]` or `name()`
- group route's name will be prefixed to all routes inside of it
- use `url()` to generate a route, or `route()` to generate a named route
- define model binding in `RouteServiceProvider::boot()` by using `$route->model()`, the default binding is by ID
- or you can use `$route->bind()` to define your own model binding logic
- you can cache routes by running `artisan route:cache`, and clear it by `artisan route:clear`
- only controller based route(instead of Closure based) will be cached

## Middleware

- middlewares are in `app/Http/Middleware` directory
- use `artisan make::middleware <name>` to create a new middleware
- before middleware

    ```php
    <?php 
        // perform task
        return `$next`($requeset);
     ?>
    ```

- after middleware

    ```php
    <?php 
        $response = $next($request);
        // perform task
        return $request;
     ?>
    ```

- to register a middleware as global, add it into `app/Http/Kernel::$middleware`
- to register middlewares per routes
    1. add it to `App/Http/Kernel::$routeMiddleware`
    2. use route array `[middleware =>]` or `middleware()` methods
- to register middleware in controller/action, use controller's `middleware()`  method in its constructor like this:

    ```php
    <?php 
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('log', ['only' => ['fooAction', 'barAction']]);
        $this->middleware('subscribed', ['except' => ['fooAction', 'barAction']]);
    }
     ?>
    ```

- middleware parameter can be specified in `[middelware =>]` using `:` and seperated by `,` like `['middleware' => 'role:editor, writor]`
- middleware parameter can be received in `middleware::handle()`'s additional parameter, like `public function handle($request, Closure $next, $role)`
- if middleware need to do things after the response has sent to browser, do it in `middleware::terminate($request, $response)`

## Controller

- controllers are resided in `app/Http/Controllers`
- use `action('controller@action')` to generate URL
- use `Route::currentRouteAction()` to obtain current CA 
- use `artisan make:controller PhotoController` will create a Restful resource controller
    + resource controller have those actions
    
        |Verb|Path|Action|Routename|
        |----|----|------|---------|
        |GET|/photo|index|photo.index|
        |Get|/photo/create|create|photo.create|
        |POST|    /photo|  store|   photo.store|
        |GET| /photo/{photo}|  show|    photo.show|
        |GET| /photo/{photo}/edit| edit|    photo.edit|
        |PUT/PATCH|   /photo/{photo}|  update|  photo.update|
        |DELETE|  /photo/{photo}|  destroy| photo.destroy|

    + use `Route::resource()` to create corresponding Restful routes
    + `Route::resource()` can also define a partial resource routes, this should be under other related route definitions

        ```php
        <?php 
        Route::resource('photo', 'PhotoController',
                        ['only' => ['index', 'show']]);

        Route::resource('photo', 'PhotoController',
                        ['except' => ['create', 'store', 'update', 'destroy']]);
         ?>
        ```

    + use `.` to define nested resource routes(say comments to photos), like `Route::resource('photos.comments', 'PhotoCommentController');`, then you can access it via URL `photos/{photos}/comments/{comments}`
- implicit controllers
    ```php
    <?php 
    // in routes.php:
    Route::controller('users', 'UserController');

    // in controller: action name prefix with HTTP method
    class UserController extends Controlls
    {
        public function getIndex() {}       // GET /users
        public function getShow($id) {}     // GET /users/show/1
        public function getAdminProfile() {}// GET /users/admin-profile
        public function postProfile() {}    // POST /users/profile
     ?>
    }
    ```
- you are able to type-hint any dependencies your controller may need in its constructor,  If the container can resolve it, you can type-hint it
- you may also type-hint dependencies on your controller's action methods, list your route arguments after your other dependencies

## Request

- use `->path()` to access request's path
- use `->url()` to access the full URL
- use `->is($pattern)` to verify the incoming reqeust's URI match a pattern(* is wildcard)
- use `->method()` to get the request method, or `->isMethod($pattern)` to match the method against a pattern
- if you want obtain an PSR-7 request, you need `composer require symfony/psr-http-message-bridge` and `composer require zendframework/zend-diactoros`, then typehint
- access user input, no matter what the HTTP verb is
    + by `->input()`: `$name = $request->input('name')`
    + by attributes: `$name = $request->name`
    + access form array: `$name = $reqeust->input('user.name')`
    + give it a default value: `$name = $request->input('name', 'Sally')`
- to find if a use input is present, use `->has('name')`
- get all as an array by `->all()`
- use `->only([])` or `->except([])` to filter as you like
- if you need to restore users old input, you may checkout Laravel's `validation service`, or use `flash`:
    + use `->flash()` or `->flashOnly()` or `->flashExcept()` to flash request data into session
    + if you then need to redirect use something like `return redirect('form')->withInput()` 
    + get the old data by `->old('name')` or helper `old('name')`
- use `->cookie('name')` to access cookie data, all cookie data are encrypted and signed by Laravel, if you don't want that, add an entry into middleware `EncryptCookies::$except`
- obtain a `SplFileInfo` object from request by `->file('photo')`, use `->hasFile('photo')` to determine its presence
- use `$file->isValid()` to determine whether there is problem uploading the file, and `$file->move($path, $name)` to move it. check [Symfony UploadedFile][symfonyFile] for more file operations 

## Response

- use `new Response($content, $status)` or helper `response($content, $status)` to get a Response object
- chain up `->header()` to add headers into response
- you can response with cookie by `->withCookie('name', 'value')` or `->withCookie(cookie('name', 'value', $minutes))` or `->withCookie(cookie()->forever('name', 'value'))` for long lived cookie data
- other response types
    + view: 

        ```php
        <?php 
        // you need to control over headers (use response() helper)
        return response()->view('hello', $data)->header('Content-Type', $type);
        // you don't need, then simply
        return view();
         ?>
        ```

    + json: `return response()->json(['name' => 'Abigail', 'state' => 'CA']);`
    + jsonp:

        ```php
        <?php 
        return response()->json(['name' => 'Abigail', 'state' => 'CA'])
                         ->setCallback($request->input('callback'));
         ?>
        ```

    + file download: `return response()->download($pathToFile, $name, $headers);`
- redirect

    ```php
    <?php 
    // use helper:
    return redirect('home/dashboard');
    // to previous location:
    return back()->withInput();
    // to named routes with route parameters
    return redirect()->route('profile', [1]);
    // to CA with route parameters
    return redirect()->action('UserController@profile', [1]);
    // with flashed sessioin data, access later in view by `session('status')`
    return redirect('dashboard')->with('status', 'Profile updated!');
     ?>
    ```

- you can also implement your custom response, by using `ResponseFacotry::macro()` method

## View

- views are stored in `reosurces/views` directory
- return view with helper `return view('viewName', $data)`
- nested view can be referenced by `dot` notation like `admin.profile`
- use `->exists()` to examine whether a view exists
- you can also pass the view data by `return view('viewName')->with('dataName', 'data')`
- if you want to share view data across app, use `view()->share()` inside a `ServiceProvider`
- If you have data that you want to be bound to a view each time that view is rendered, a `view composer` can help you organize that logic into a single location
    1. register view composer in a new created service provider
    
        ```php
        <?php

        namespace App\Providers;

        use Illuminate\Support\ServiceProvider;

        class ComposerServiceProvider extends ServiceProvider
        {
            public function boot()
            {
                // - Using class based composers...
                view()->composer(
                    // + ProfileComposer@compose method will be executed each time the profile view is being rendered
                    'profile', 'App\Http\ViewComposers\ProfileComposer'
                    // + you can also bind to multiple view by passing array
                    ['profile', 'dashboard'], 'App\Http\ViewComposers\ProfileComposer',
                    // + all bind to all by passing *
                    '*', 'App\Http\ViewComposers\ProfileComposer'
                );

                // - Using Closure based composers...
                view()->composer('dashboard', function ($view) {

                });
            }

            public function register()
            {
                //
            }
        }
        ?>
        ```

    2. add the service provider to the providers array in `config/app.php`
    3. define the composer class
    
        ```php
        <?php

        namespace App\Http\ViewComposers;

        use Illuminate\Contracts\View\View;
        use Illuminate\Users\Repository as UserRepository;

        class ProfileComposer
        {
            protected $users;

            public function __construct(UserRepository $users)
            {
                $this->users = $users;
            }

            // here
            public function compose(View $view)
            {
                $view->with('count', $this->users->count());
            }
        }
        ?>
        ```

- View creators are very similar to view composers; however, they are fired immediately when the view is instantiated instead of waiting until the view is about to render. To register a view creator, use the `creator` method: `view()->creator('profile', 'App\Http\ViewCreators\ProfileCreator');`

## Blade Template Engine

- blade view file ends with `.blade.php` and reside in `resources/views`
- template inheritance

    + in `master.blade.php`

        ```php
        <html>
            <head>
                <title>App Name - @yield('title')</title>
            </head>
            <body>
                @section('sidebar')
                    This is the master sidebar.
                @show

                <div class="container">
                    @yield('content')
                </div>
            </body>
        </html>
        ```

    + in `resources/views/child.blade.php`

        ```
        @extends('layouts.master')

        @section('title', 'Page Title')

        @section('sidebar')
            @parent

            <p>This is appended to the master sidebar.</p>
        @endsection

        @section('content')
            <p>This is my body content.</p>
        @endsection
        ```

- display data by `{{ $varName }}`
- data displayed are auto `htmlentities`ed, if that's not what you want, use `{!! $name !!}`
- use `@{{ $varName }}` to escape
- use `{{ $name or 'default' }}` to give default value if var not exists
- control structures:
    + `@if`, `@elseif`, `@else`, `@endif`, `@unless`, `@endunless`
    + `@for`, `@endfor`, `@foreach`, `@endforeach`, `@forelse`, `@empty`, `@endforelse`, `@while`, `@endwhile`
    + `@include('view.name', ['extra' => 'data'])`
    + `@each('view.name', $jobs, 'job')`
    + `{{-- comment --}}`
- inject service by `@inject('asName', 'App\Services\MetricsService')`
- create your own directives
    1. define
    
        ```php
        <?php

        namespace App\Providers;

        use Blade;
        use Illuminate\Support\ServiceProvider;

        class AppServiceProvider extends ServiceProvider
        {
            public function boot()
            {
                // here, using directive() method
                Blade::directive('datetime', function($expression) {
                    return "<?php echo with{$expression}->format('m/d/Y H:i'); ?>";
                });
            }

            public function register()
            {
                //
            }
        }
        ?>
        ```

    2. use: `@datetime($var)`

# Architecture Foundations

## Request lifecycle: entry point `index.php`
1. register autoloader
2. create application instance
3. send request to HTTP kernel->handle()->get response
    1. pass through global middlewares
    2. run bootstrappers
        1. ...
        2. load service providers
    3. send to router for dispatching to route or to controller, through route middlewares

## Service Provider

- Service providers are the central place of all Laravel application bootstrapping
- service provider classes that will be loaded for your application are defined in `config/app.php`
- creating service provider
    1. define

        ```php
        <?php 
        namespace App\Providers;

        use Riak\Connection;
        use Illuminate\Support\ServiceProvider;
        use Illuminate\Contracts\Routing\ResponseFactory;

        class RiakServiceProvider extends ServiceProvider
        {
            /**
             * - service providers extend the 
             *   `Illuminate\Support\ServiceProvider` class
             * - you should at least provide a `register()` method
             * - whthin the `register()` method, you should only bind things into the 
             *   service container. You should never attempt to register any event 
             *   listeners, routes, or any other piece of functionality within 
             *   the register method. Otherwise, you may accidently use a 
             *   service that is provided by a service provider which 
             *   has not loaded yet
             * - use `artisan make:provider` to generate a template
             */
            public function register()
            {
                $this->app->singleton('Riak\Contracts\Connection', function ($app) {
                    return new Connection(config('riak'));
                });
            }

            /**
             * - the boot method is called after all other service providers have been 
             *   registered,  meaning 
             * - you have access to all other services that have been registered by 
             *   the framework
             * - and able to type-hint dependencies for our boot method
             */
            public function boot(ResponseFactory $factory)
            {
                $factory->macro('caps', function ($value) {
                    //
                });
            }
        }
         ?>
        ```

    2. register: add it into `config/app.php`
    3. if you want to defer provider
        
        ```php
        <?php

        namespace App\Providers;

        use Riak\Connection;
        use Illuminate\Support\ServiceProvider;

        class RiakServiceProvider extends ServiceProvider
        {
            // 1. set $derfer to true
            protected $defer = true;

            public function register()
            {
                $this->app->singleton('Riak\Contracts\Connection', function ($app) {
                    return new Connection($app['config']['riak']);
                });
            }

            // define a `provides()` method
            public function provides()
            {
                return ['Riak\Contracts\Connection'];
            }

        }
        ?>
        ```

## Service Container

-  a powerful tool for managing class dependencies and performing dependency injection
-  a deep understanding of the Laravel service container is essential to building a powerful, large application, as well as for contributing to the Laravel core itself
-  there is no need to bind classes into the container if they do not depend on any interfaces
-  bind class into container
-  Binding(within a service provider)
    
    ```php
    <?php
    // - resolve with Closure
    $this->app->bind('HelpSpot\API', function ($app) {
        return new HelpSpot\API($app['HttpClient']);
    });

    // - bind as singleton
    $this->app->singleton('FooBar', function ($app) {
        return new FooBar($app['SomethingElse']);
    });

    // - bind instance
    $fooBar = new FooBar(new SomethingElse);
    $this->app->instance('FooBar', $fooBar);

    // - bind interface to implementations
    $this->app->bind('App\Contracts\EventPusher', 'App\Services\RedisEventPusher');

    // - contextual binding
    //      + use class name
    $this->app->when('App\Handlers\Commands\CreateOrderHandler')
          ->needs('App\Contracts\EventPusher')
          ->give('App\Services\PubNubEventPusher');
    //      + use Closure
    $this->app->when('App\Handlers\Commands\CreateOrderHandler')
              ->needs('App\Contracts\EventPusher')
              ->give(function () {
                      // Resolve dependency...
                  });
    ?>
    ```

- Tagging

    ```php
    <?php 
    $this->app->bind('SpeedReport', function () {
    });

    $this->app->bind('MemoryReport', function () {
    });

    $this->app->tag(['SpeedReport', 'MemoryReport'], 'reports');

    $this->app->bind('ReportAggregator', function ($app) {
        return new ReportAggregator($app->tagged('reports'));
    });
     ?>
    ```

- Resolving

    ```php
    <?php 
    // - use `make()`
    $fooBar = $this->app->make('FooBar');

    // - use array access
    $fooBar = $this->app['FooBar'];

    // - use type hint(recommend)
    // inside some class...
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }
     ?>
    ```

- container will fire an event each time it resolves an object

    ```php
    <?php 
    $this->app->resolving(function ($object, $app) {
        // Called when container resolves object of any type...
    });

    $this->app->resolving(FooBar::class, function (FooBar $fooBar, $app) {
        // Called when container resolves objects of type "FooBar"...
    });
     ?>
    ```


## Contracts

- are a set of interfaces that define the core services provided by the framework
- built-in contracts and its facades

| Contract | facade |
|----------|--------|
|Illuminate\Contracts\Auth\Guard | Auth|
|Illuminate\Contracts\Auth\PasswordBroker |    Password|
|Illuminate\Contracts\Bus\Dispatcher | Bus|
|Illuminate\Contracts\Broadcasting\Broadcaster |    |
|Illuminate\Contracts\Cache\Repository |   Cache|
|Illuminate\Contracts\Cache\Factory |  Cache::driver()|
|Illuminate\Contracts\Config\Repository |  Config|
|Illuminate\Contracts\Container\Container |    App|
|Illuminate\Contracts\Cookie\Factory | Cookie|
|Illuminate\Contracts\Cookie\QueueingFactory | Cookie::queue()|
|Illuminate\Contracts\Encryption\Encrypter |   Crypt|
|Illuminate\Contracts\Events\Dispatcher |  Event|
|Illuminate\Contracts\Filesystem\Cloud |    |
|Illuminate\Contracts\Filesystem\Factory | File|
|Illuminate\Contracts\Filesystem\Filesystem |  File|
|Illuminate\Contracts\Foundation\Application | App|
|Illuminate\Contracts\Hashing\Hasher | Hash|
|Illuminate\Contracts\Logging\Log |    Log|
|Illuminate\Contracts\Mail\MailQueue | Mail::queue()|
|Illuminate\Contracts\Mail\Mailer |    Mail|
|Illuminate\Contracts\Queue\Factory |  Queue::driver()|
|Illuminate\Contracts\Queue\Queue |    Queue|
|Illuminate\Contracts\Redis\Database | Redis|
|Illuminate\Contracts\Routing\Registrar |  Route|
|Illuminate\Contracts\Routing\ResponseFactory |    Response|
|Illuminate\Contracts\Routing\UrlGenerator |   URL|
|Illuminate\Contracts\Support\Arrayable |   |
|Illuminate\Contracts\Support\Jsonable |    |
|Illuminate\Contracts\Support\Renderable |  |
|Illuminate\Contracts\Validation\Factory | Validator::make()|
|Illuminate\Contracts\Validation\Validator |    |
|Illuminate\Contracts\View\Factory |   View::make()|
|Illuminate\Contracts\View\View |   |

- to use a contract, simply type-hint it

## Facades

- provide a "static" interface to classes that are available in the application's service container
- how facades works
    + facades are defined by extending `Facade`
    + and define a method `getFacadeAccessor()` to return the name of a service container binding
    + client code call a facade like `Cache::get()`
    + app use `Facade::__callStatic()` to defer call and resolve the binding according to `getFacadeAccessor()`, then call the resolved object's `get()` method
- facade reference

|Facade | Class | Service container binding |
|-------|-------|---------------------------|
|App | Illuminate\Foundation\Application   | app |
|Artisan | Illuminate\Contracts\Console\Kernel | artisan |
|Auth |    Illuminate\Auth\AuthManager | auth |
|Auth | (Instance) Illuminate\Auth\Guard | |
|Blade |   Illuminate\View\Compilers\BladeCompiler | blade.compiler |
|Bus | Illuminate\Contracts\Bus\Dispatcher | |
|Cache |   Illuminate\Cache\Repository | cache |
|Config |  Illuminate\Config\Repository    | config |
|Cookie |  Illuminate\Cookie\CookieJar | cookie |
|Crypt |   Illuminate\Encryption\Encrypter | encrypter |
|DB |  Illuminate\Database\DatabaseManager | db |
|DB | (Instance)   Illuminate\Database\Connection | |
|Event |   Illuminate\Events\Dispatcher    | events |
|File |    Illuminate\Filesystem\Filesystem    | files |
|Gate |    Illuminate\Contracts\Auth\Access\Gate | |
|Hash |    Illuminate\Contracts\Hashing\Hasher | hash |
|Input |   Illuminate\Http\Request | request |
|Lang |    Illuminate\Translation\Translator   | translator |
|Log | Illuminate\Log\Writer   | log |
|Mail |    Illuminate\Mail\Mailer  | mailer |
|Password |    Illuminate\Auth\Passwords\PasswordBroker    | auth.password |
|Queue |   Illuminate\Queue\QueueManager   | queue |
|Queue | (Instance)    Illuminate\Queue\QueueInterface | |
|Queue | (Base Class)  Illuminate\Queue\Queue | |
|Redirect |    Illuminate\Routing\Redirector   | redirect |
|Redis |   Illuminate\Redis\Database   | redis |
|Request | Illuminate\Http\Request | request |
|Response |    Illuminate\Contracts\Routing\ResponseFactory | |
|Route |   Illuminate\Routing\Router   | router |
|Schema |  Illuminate\Database\Schema\Blueprint | |
|Session | Illuminate\Session\SessionManager   | session |
|Session | (Instance)  Illuminate\Session\Store | |
|Storage | Illuminate\Contracts\Filesystem\Factory | filesystem |
|URL | Illuminate\Routing\UrlGenerator | url |
|Validator |   Illuminate\Validation\Factory   | validator |
|Validator  (Instance)  |  Illuminate\Validation\Validator | |
|View |    Illuminate\View\Factory | view |
|View | (Instance) Illuminate\View\View | |

# Database

- database config file is located at `config/database.php`
- you can splite read/write connection config in the config file like this:

    ```php
    <?php 
    'mysql' => [
        'read' => [
            'host' => '192.168.1.1',
        ],
        'write' => [
            'host' => '196.168.1.2'
        ],
        'driver'    => 'mysql',
        'database'  => 'database',
        'username'  => 'root',
        'password'  => '',
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix'    => '',
    ],
     ?>
    ```

- three ways to use database
    + raw queries
    + query builders
    + and Eloquent ORM

## raw SQL queries

- general statement: `DB::statement('drop table users');`
- select: always return an array of `StdClass`
    + binding: `DB::select('select * from users where active = ?', [1]);`
    + named binding: `DB::select('select * from users where id = :id', ['id' => 1]);`

- insert: `DB::insert('insert into users (id, name) values (?, ?)', [1, 'Dayle']);`
- update: `DB::update('update users set votes = 100 where name = ?', ['John']);`, return affected rows number
- delete:   `DB::delete('delete from users');`, return deleted rows number
- transactions
    + auto transactioin

        ```php
        <?php 
        /**
         * - If an exception is thrown within the transaction Closure, the transaction will automatically be rolled back
         * - If the Closure executes successfully, the transaction will automatically be committed
         */
        DB::transaction(function () {
            DB::table('users')->update(['votes' => 1]);
            DB::table('posts')->delete();
        });
         ?>
        ```

    + manual transaction

        ```php
        <?php 
        // control rollback and commit yourself
        DB::beginTransaction();
        DB::rollBack();
        DB::commit();
         ?>
        ```

- listen for query events, You may register your query listener in a service provider

```php
<?php 
// in AppServiceProvider.php

// codes... 
    public function boot()
        {
            DB::listen(function($sql, $bindings, $time) {
            });
        }
// codes...
 ?>
```

- access connection: `DB::connection('foo')->select(...);`
- access underlying PDO instance: `DB::connection()->getPdo();`

## Query Builder

- no need to clean strings being passed as bindings
- use `DB::table($tblName)` to get an query builder
- retrieve result
    + `->get()`: get all rows
    + `->first()`: get the first row
    + `->value($colName)`: get the value of the column
    + `->chunk()`: chunk big result

        ```php
        <?php 
        DB::table('users')->chunk(100, function($users) {
            foreach ($users as $user) {
                // return flase if you want to stop furthur chunk
            }
        });
         ?>
        ```
    
    + `->lists($colName, $keyAs)`: get a list of column values
    + aggregates: `count()`, `max($colName)`, `min()`, `avg()`, `sum()`

- select
    + `->select('name', 'email as user_email')`: specify cols to select
    + `->distinct()`
    + `->addSelect()`: add additional select cols to an existing query
    + `DB::raw('count(*) as user_count, status')`: insert raw expression, __becareful__ of SQL injection
- join
    + `->join('contacts', 'users.id', '=', 'contacts.user_id')`: inner join
    + `->leftJoin('posts', 'users.id', '=', 'posts.user_id')`: left join
    + advanced join
    
        ```php
        <?php 
        DB::table('users')
                ->join('contacts', function ($join) {
                    /**
                     * - `->on()`
                     * - `->orOn()`
                     * - `->where()`
                     * - `->orWhere()`
                     */
                    $join->on('users.id', '=', 'contacts.user_id')
                         ->where('contacts.user_id', '>', 5);
                })
                ->get();
         ?>
        ```

- union: `union()` or `unionAll()`

    ```php
    <?php 
    $first = DB::table('users')
                ->whereNull('first_name');

    $users = DB::table('users')
                ->whereNull('last_name')
                ->union($first)
                ->get();
     ?>
    ```

- where: 
    + `where()` and `orWhere()`
    + `whereBetween()` and `whereNotBetween()`
    + `whereIn()` and `whereNotIn()`
    + `whereNull()` and `whereNotNull()`
    + advanced where

        ```php
        <?php 
        // parameter grouping, produce:
        // select * from users where name = 'John' or (votes > 100 and title <> 'Admin')
        DB::table('users')
                    ->where('name', '=', 'John')
                    ->orWhere(function ($query) {
                        $query->where('votes', '>', 100)
                              ->where('title', '<>', 'Admin');
                    })
                    ->get();

        // exists statements, produce:
        // select * from users
        // where exists (
        //     select 1 from orders where orders.user_id = users.id
        // )
        DB::table('users')
                    ->whereExists(function ($query) {
                        $query->select(DB::raw(1))
                              ->from('orders')
                              ->whereRaw('orders.user_id = users.id');
                    })
                    ->get();
         ?>
        ```

- order, group, limit, offset
    + `orderBy($column, $descOrAsc)`
    + `groupBy()`, `having()`, `havingRaw()`
    + `skip()`, `take()`

- insert
    
    ```php
    <?php 
    // insert
    DB::table('users')->insert([
        ['email' => 'taylor@example.com', 'votes' => 0],
        ['email' => 'dayle@example.com', 'votes' => 0]
    ]);

    // insert and get inserted ID
    $id = DB::table('users')->insertGetId(
        ['email' => 'john@example.com', 'votes' => 0]
    );
     ?>
    ```

- update
    + `update()`
    + `increment()`, `decrement()`
- delete
    + `delete()`
    + `truncate()`
- lock
    + `sharedLock()`: prevents the selected rows from being modified until your transaction commits
    + `lockForUpdate()`: prevents the rows from being modified or from being selected with another shared lock

## Migration
## Seeding

# Elquent ORM

## Basic

- all Eloquent models extend `Illuminate\Database\Eloquent\Model` class
- use `artisan make:model ModelName` to create a model

    ```php
    <?php 
    namespace App;

    use Illuminate\Database\Eloquent\Model;

    class Flight extends Model
    {
        /**
         * default is the snake case plural name of `Flight`: flights
         */
        protected $table; 
        /**
         * default is `id`
         */
        $primaryKey;
        /**
         * Elquent expect `created_at` and `updated_at` colums
         * to disable that assign $timestamps to false
         */
        public $timestamps = false;
        /**
         * customize the format of your timestamps
         */
        protected $dateFormat = 'U';
        /**
         * default connection is the default connection defined in config file
         */
        protected $connection = 'connection-name';
    }
     ?>
    ```

- retrieve multiple models
    + `Flight::all()`
    + Eloquent models are query builders, you can add additional constraits and use `->get()` to get the result
    + `all()` and `get()` will return collection, you can loop throught it
    + chunk:

        ```php
        <?php 
        Flight::chunk(200, function ($flights) {
            foreach ($flights as $flight) {
            }
        });
         ?>
        ```

- retrieve single models/aggregates
    + `::find($id)`, `->first()`
    + `::findOrFail($id)`, `->firstOrFail()`: will throw exception if not found
    + aggregates: see also chapter `Query Builder`
        
        ```php
        <?php 
        $count = App\Flight::where('active', 1)->count();
        $max = App\Flight::where('active', 1)->max('price');
         ?>
        ```

- insert & update
    + basic insert: __create__ a new model instance, set attributes on the model, then call the `save()` method, The `created_at` and `updated_at` timestamps will automatically be set
    + basic update:
        *  __retrieve__ a model, set attributes on the model, then call the `save()` method, The `updated_at` timestamps will automatically be set, or
        *  use `update()`

            ```php
            <?php 
            App\Flight::where('active', 1)
                      ->where('destination', 'San Diego')
                      ->update(['delayed' => 1]);
             ?>
            ```
    + use mass assignment
        1. define either `$fillable` or `$guarded` - not both, to make the attributes mass assignable
        2. then use `::create()` or `::firstOrCreate()` or `::firstOrNew()`

- delete
    + retrive then call `->delete()`
    + call `::destroy([1, 2, 3])` without retrive
    + query then delete: `::where('active', 0)->delete()`
    + soft delete
        1. enable soft delete

            ```php
            <?php

            namespace App;

            use Illuminate\Database\Eloquent\Model;
            use Illuminate\Database\Eloquent\SoftDeletes;

            class Flight extends Model
            {
                // 1. use the `SoftDelete` trait 
                use SoftDeletes;

                // 2. add `deleted_at` into `$dates`s
                protected $dates = ['deleted_at'];
            }
            ?>
            ```

        2. add the `deleted_at` column into your table, the Laravel schema builder can help you:
    
            ```php
            <?php 
            Schema::table('flights', function ($table) {
                $table->softDeletes();
            });
             ?>
            ```

        3. now, all deletion are soft unless you use `->forceDelete()`. if you want to find out whether a given model instance is soft deleted, use `->trashed()`, if you want to include the soft deleted records in the result, use `::withTrashed()`, if you want retrieve only soft deleted records, use `::onlyTrashed()`, if you want to restore soft deleted records, use `->restore()`

        4. __NOTE__: When adding orWhere clauses to your queries on soft deleted models, always use advance where clauses to logically group the WHERE clauses

- query scope
    1. define

        ```php
        <?php 
        namespace App;

        use Illuminate\Database\Eloquent\Model;

        class User extends Model
        {
            /**
             * just define a method prefixed with `scope`
             */
            public function scopePopular($query)
            {
                // scopes should always return a query builder instance
                return $query->where('votes', '>', 100);
            }

            /**
             * can also give it additional parameter
             */
            public function scopeOfType($query, $type)
                {
                    return $query->where('type', $type);
                }
            }
        }
         ?>
        ```

    2. usage:

    ```php
    <?php 
    $users = App\User::ofType('admin')->popular()->get();
     ?>
    ```

- events:
    + available events:
        * `creating`: when creating
        * `created`: after creation
        * `updating`: when updating
        * `updated`: after updating
        * `saving`: creating or updating
        * `saved`: created or updated
        * `deleting`
        * `deleted`
        * `restoring`
        * `restored`
    + to listen to the event:
    
        ```php
        <?php 
        // inside a ServieProvider
        public function boot()
        {
            User::creating(function ($user) {
                if ( ! $user->isValid()) {
                    return false;
                }
            });
        }

         ?>
        ```

## Relationship

- supported relationship
    + One To One
    + One To Many
    + Many To Many
    + Has Many Through
    + Polymorphic Relations
    + Many To Many Polymorphic Relations

### defining

- one to one
    
    ```php
    <?php
    // in User Model...

    /**
     * Eloquent relationships are defined as functions on your
     * Eloquent model
     */
    public function phone()
    {
        /**
         * first argument: the name of the related model
         * second argument: foreign key, here default is user_id, you can 
         *                 override it as bellow
         * third argument: local key, default is id, you can override it as
         *                 bellow
         */
        return $this->hasOne('App\Phone', 'my_foreign_key', 'my_local_key');
    }

    // in Phone Model
    public function user()
    {
        return $this->belongsTo('App\User', 'my_foreign_key', 'parent_custom_key');
    }
     ?>
    }
    ```

- one to many

    ```php
    <?php
    // in Post model
    public function comments()
   {
       return $this->hasMany('App\Comment', 'foreign_key', 'local_key');
   }

    // in Comment model
    public function post()
    {
        return $this->belongsTo('App\Post', 'foreign_key', 'other_key');
    }
     ?>
    }
    ```

- many to many

    ```php
    <?php
    // in User Model
    public function roles()
    {
        /**
         * second argument: the join table name, default is ordered by 
         *                 alphabetical: `role_user`, you can override it
         * third argument: foreign key of current model
         * fourth argument: foreign key of joining model
         * 
         * pivot: the joining table model 
         * by default, only the model keys will be present on the pivot 
         * object. If your pivot table contains extra attributes, you must
         * specify them when defining the relationship, use
         * 
         * `->withPivot('column1', 'column2', ...)`
         * 
         * if you want your pivot table to have automatically maintained 
         * `created_at` and `updated_at` timestamps, use:
         * 
         * `->withTimestamps()`
         */
        return $this->belongsToMany('App\Role', 'user_roles', 'user_id', 'role_id');
    }

    // in Role Model
    public function users()
    {
        /**
         * see above
         */
        return $this->belongsToMany('App\User');
    }
     ?>
    ```

- has many through: short-cut for accessing distant relations via an intermediate relation, for example: country->user->post

    ```
    table structure:

    countries
        id - integer
        name - string

    users
        id - integer
        country_id - integer
        name - string

    posts
        id - integer
        user_id - integer
        title - string
    ```

    ```php
    <?php
    // in Country Model
    public function posts()
    {
        /**
         * first argument: final model name
         * second argument: intermediate model name
         * third argument: intermediate foreign key
         * fourth argument: final model foreign key
         */
        return $this->hasManyThrough('App\Post', 'App\User', 'country_id', 'user_id');
    }
     ?>
    }
    ```

- polymorphic relation: allow a model to belong to more than one other model on a single association, for example, a photo table storing both staff photos and products photos:

    ```
    table structure:

    staff
        id - integer
        name - string

    products
        id - integer
        price - integer

    photos
        id - integer
        path - string
        imageable_id - integer
        imageable_type - string
    ```

    ```php
    <?php
    // DEFINE
    // in Photo Model
    public function imageable()
    {
        return $this->morphTo();
    }

    // in Staff Model
    public function photos()
    {
        return $this->morphMany('App\Photo', 'imageable');
    }

    // in Product Model
    public function photos()
    {
        return $this->morphMany('App\Photo', 'imageable');
    }

    // USAGE
    // - retrieve by dynamic property
    App\Staff::find(1)->photos
    // - retrive the owner of the polymorphic relation, this will return 
    //   either Staff or Product instance
    App\Photo::find(1)->imageable()
     ?>
    ```

- many to many polymorphic relations: for example, Post, Video and Tag

    ```
    table structure:

    posts
        id - integer
        name - string

    videos
        id - integer
        name - string

    tags
        id - integer
        name - string

    taggables
        tag_id - integer
        taggable_id - integer
        taggable_type - string
    ```

    ```php
    <?php
    // in Post Model
    public function tags()
    {
        return $this->morphToMany('App\Tag', 'taggable');
    }

    // in Video Model
    public function tags()
    {
        return $this->morphToMany('App\Tag', 'taggable');
    }

    // in Tag Model
    public function posts()
    {
        return $this->morphedByMany('App\Post', 'taggable');
    }

    public function videos()
    {
        return $this->morphedByMany('App\Video', 'taggable');
    }

    // USAGE
    // - access relationship by dynamic property
    App\Post::find(1)->tags
    // - retrieve the owner of a polymorphic relation by dynamic property
    App\Tag::find(1)->videos
     ?>
    ```

- touch:  update the parent's timestamp when the child model is updated

    ```php
    <?php
    // in Comment Model
    protected $touches = ['post'];
    // now when comment update, Post will have its `updated_at` updated as well
     ?>
    ```


### Access

- since Eloquent provides `dynamic properties`, we can access relationship functions as if they were defined as properties on the model. dynamic properties are lazy loading

    ```php
    <?php
    $user = App\User::find(1)->posts
    foreach ($user->posts as $user) {
        // 
    }
     ?>
    ```

- relationships also serve as powerful query builders, you are able to use any of the query builder methods on the relationship

    ```php
    <?php
    $user = App\User::find(1);
    $user->posts()->where('active', 1)->get();
     ?>
    ```

- querying relationship existence

    ```php
    <?php
    // Retrieve all posts that have at least one comment...
    $posts = App\Post::has('comments')->get();

    // Retrieve all posts that have three or more comments...
    $posts = Post::has('comments', '>=', 3)->get();

    // Retrieve all posts that have at least one comment with votes...
    $posts = Post::has('comments.votes')->get();

    // Retrieve all posts with at least one comment containing words like foo% 
    // or...
    $posts = Post::whereHas('comments', function ($query) {
        $query->where('content', 'like', 'foo%');
    })
        ->orWhereHas(...)
        ->get();
     ?>
    ```

- eager loading: alleviates the N + 1 query problem, use `with()`
    
    ```php
    <?php
    /**
     * - to eager load multiple relationships:
     *     `with(): `::with('author', 'publisher')`
     * - to eager load nested relationships:
     *     `::with('author.contacts')`
     * - to constrain the eager loaded relationships:
     *     ```
     *     with(['posts' => function ($query) {
     *         // you can call other query builder to furthur customize
     *         $query->where('title', 'like', '%first%');
     *     }])
     *     ```
     */
    $books = App\Book::with('author')->get();

    foreach ($books as $book) {
        echo $book->author->name;
    }
     ?>
    ```

- lazy eager loading

    ```php
    <?php
    // use `load()`
    // similar to `with()`, you can multiple, nest, constrain it, too
    $books = App\Book::all();

    if ($someCondition) {
        $books->load('author', 'publisher');
    }
     ?>
    ```

### Insert

- insert single: `save()` or `create()`

    ```php
    <?php
    // `save()` accepts a full Eloquent model instance
    $comment = new App\Comment(['message' => 'A new comment.']);
    $post = App\Post::find(1);
    $post->comments()->save($comment);

     // while `create()` accepts a plain PHP array
     // remeber to review mass assignment config
    $post = App\Post::find(1);
    $comment = $post->comments()->create([
        'message' => 'A new comment.',
    ]);
     ?>
    ```

- insert multiple: `saveMany()`

    ```php
    <?php
    $post = App\Post::find(1);

    $post->comments()->saveMany([
        new App\Comment(['message' => 'A new comment.']),
        new App\Comment(['message' => 'Another comment.']),
    ]);
     ?>
    ```

- save & many to many @?

    ```php
    <?php
    App\User::find(1)->roles()->save($role, ['expires' => $expires]);
     ?>
    ```

- updating `belongs to` relationship

    ```php
    <?php
    // set the foreign key on the child model
    $account = App\Account::find(10);
    $user->account()->associate($account);
    $user->save();

    // reset the foreign key as well as the relation on the child model
    $user->account()->dissociate();
    $user->save();
     ?>
    ```

- many to many

    ```php
    <?php
    $user = App\User::find(1);

    /**
     * attach a role to a user by inserting a record in the intermediate table 
     * that joins the models
     */
    $user->roles()->attach($roleId);
    /**
     * you may also pass an array of additional data to be inserted into the 
     * intermediate table
     */
    $user->roles()->attach($roleId, ['expires' => $expires]);

    // Detach a single role from the user...
    $user->roles()->detach($roleId);
    // Detach all roles from the user...
    $user->roles()->detach();

    // attach and detach also accept arrays of IDs as input
    $user->roles()->detach([1, 2, 3]);
    $user->roles()->attach([1 => ['expires' => $expires], 2, 3]);

    // after sync, only the IDs in the array will exist in the intermediate 
    // table
    $user->roles()->sync([1, 2, 3]);
    $user->roles()->sync([1 => ['expires' => true], 2, 3]);
     ?>
    ```

## Collections

- all multi-result sets returned by Eloquent are an instance of the  `Illuminate\Database\Eloquent\Collection` object, so all these methods are available:
    + `all()`
    + `chunk()`
    + `collapse()`
    + `contains()`
    + `count()`
    + `diff()`
    + `each()`
    + `every()`
    + `filter()`
    + `first()`
    + `flatten()`
    + `flip()`
    + `forget()`
    + `forPage()`
    + `get()`
    + `groupBy()`
    + `has()`
    + `implode()`
    + `intersect()`
    + `isEmpty()`
    + `keyBy()`
    + `keys()`
    + `last()`
    + `map()`
    + `merge()`
    + `pluck()`
    + `pop()`
    + `prepend()`
    + `pull()`
    + `push()`
    + `put()`
    + `random()`
    + `reduce()`
    + `reject()`
    + `reverse()`
    + `search()`
    + `shift()`
    + `shuffle()`
    + `slice()`
    + `sort()`
    + `sortBy()`
    + `sortByDesc()`
    + `splice()`
    + `sum()`
    + `take()`
    + `toArray()`
    + `toJson()`
    + `transform()`
    + `unique()`
    + `values()`
    + `where()`
    + `whereLoose()`
    + `zip()`
- if you need to use a custom Collection object with your own extension methods, you may override the newCollection method on your model
- all collections also serve as iterators
- an example to show the power of collections:
    
    ```php
    <?php
    $users = App\User::where('active', 1)->get();

    $names = $users->reject(function ($user) {
        return $user->active === false;
    })
    ->map(function ($user) {
        return $user->name;
    });
     ?>
    ```

## Mutator & Accessor

-  mutator: format value when setting Elquent attributes
-  accessor: format value when retrieving Eloquent attributes
-  for example, encrypted in DB but auto decrypted when accessing it in Eloquent model
- define
    
    ```php
    <?php
    // in User Model

    // Accesor
    public function getFirstNameAttribute($value)
    {
        return ucfirst($value);
    }

    // Mutator
    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = strtolower($value);
    }
     ?>
    ```

- date mutator 
    + by default, Eloquent will convert the `created_at` and `updated_at` columns to instances of `Carbon`
    + customize which fields are automatically mutated, and even completely disable this mutation, by overriding the `$dates` property of your model
    + timestamps are formatted as `'Y-m-d H:i:s'`. If you need to customize the timestamp format, set the `$dateFormat` property on your model

- attribute casting
    + the `$casts` property on your model provides a convenient method of converting attributes to common data types
    + supported types: `integer`, `real`, `float`, `double`, `string`, `boolean`, `object`, `array`, `collection`,  `date` and `datetime`
    + the array cast type is particularly useful when working with columns that are stored as serialized JSON

    ```php
    <?php
    // in User Model
    
    protected $casts = [
        'is_admin' => 'boolean',
        /**
         * options JSON text in db will automatically be deserialized into a 
         * PHP array when you access it
         * 
         * automatically serialized into JSON when you store options
         */
        'options' => 'array',
    ];

     ?>
    ```

## Serialization

- when building JSON APIs, you will often need to convert your models and relationships to arrays or JSON. Eloquent includes convenient methods for making these conversions, as well as controlling which attributes are included in your serialization
- the conversion is recursive, including model's relations

```php
<?php
// TO ARRAY

// - convert single model
$user = App\User::with('roles')->first();
return $user->toArray();
// - also work for collections
$users = App\User::all();
return $users->toArray();

// TO JSON
// - use `toJson()`
$user = App\User::find(1);
return $user->toJson();
// - use `string` cast
$user = App\User::find(1);
return (string) $user;
// -  return Eloquent objects directly from your application's routes or
//    controllers
Route::get('users', function () {
    return App\User::all();
});
 ?>
```

- to hide attributes in your model's array or JSON representation, use either model's `$hidden` or `$visible` property
- to add array attributes that do not have a corresponding column in your database

        ```php
        <?php
        // in User Model
        

        // 1. define an accesor for the value
        public function getIsAdminAttribute()
        {
            return $this->attributes['admin'] == 'yes';
        }

        // add the attribute name to the appends property on the model
        // appends attributes also respect the visible and hidden settings 
        protected $appends = ['is_admin'];
         ?>
        ```

# Services

## Artisan

-  command-line interface included with Laravel
-  built in command:
    +  `artisan list`
    +  `artisan help <command>`

### Create

- create a command boilterplate: `php artisan make:console ClassName --command=command:name`
- you should fill out the `$signature` and `$description` properties of the class, which will be used when displaying your command on the list screen.
- the `handle()` method will be called when your command is executed.
- __NOTE__:it is good practice to keep your console commands light and let them defer to application services to accomplish their tasks

```php
<?php
class SendEmails extends Command
{
    /**
     * `$signature` allows you to define the name, arguments, and options
     * 
     * - name: `email:send`
     * - argument: 
     *     + required: {user}
     *     + optional: {user?}
     *     + with default value: {user=foo}
     *     + with description: {user : The ID of the user}
     * - options(prefixed with `--`)
     *     + boolean option: {--queue}
     *     + user provided value option: {--queue=} 
     *     + with default value: {--queue=default}
     *     + with shortcut: {--Q|queue}
     *     + with description: {--queue= : whether the job should be queued}
     */
    protected $signature = 'email:send {user}';

    protected $description = 'Send drip e-mails to a user';

    public function __construct(DripEmailer $drip)
    {
    }

    /**
     * main logic here
     */
    public function handle()
    {
        // INPUT
        /**
         * access user input
         */
        $this->argument('user');
        $this->option('queue');

        /**
         * prompt for user input
         */
        $this->ask('What is your name?');
        $this->secret('What is your password?');

        /**
         * ask for confirmation
         */
        $this->confirm('Do you wish to continue [y|N]');

        /**
         * ask for choice
         */
        $this->anticipate('What is your name?', ['Tylor', 'Dayle']); // non-mandatory
        $this->choice('What is your name?', ['Tylor', 'Dayle']); // mandatory

        // OUTPUT
        $this->info(); // green
        $this->error(); // red
        $this->line(); // no color

        /**
         * table layout
         */
        $this->table($header, $data); 
        /**
         * progress bar
         */
        $bar = $this->output->createProgressBar(count($users)); // total steps
        foreach ($users as $user) {
            $this->performTask($user);
            $bar->advance(); // advance one step
        }
        $bar->finish(); // complete

    }
}
 ?>
```

### register

- add the class name to the `app\Console\Kernel::$commands`

### call from existing command

- `$this->call('email:send', ['user'=>1]);`
- `$this->callSilent('email:send', ['user'=>1]);`


## Encryption

- set the key option of your `config/app.php` configuration file to a 32 character, random string
- all encrypted values are encrypted using OpenSSL and the AES-256-CBC cipher. Furthermore, all encrypted values are signed with a message authentication code (MAC) to detect any modifications to the encrypted string
- encrypt: `Crypt::encrypt()`
- decrypt: `Crypt::decrypt()`

## Hashing

- provides secure Bcrypt hashing for storing user passwords
- hash
    + `Hash::make()`
    + `bcrypt()`
- verify: `Hash::check('plain-text', $hashedPwd)`
- check if needs to rehash: `Hash::needsRehash($hashedPwd)`

## Helper

- Arrays
    + array_add
    + array_collapse
    + array_divide
    + array_dot
    + array_except
    + array_first
    + array_flatten
    + array_forget
    + array_get
    + array_has
    + array_only
    + array_pluck
    + array_pull
    + array_set
    + array_sort
    + array_sort_recursive
    + array_where
    + head
    + last

- Paths
    + app_path
    + base_path
    + config_path
    + database_path
    + elixir
    + public_path
    + storage_path

- Strings
    + camel_case
    + class_basename
    + e
    + ends_with
    + snake_case
    + str_limit
    + starts_with
    + str_contains
    + str_finish
    + str_is
    + str_plural
    + str_random
    + str_singular
    + str_slug
    + studly_case
    + trans
    + trans_choice

- URLs
    + action
    + asset
    + secure_asset
    + route
    + url

- Miscellaneous
    + auth
    + back
    + bcrypt
    + collect
    + config
    + csrf_field
    + csrf_token
    + dd
    + env
    + event
    + factory
    + method_field
    + old
    + redirect
    + request
    + response
    + session
    + value
    + view
    + with

## Queues

- config file: `config/queue.php`
- drive set up
    + database: `artisan queue:table`, `artisan migrate`
    + Amazon SQS: `aws/aws-sdk-php ~3.0`
    + Beanstalkd: `pda/pheanstalk ~3.0`
    + IronMQ: `iron-io/iron_mq ~2.0|~4.0`
    + Redis: `predis/predis ~1.0`

## Pagination

### create

- for query builder result
    + `DB::table('users')->paginate(15);`
    + `DB::table('users')->paginate(15);`: only show `prev` and `next` links
- for eloquent result
    + `App\User::paginate(15);`
    + `User::where('votes', '>', 100)->paginate(15);`
    + `User::where('votes', '>', 100)->simplePaginate(15);`
- manually
    + create a `Illuminate\Pagination\LengthAwarePaginator` instance
    + or  create a `Illuminate\Pagination\Paginator` instance for simple pagination

__note__: pagination operations that use a `groupBy` statement cannot be executed efficiently by Laravel. If you need to use a `groupBy` with a paginated result set, it is recommended that you query the database and create a paginator manually

### display

```php
<?php
<div class="container">
    @foreach ($users as $user)
        {{ $user->name }}
    @endforeach
</div>

{!! $users->render() !!} // pager, __note__: must inside !!
 ?>
```

- to custom the paginator URI, use `$users->setPath()`
- to append query string to page links, use `$users->appends([])->render()`
- to append hash tag, use `$users->fragment('foo')->render()`
- to retrieve info from paginator:
    + `->count()`
    + `->currentPage()`
    + `->hasMorePages()`
    + `->lastPage()`
    + `->nextPageUrl()`
    + `->perPage()`
    + `->previousPageUrl()`
    + `->total()`
    + `->url($page)`

### convert to JSON(for API response)

- use `->toJson()`
- directly return from route or controller action

# Security

## CSRF protection

- use `csrf_token()` to generate a csrf token
- use `csrf_filed()` to generate a csrf hidden input filed
- use `VerifyCsrfToekn::$except` property to exclude URIs from auto 
  CSRF protection



[symfonyFile]: http://api.symfony.com/2.7/Symfony/Component/HttpFoundation/File/UploadedFile.html