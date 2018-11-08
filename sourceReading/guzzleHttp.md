# know this
- ~~cookie: discard~~
- ~~curl: easy handle~~
- ~~stream vs socket vs pipe~~
- ~~php curl~~
- PHP non-blocking event loops

# pre-knowledge
- Guzzle will, by default, store the body of a message in a stream that uses PHP temp streams. When the size of the body exceeds 2 MB, the stream will automatically switch to storing data on disk rather than in memory 

# submodles
- cookie: manipulate cookies
- exceptions
- handlers: curl, stream
- middleware
- client

# interest point
- async request & promise & fullfilled with a response?
- handler vs middleware?
- how middleware is implemented?
- how promises is implemented?
- concurrent reqeusts
- stream
- what are docs/ and build/ folder for

# codique
- 多条件格式:

```php
if ($c->getPath() != $cookie->getPath() ||
    $c->getDomain() != $cookie->getDomain() ||
    $c->getName() != $cookie->getName()
) {
    continue;
}
```

- 三目格式:

```php
$code = $response && !($response instanceof PromiseInterface)
    ? $response->getStatusCode()
    : 0;
```

- 静态工厂

```php
public static function fromString($cookie)
```

- `validate()` method can **return a error message string**

- wonderfule functions

```php
func_get_args();
__invoke();
```