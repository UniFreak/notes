# PHP

- OpCode Caches

are a performance enhancing extension for PHP. They do this by injecting themselves into the execution life-cycle of PHP and caching the results of the compilation phase for later reuse

- eAccelerator
- APC Cache(Alternative PHP Cache)

    Cons:
    - Lacks some features found in Zend's offering
    - Lacks maintainers, doesn't support PHP 5.5 at all
    Pros:
    - APC also has userland caching(which is confusing, but APCu take over this)
- XCache
- Zend
    Cons: It was proprietary
- Zend OpCache(open source Zend, same as the `OpCache` in PHP documentation)
    Pros:
    - Built-in
    - More performant than APC
    - More fully featured
    - More reliable

# Data Caches

MemCached
Redis