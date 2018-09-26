#Start

##Install

- use
```
    composer global require "laravel/lumen-installer=~1.0"
    lumen new appName
```

- or: `composer create-project laravel/lumen blog "5.1.*"`

##Config
- all config reside in `.env` file
- if you wish, you can use full laravel style config with a `config` folder
- load your custom config file with `$app->configure('configFile')`
- first, setup a application key in `.env`
- `.env` file should not be committed to your application's source control
- you can get current app enviroment by 
    + `App:enviroment('envName1', 'envName2', ...)` or
    + `app()->enviroment()`
- to get the config value: `config('dot.notation')`
- to set the config value: `config(['item' => 'value']`


#Basic

##Route

@see `laravel.md#Route`

##Middleware

@see `laravel.md#Middleware`

##Controller

@see `laravel.md#Controller`

##Request

@see `laravel.md#Request`

##View

@see `laravel.md#View`

##Q&A
- make custom valiation
    1. make sure lumen has registered appServiceProvider in app.php
    2. make the validation class like `MobileValidator`
    3. in appServiceProvider::boot() method, do Validator::extends(...)
    4. add error message in `resource\lang\en\validation`