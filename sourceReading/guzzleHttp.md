# codique
- 三目格式:

```php
$code = $response && !($response instanceof PromiseInterface)
    ? $response->getStatusCode()
    : 0;
```
