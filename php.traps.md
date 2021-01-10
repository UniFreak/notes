# See 

<http://www.phpinternalsbook.com/>

# PHP5

People often say that objects are automatically passed by-reference since PHP 5, but as the above example shows this is not true: A by-value function cannot modify the value of the variable that was passed to it, only a by-reference function can do that.

It is true however that objects exhibit a “reference-like” behavior: While you can not assign a completely different value, you can still change the properties of the object. This is a result of the fact than an object value is just an ID that can be used to look up the “actual content” of the object. Value-semantics only prevent you from changing this ID to a different object or switching the type altogether, but they do not prevent you to change the “actual content” of the object.

The same applies to resources.

```php
// Still true in PHP7
$obj = (object) ['value' => 1];

function fnByVal($val) {
    $val = 100;
}

function fnByRef(&$ref) {
    $ref = 100;
}

// The by-value function does not modify $obj, the by-reference function does:

fnByVal($obj);
var_dump($obj); // stdClass(value => 1)
fnByRef($obj);
var_dump($obj); // int(100)
```


gc refcount and copy on write

```php
$a = 1;    // $a =           zval_1(value=1, refcount=1)
$b = $a;   // $a = $b =      zval_1(value=1, refcount=2)
$c = $b;   // $a = $b = $c = zval_1(value=1, refcount=3)

$a++;      // $b = $c = zval_1(value=1, refcount=2)
           // $a =      zval_2(value=2, refcount=1)

unset($b); // $c = zval_1(value=1, refcount=1)
           // $a = zval_2(value=2, refcount=1)

unset($c); // zval_1 is destroyed, because refcount=0
           // $a = zval_2(value=2, refcount=1)
```


When refcount fails: circular reference memory leak.

To address this issue PHP has a second garbage collection mechanism: a cycle collector.
see <http://php.net/manual/en/features.gc.collecting-cycles.php>

```php
$a = []; // $a = zval_1(value=[], refcount=1)
$b = []; // $b = zval_2(value=[], refcount=1)

$a[0] = $b; // $a = zval_1(value=[0 => zval_2], refcount=1)
            // $b = zval_2(value=[], refcount=2)
            // The refcount of zval_2 is incremented because it
            // is used in the array of zval_1

$b[0] = $a; // $a = zval_1(value=[0 => zval_2], refcount=2)
            // $b = zval_2(value=[0 => zval_1], refcount=2)
            // The refcount of zval_1 is incremented because it
            // is used in the array of zval_2

unset($a);  //      zval_1(value=[0 => zval_2], refcount=1)
            // $b = zval_2(value=[0 => zval_1], refcount=2)
            // The refcount of zval_1 is decremented, but the zval has
            // to stay alive because it's still referenced by zval_2

unset($b);  //      zval_1(value=[0 => zval_2], refcount=1)
            //      zval_2(value=[0 => zval_1], refcount=1)
            // The refcount of zval_2 is decremented, but the zval has
            // to stay alive because it's still referenced by zval_1
```


PHP referece trigger copy

```php
$a = 1;   // $a =           zval_1(value=1, refcount=1, is_ref=0)
$b = $a;  // $a = $b =      zval_1(value=1, refcount=2, is_ref=0)
$c = $b   // $a = $b = $c = zval_1(value=1, refcount=3, is_ref=0)

$d =& $c; // $a = $b = zval_1(value=1, refcount=2, is_ref=0)
          // $c = $d = zval_2(value=1, refcount=2, is_ref=1)
          // $d is a reference of $c, but *not* of $a and $b, so
          // the zval needs to be copied here. Now we have the
          // same zval once with is_ref=0 and once with is_ref=1.

$d++;     // $a = $b = zval_1(value=1, refcount=2, is_ref=0)
          // $c = $d = zval_2(value=2, refcount=2, is_ref=1)
          // Because there are two separate zvals $d++ does
          // not modify $a and $b (as expected).

// As you can see &-referencing a zval with is_ref=0 and refcount>1 requires a copy. Similarly trying to use a zval with is_ref=1 and refcount>1 in a by-value context will require a copy. For this reason making use of PHP references usually slows code down: Nearly all functions in PHP use by-value passing semantics, so they will likely trigger a copy when an is_ref=1 zval is passed to them.
```

If you need to create resources, we really would like to push you not to, but instead use objects and their custom storage management.