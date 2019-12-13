# See
- Book <Modern PHP>

# Code Style

See PSR1, PSR2

# Autoloading: PSR4

The essence of PSR-4 is mapping a top-level namespace prefix to a specific filesystem directory

Like this:

```php
spl_autoload_register(function ($class) {
    $prefix = 'Foo\\Bar\\';
    $base_dir = __DIR__ . '/src';
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return; // move to the next registerd autoloader
    }

    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    if (file_exists($file)) {
        require $file;
    }
})
```

But you shouldn't write your own autoloader, use Composer instead

# Security

Trust no one: sanitize input, validate data, escape output

## Sanitize Input

- HTML

use `htmlentities()` function or `HTMLPurifier` package.
DONT use regex replacement

- SQL queries

use PDO and prepared statement
DONT use `mysql_*` functions

- User profile

use `filter_var()` function

## Validate Data

use `filter_var()` with `FILTER_VALIDATE_*` flags or these package:
- aura/filter
- respect/validation
- symfony/validator

## Escape Output

use `htmlentities()` function or template engine
- twig/twig
- smarty/smarty

## Password

Never know or restrict or email user password!
Hash passwords with bcrypt and PHP's native password hashing API (`password_*` functions)

# Date, Times, and Time Zones

set a default time zone in `php.ini`
DONT manage dates and times on your own
use `DateTime`, `DateInterval`, `DateTimeZone`, `DatePeriod` class instead or `nsbot/carbon` package
It's easier to always work in the UTC time zone (server, PHP, DB, display)

# Mutlibyte Strings

Use UTF8 every where:
- `php.ini` `default_charset` setting
- `header()` function
- HTML `<meta>` tag
- Database
- Source files

# Error and Exception

Choose or create the exception subclass that best ansers why am I throwing this exception
and document your choice

You must act defensively when using PHP components and frameworks written by other developers

Surround code that might throw an exception with a try/catch block

Always set a global exception handler, and log exceptions inside it

It's considered good etiquette to restore the previous error handler after your own code is done

Display errors during development (Whoops package), log errors in production (Monolog package)

# Coding

Always use curly braces

Always attempt to return a meaningful value from a function if one is appropriate

declare variable before using them

typehint everywhere

use === instead of ==

use bracket to make your operator precedence more clear

use the built-in password hashing functions to hash and compare passwords, it
  also salts your password for you

use `spl_autoload_register()`, not `autoload()` to autoload your classes

favor `define()` instead of `const` to define constant

serve PHP from a web-server use PHP-FPM

use `PHPMailer` instead of built-in `mail()` function to send mail

UTF8
- use the `mb_*` functions whenever you operate on a Unicode string
- use the `mb_internal_encoding()` function at the top of every PHP script you
  write (or at the top of your global include script), and the `mb_http_output()`
  function right after it if your script is outputting to a browser
- always explicitly indicate UTF-8 when given the option. For example, `htmlentities()`
- always URL encode all of your filenames before writing them
- make sure your database and tables are all set to the `utf8mb4` character set
  and collation, and that you use the `utf8mb4` character set in the PDO connection string
- In your HTML, include the charset meta tag in your page’s <head> tag

if a function is for testing, use `is...` as its function name like: isBigger, isGood, isValidUTF8String

You must always consider your business carefully

```php
/**
 * - use concatenation operator instead of concatenating assignment operator
 * - ident when concatenation use a new line
 */
// bad
$a = 'multi-line example';
$a.= "\n";
$a.= 'of what not to do';
// good
$a = 'multi-line example'
    . "\n"
    . 'of what to do';
```

# Tooling

Use Composer

Automate server provision with
- Puppet
- Chef
- Ansible
- SaltStack

Automate server deployment with
- Capistrano
- Deployer
- Magallanes
- Rocketeer

Testing with
- Unit test: PHPUnit
- SpecBDD: PHPSpec
- StoryBDD: Behat
