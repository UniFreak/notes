see PSR2, PSR4

Always use curly braces

Always attempt to return a meaningful value from a function if one is appropriate

declare variable before using them

typehint everywhere

@? user assertions for scalars

use === instead of ==

use bracket to make your operator precedence more clear

use the built-in password hashing functions to hash and compare passwords, it
  also salts your password for you

favor PDO

use only `<?php` `?>` and `<?=` `?>` tags

use `spl_autoload_register()`, not `autoload()` to autoload your classes

favor `define()` instead of `const` to define constant

caching PHP opcode(APC)

If you need a distributed cache, use the Memcached client library. Otherwise, use APCu

serve PHP from a web-server use PHP-FPM

use `PHPMailer` instead of built-in `mail()` function to send mail

use `filter_var()` to validate email address

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

always use the `DateTime` class for creating, comparing, changing, and displaying dates in PHP

when testing the return value of a function that can return either 0 or boolean
false, like `strpos()`, always use `===` and `!==`

Structuring your data right in the first place can help a lot

When there's no `else`, I prefer to explicitly halt at the top, so people don't have to scan ahead to see whether there's an else clause

after a query, always check if query result available before using it

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