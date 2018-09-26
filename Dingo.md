#Installation

1. require: `composer require dingo/api:1.0.x@dev`
2. register as provider
    - laravel: 
    ```php
    <?php
    'providers' => [
        Dingo\Api\Provider\LaravelServiceProvider::class
    ]
     ?>
    ```
    - lumen: `$app->register(Dingo\Api\Provider\LumenServiceProvider::class);`
3. [optional]add facades
    - `Dingo\Api\Facade\API`
    - `Dingo\Api\Facade\Route`

#Config

- you can config via 
    + `.env` 
    + laravel: publish the config file
    + lumen: `bootstrap/app.php`
    + `AppServiceProvider`'s `boot` method
- standard tree@?: `API_STANDARDS_TREE=vnd`
    + `x`
    + `prs`
    + `vnd`
- subtype: `API_SUBTYPE=myapp`
- prefix: `API_PREFIX=api` or domain `API_DOMAIN=api.myapp.com`
- version: `API_VERSION=v1`
- name: `API_NAME=My API`
- conditional request@?: `API_CONDITIONAL_REQUEST=false`
- strict mode@?: `API_STRICT=false`
- authentication provider@?, default is basic auth
- throttling@?
- response transformer@?, default is `Fractal`
- response format, default is JSON: `API_DEFAULT_FORMAT=json`
- error format:
    ```php
    <?php
    $app['Dingo\Api\Exception\Handler']->setErrorFormat([
           'error' => [
               'message' => ':message',
               'errors' => ':errors',
               'code' => ':code',
               'status_code' => ':status_code',
               'debug' => ':debug'
           ]
       ]);
     ?>
    ```
- debug mode: `API_DEBUG=true`
