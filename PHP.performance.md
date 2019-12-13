# See
- Book <Modern PHP>

# Tool
Benchmark
- Apache Bench, aka AB
- JoeDog/Seige

Profiler
- Xdebug + KCacheGrind/WinCacheGrind/WebCacheGrind
- XHProf + XHGUI
- NewRelic
- Blackfire

# Ask Questions
1. decide what is the total amount of memory you can allocate for PHP
2. decide how much memory, on average, is consumed by a signle PHP process:
- `top` command
- `memory_get_peak_usage()` function
3. decide how many PHP-FPM processes you can afford
4. upgrade server if don't have enough system resources

# Zend OPcache Config

`memory_consumption` should be large enough to store the compiled opcode for all of your application's PHP scripts

`max_accelerated_files` should larger than the number of files in your PHP application

`validate_timestamps` should be turned on in development, off in production

Turn `fast_shutdown` on

# Enable Output Buffering
# Enable Realpath Cache

# Execution Time

Offload long-runing task to a separate worker process:

```php
exec('echo "create-report.php" | at now');
echo 'Reporting pending...';
```

Or, serve them with dedicated job queue

# Session Handling

Offload session handling to in-memory data store like Redis

