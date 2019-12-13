# todo
- set up sublime text's file_link_format
- cachegride and http debug session
- conditional breakpoint and watch expression

# Build-in

- phpdbg
- vld
- PHP-Parser

# Xdebug

## Feature

- Better var_dump()
- Stack trace error message
- Trace logs
- Profiling logs (with Cachegrind | Valgrind | KCachegrind | WinCachegrind to analyz profile logs)
- Debugging (with Eclipse PDT)
    + pass a parameter `XDEBUG_SESSION_START=<session name>`
    + `XDEBUG_SESSION_STOP` to the script by GET, POST, or cookie to start
    + stop a debug session
    + xdebug also requires setting of a IDE key, but Eclips PDT do it for you
- Code coverage (with PHPUnit and Phing)

## Installation
1. pecl install xdebug
2. wget http://xdebug.org/files/xdebug-2.4.0rc1.tgz
3. tar -xzf xdebug-2.4.orc1.tgz
4. cd xdebug-2.0.1
5. phpize
6. ./configure --enable-xdebug --with-php-config=/usr/bin/php-config
7. make
8. cp modules/xdebug.so /usr/lib/apache2/modules/xdebug.so
9. Activation: `zend_extension="/path/to/your/xdebug.so"`

## Settings(in php.ini or with ini_set() call)
- xdebug.defualt_enabled
- xdebug.force_display_errors
- xdebug.force_error_reporting
- xdebug.halt_level
- xdebug.max_nesting_level
- xdebug.scream
---
- xdebug.var_display_max_children
- xdebug.var_display_max_data
- xdebug.var_display_max_depth
---
- xdebug.cli_color
- xdebug.file_link_format
- xdebug.trace_format
---
-  xdebug.overload_var_dump
---
- xdebug.collect_vars
- xdebug.collect_assignments
- xdebug.collect_params
- xdebug.collect_return
- xdebug.collect_includes
- xdebug.dump.*
- xdebug.dump_globals
- xdebug.dump_undefined
- xdeubg.dump_once
- xdebug.show_local_vars
- xdebug.show_exception_trace
- xdebug.show_mem_delta
---
- xdebug.auto_trace
- xdebug.trace_enable_trigger
- xdebug.trace_enable_trigger_value
- xdebug.trace_options
- xdebug.trace_output_dir
- xdebug.trace_output_name
    + %c  crc32 of the current working directory
    + %p  pid
    + %r  random number
    + %s  script name
    + %t  timestamp (seconds)
    + %u  timestamp (microseconds)
    + %H  $_SERVER['HTTP_HOST']
    + %R  $_SERVER['REQUEST_URI']
    + %U  $_SERVER['UNIQUE_ID']
    + %S  session_id (from $_COOKIE if set)
    + %%  literal %
---
- xdebug.coverage_enable
---
- xdebug.profiler_enable
- xdebug.profiler_enable_trigger
- xdebug.profiler_enable_trigger_value
- xdebug.profiler_output_dir
- xdebug.profiler_output_name
- xdebug.profilter_append
---
- xdebug.remote_enable
- xdebug.remote_autostart
- xdebug.remote_cookie_expire_time
- xdebug.remote_host
- xdebug.remote_port
- xdebug.remote_connect_back
- xdebug.remote_mode=req|jit
- xdebug.remote_handler
- xdebug.remote_log
---
- xdebug.extended_info
- xdebug.idekey
---
- xdebug.manual_url

## Functions
- xdebug_disable()
- xdebug_enable()
- xdebug_is_enabled()
---
- xdebug_call_file()
- xdebug_call_class()
- xdebug_call_function()
- xdebug_call_line()
---
- // really useful if you want to prevent Xdebug's powerful error reporting
- // features from destroying your layout:
- xdebug_start_error_collection()
- xdebug_stop_error_collection()
- xdebug_get_collected_errors()
---
- xdebug_get_headers()
-
- xdebug_memory_usage()
- xdebug_peak_memory_usage()
---
- xdebug_time_index()
---
- *xdebug_debug_zval()
- xdebug_debug_zval_stdout()
- xdebug_dump_superglobals()
- xdebug_var_dump()
---
- xdebug_get_declared_vars()
- xdebug_get_function_stack()
- xdebug_print_function_stack()
- xdebug_get_stack_depth()
---
- xdebug_get_tracefile_name()
- xdebug_start_trace()
- xdebug_stop_trace()
---
- xdebug_start_code_coverage()
- xdebug_stop_code_coverage()
- xdebug_code_coverage_started()
- xdebug_get_code_coverage()
---
- xdebug_get_profiler_filename()
---
- xdebug_break()

## Q&A
- how can i get xdebug to run with phpunit on the cli?

1. Set your xdebug.idekey in your php.ini to wathever you want (eg: blacktie)
2. restart your server
3. Call you script by adding -d xdebug.idekey=blacktie: `phpunit -d xdebug.profiler_enable=on -d xdebug.idekey=blacktie XYZTestCase.php`


# FirePHP

# ChromePHP(now as ChromeLogger)

# PHP_Debug