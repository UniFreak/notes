# Interest
- how logger call handlers (handle, handleBatch)?

```php
// in addRecord():
while ($handler = current($this->handlers)) {
    if (true === $handler->handle($record)) {
        break;
    }

    next($this->handlers);
}
```


- how handler use processor

```php
// in Handler::handle():
if ($this->processors) {
    foreach ($this->processors as $processor) {
        $record = call_user_func($processor, $record);
    }
}
```

- how handler use formatter?

```php
// in (Processing)Handler::handle():
$record['formatted'] = $this->getFormatter()->format($record);
```

- why buffer handlers' constructors require a handler argument?

from doc:

>  **wrapper/special** handlers

> BufferHandler: This handler will buffer all the log records it receives until close() is called at which point it will call handleBatch() on the handler it wraps with all the log messages at once. This is very useful to send an email with all records at once for example instead of having one mail for every log record.

```php
// Q: to chain them up?
// A: yeah

// Q: in where? how the chainly call happen?
// A: when instantiating them, happen in flush():
if ($this->bufferSize === 0) {
    return;
}

$this->handler->handleBatch($this->buffer);
$this->clear();

// Q: what design pattern?
// A: decrator
```

# Coodie

- extensive usage of callback

```php
public function pushProcessor($callback)
{
    if (!is_callable($callback)) {
        throw new \InvalidArgumentException('Processors must be valid callables (callback or object with an __invoke method), '.var_export($callback, true).' given');
    }
    array_unshift($this->processors, $callback);

    return $this;
}
```