# Getting started
## Built-in web server
- only one single-threaded process
- PHP applications will stall if a request is blocked
- `php -S localhost:8888`
- 如果报错(Unknown: php_network_getaddresses: getaddrinfo failed)
    - 1. 确保 hosts 文件里有配置 localhost
    - 2. 直接使用 `php -S 127.0.0.1:8888`

## Install
- Mac: Homebrew / MacPorts / phpbrew / php-osx.liip.ch

# Code style guide
- PSR-0 / PSR-1 / PSR-2 / PSR-4
- PEAR coding standards / Symfony coding standards
- PHP_CodeSniffer / PHP Coding Starndards Fixer / PHP Code Beautifier and Fixer

# Language highlights
- OO Programming: very complete set of object-oriented programming features
- Functional Programming
    + first-class functions, a function can be assigned to a variable
    + Functions can be passed as arguments to other functions
    + higher-order functions: a function can return other functions
    + resursion: a function cal call itself
    + Anonymous functions with support for closures
    + closure: an anonymous function that can access variables imported from the outside scope without using any global variables
- Meta Programming
    + Reflection API
    + Magic Methods(__get(), __set(), ...)
- XDebug & MacGDBp
    + remove debugging let you develop code locally and then test it inside a VM or on another server

# Dependency management
- Composer & Packagist 
    + If you share your project with others, ensure the composer.lock file is included
    + Don’t use composer update when deploying, only composer install
    + handling PEAR dependencies with composer, like:
    ```
    {
            "config" : {
                    "secure-http": "false"
            },
            "repositories": [
                    {
                            "type": "pear",
                            "url": "https://pear2.php.net"
                    }
            ],
            "require": {
                    "pear-pear2.php.net/PEAR2_Text_Markdown": "*",
                    "pear-pear2/PEAR2_HTTP_Request": "*"
            }
    }
    ```
    
- VersionEye
- Security Advisories Checker


# Coding practice

## Basic
- save your `else`
- `switch` only compare value, not the type (`==`)
- in function, `return` can save `switch`'s `break`
- long string:
    ```
    $a = 'Multi-line example'      // concatenation operator (.)
        . "\n"                     // indenting new lines
        . 'of what to do';
    ```

## Date & Time
- DateTime / DateInterval / ....
- Carbon package    

## handle UTF-8
- use `mb_*` functions
- `mb_internal_encoding()` at the top of every PHP script 
- `mb_http_output()` before outputting to a browser
- always explicitly indicate UTF-8 when given the option
- all set to the utf8mb4 character set and collation
- use the utf8mb4 character set in the PDO connection string
- setting the charset in the Content-Type header