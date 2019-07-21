if $a is false then set it to 'default':

```php
$a = $a || 'default';
```

you can do things with += and + like this:

```php
$a += $a + 1;
```

```php
/**
 * test if $date is a valid date string
 * @return {boolean}
 */
function validateDate($date) {
    return $date == date('Y-m-d', strtotime($date));
}
```

```php
/**
 * same as foreach($products as $option => $value) { }
 * more readable
 *
 * NOTE: each is deprecated in 7.2.0
 */
while (list($option, $value) = each($products)) { }
```

```php
$var = explode(',', $ary)[idx];
```

生成一串随机字符串
1. `substr(md5(rand()), 0, 20)`
2. `substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 30)`

return `$this` at the end of method will make this method chainable

set utf8 header: `header('Content-Type: text/html; charset=utf-8');`

```php
/**
 * in case of error when foreaching
 */
if(!is_array($models))
    $models=array($models);
foreach($models as $model) { //... }
```


```php
// those are NOT the same. use bracket!
$a = true ? '8' : (true ? '7' : 6);
$a = true ? '8' : true ? '7' : 6;
```


```php
// wrong
($a == 5) ? return true : return false;
// corrent
return ($a == 5) ? true : false;
// better: see below
return ($a == 5);
```

```php
/**
 * you don't need ternary operator to return boolean value
 * this is true for all operators(===, !==, !=, ==, etc)
 */
// not good
return ($a == 3) ? true : false;
// more concise
return $a == 3;
```
