# spaceship operator: `<=>`

# typehint

new support
- basic type: string, int, float, bool
- return value: `func() : int {}`, support `void`
- `?int`: null or int

# operator `??`

# array constant

```php
define('ANIMALS', ['dog', 'cat', 'bird']);
```

# namespace batch import

```php
use Space\{ClassA, ClassB, ClassC as C}
```

# `throwable` interface

# `Closure::call()`

```php
class Test {
    private $num = 1;
}

$f = function() {
    return $this->num + 1;
}
echo $f->call(new Test);
```

# `intdiv()` function

# `[]` act as `list()`

```php
$arr = [1, 2, 3];
[$a, $b, $c] = $arr;
```