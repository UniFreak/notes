# Streams

Streams were introduced with PHP 4.3.0 as a way of generalizing file, network, data compression, and other operations which share a common set of functions and uses. In its simplest definition, a stream is a resource object which exhibits streamable behavior. That is, it can be read from or written to in a linear fashion, and may be able to fseek() to an arbitrary locations within the stream.

A stream is referenced as: scheme://target
◦ scheme(string) - The name of the wrapper to be used. Examples include: file, http, https, ftp, ftps, compress.zlib, compress.bz2, and php. See 支持的协议和封装协议 for a list of PHP built-in wrappers. If no wrapper is specified, the function default is used (typically file://).
◦ target - Depends on the wrapper used. For filesystem related streams this is typically a path and filename of the desired file. For network related streams this is typically a hostname, often with a path appended. Again, see 支持的协议和封装协议 for a description of targets for built-in streams.

# Streams Filters

A filter is a final piece of code which may perform operations on data as it is being read from or written to a stream. Any number of filters may be stacked onto a stream. Custom filters can be defined in a PHP script using stream_filter_register() or in an extension using the API Reference in 流的使用. To access the list of currently registered filters, use stream_get_filters()

To implement a filter, you need to define a class as an extension of php_user_filter with a number of member functions. When performing read/write operations on the stream to which your filter is attached, PHP will pass the data through your filter (and any other filters attached to that stream) so that the data may be modified as desired. You must implement the methods exactly as described in php_user_filter - doing otherwise will lead to undefined behaviour

```php
<?php
php_user_filter  {

public $filtername; // Name of the filter registered by stream_filter_append()
public $params;

/**
 * called whenever data is read from or written to the attached stream 
 * (such as with fread() or fwrite()).
 *
 * must return one of three values upon completion:
 * - PSFS_PASS_ON Filter processed successfully with data available in the out 
 *   bucket brigade
 * - PSFS_FEED_ME Filter processed successfully, however no data was available 
 *   to return. More data is required from the stream or prior filter
 * - PSFS_ERR_FATAL (default) The filter experienced an unrecoverable error 
 *   and cannot continue.
 */
public int filter ( 
    /**
     * a resource pointing to a bucket brigade which contains one or more
     * bucket objects containing data to be filtered
     */
    resource $in, 
    /**
     * a resource pointing to a second bucket brigade into which your modified 
     * buckets should be placed
     */
    resource $out, 
    /**
     * must always be declared by reference, should be incremented by the 
     * length of the data which your filter reads in and alters. In most cases 
     * this means you will increment consumed by $bucket->datalen for each 
     * $bucket
     */
    int &$consumed, 
    /**
     * If the stream is in the process of closing (and therefore this is the 
     * last pass through the filterchain), the closing parameter will be set 
     * to TRUE. 
     */
    bool $closing 
)
/**
 * called during instantiation of the filter class object. If your filter 
 * allocates or initializes any other resources (such as a buffer), this is 
 * the place to do it
 *
 * When your filter is first instantiated, and yourfilter->onCreate() is 
 * called, a number of properties will be available as shown in the table below
 * - FilterClass->filtername A string containing the name the filter was 
 *   instantiated with. Filters may be registered under multiple names or 
 *   under wildcards. Use this property to determine which name was used.  
 * - FilterClass->params The contents of the params parameter passed to 
 *   stream_filter_append() or stream_filter_prepend().
 * - FilterClass->stream The stream resource being filtered. Maybe available 
 *   only during filter() calls when the closing parameter is set to FALSE
 */
public bool onCreate ( void )
/**
 * called upon filter shutdown (typically, this is also during 
 * stream shutdown), and is executed after the flush method is called. If any 
 * resources were allocated or initialized during onCreate() this would be the 
 * time to destroy or dispose of them
 */
public void onClose ( void )
}
?>
```

__notes__:
- stream filters applied to STDOUT are not called when outputting via echo or print 

__related functions__:
- `array stream_get_filters ( void )`
- `bool stream_filter_register ( string $filtername , string $classname )`
- `resource stream_filter_append ( resource $stream , string $filtername [, int $read_write [, mixed $params ]] )`
- `resource stream_filter_prepend ( resource $stream , string $filtername [, int $read_write [, mixed $params ]] )`
- `bool stream_filter_remove ( resource $stream_filter )`

## buffer

Stream data is read from resources (both local and remote) in chunks, with any unconsumed data kept in internal buffers. When a new filter is appended to a stream, data in the internal buffers is processed through the new filter at that time; When a new filter is prepended to a stream, data in the internal buffers, which has already been processed through other filters will not be reprocessed through the new filter at that time

## bucket & bucket brigade

related links:
- http://stackoverflow.com/questions/27103269/what-is-a-bucket-brigade
- http://www.apachetutor.org/dev/brigades

# Stream Contexts

A context is a set of parameters and wrapper specific options which modify or enhance the behavior of a stream. Contexts are created using stream_context_create() and can be passed to most filesystem related stream creation functions (i.e. fopen(), file(), file_get_contents(), etc...). 

Options( An *option* is a protocol-specific setting, e.g. "method" (get, post, put...) if you are using HTTP or "callback function to be called when inserting a document" in MongoDB.
) can be specified when calling stream_context_create(), or later using stream_context_set_option(). A list of wrapper specific options can be found in the 上下文（Context）选项和参数 chapter. 

Parameters(A *parameter* is a settings that's common to all protocols. As of 2015 only one parameter got implemented ("notification")) can be specified for contexts using the stream_context_set_params() function. 

__related functions__
- `resource stream_context_create ([ array $options [, array $params ]] )`
- `bool stream_context_set_option ( resource $stream_or_context , string $wrapper , string $option , mixed $value )`
- `bool stream_context_set_option ( resource $stream_or_context , array $options )`
- `bool stream_context_set_params ( resource $stream_or_context , array $params )`
- `array stream_context_get_options ( resource $stream_or_context )`

__context options reference__
- socket: 
    - bindto
    - backlog
- http/https: 
    - method
    - header
    - user_agent
    - content
    - proxy
    - request_fulluri
    - follow_location
    - max_redirects
    - protocol_version
    - timeout
    - ignore_errors
- ftp:
    - overwrite
    - resume_pos
    - proxy
- ssl/tls:
    - peer_name
    - verify_peer
    - verify_peer_name
    - allow_self_signed
    - cafile
    - capath
    - local_cert
    - local_pk
    - passphrase
    - CN_match
    - verify_depth
    - ciphers
    - capture_peer_cert
    - capture_peer_cert_chain
    - SNI_enabled
    - SNI_server_name
    - disable_compression
    - peer_fingerprint
- curl:
    - method
    - header
    - user_agend
    - content
    - proxy
    - max_redirects
    - curl_verify_ssl_host
- phar:
    - compress
    - metadata
- mongoDB:
    - log_cmd_insert
    - log_cmd_delete
    - log_cmd_update
    - log_write_batch
    - log_reply
    - log_getmore
    - log_killcursor

__context parameters reference__
- notification

# Stream Wrappers

Every stream has a implementation wrapper which has the additional code that tells the stream how to handle specific protocols/encodings. For example, the http wrapper knows how to translate a URL into an HTTP/1.0 request for a file on a remote server. There are many wrappers built into PHP by default (See 支持的协议和封装协议), and additional, custom wrappers may be added either within a PHP script using stream_wrapper_register(), or directly from an extension using the API Reference in 流的使用. Because any variety of wrapper may be added to PHP, there is no set limit on what can be done with them. To access the list of currently registered wrappers, use stream_get_wrappers().

To implement your own protocol handlers and streams, you have to implement a class as below:

```php
<?php
/**
 * This is NOT a real class, only a prototype of how a class defining its own 
 * protocol should be
 */
streamWrapper  {

    /**
     * The current context, or NULL if no context was passed to the caller
     *  function. 
     * Use the stream_context_get_options() to parse the context. 
     */
    public resource $context;

    /**
     * Called when opening the stream wrapper, right before 
     * streamWrapper::stream_open(). 
     */
    __construct ( void )
    /**
     * Called when closing the stream wrapper, right before 
     * streamWrapper::stream_flush(). 
     */
    __destruct ( void )
    /**
     * Called in response to closedir(). 
     * Any resources which were locked, or allocated, during opening and use 
     * of the directory stream should be released. 
     */
    public bool dir_closedir ( void )
    /**
     * Called in response to opendir().
     */
    public bool dir_opendir ( string $path , int $options )
    /**
     * called in response to readdir(). 
     */
    public string dir_readdir ( void )
    /**
     * called in response to rewinddir(). 
     * Should reset the output generated by streamWrapper::dir_readdir(). 
     * i.e.: The next call to streamWrapper::dir_readdir() should return the 
     * first entry in the location returned by streamWrapper::dir_opendir(). 
     */
    public bool dir_rewinddir ( void )
    /**
     * called in response to mkdir()
     */
    public bool mkdir ( string $path , int $mode , int $options )
    /**
     * called in response to rename(). 
     * Should attempt to rename path_from to path_to 
     */
    public bool rename ( string $path_from , string $path_to )
    /**
     * called in response to rmdir(). 
     */
    public bool rmdir ( string $path , int $options )
    /**
     * called in response to stream_select(). 
     */
    public resource stream_cast ( int $cast_as )
    /**
     * called in response to fclose(). 
     * All resources that were locked, or allocated, by the wrapper should be 
     * released. 
     */
    public void stream_close ( void )
    /**
     *  called in response to feof(). 
     */
    public bool stream_eof ( void )
    /**
     * called in response to fflush() and when the stream is being closed 
     * while any unflushed data has been written to it before. 
     * If you have cached data in your stream but not yet stored it into the 
     * underlying storage, you should do so now. 
     */
    public bool stream_flush ( void )
    /**
     * called in response to flock(), when file_put_contents() (when flags 
     * contains LOCK_EX), stream_set_blocking() and when closing the stream 
     * (LOCK_UN). 
     */
    public bool stream_lock ( int $operation )
    /**
     * called to set metadata on the stream. It is called when one of the 
     * following functions is called on a stream URL: 
     * - touch()
     * - chmod()
     * - chown()
     * - chgrp()
     * Please note that some of these operations may not be available on your 
     * system. 
     */
    public bool stream_metadata ( string $path , int $option , mixed $value )
    /**
     * called immediately after the wrapper is initialized (f.e. by fopen() 
     * and file_get_contents()).
     */
    public bool stream_open ( 
        /**
         * the URL that was passed to the original function. 
         */
        string $path,
        /**
         * The mode used to open the file, as detailed for fopen().
         */
        string $mode, 
        /**
         * Holds additional flags set by the streams API. It can hold one or 
         * more of the following values OR'd together
         * - STREAM_USE_PATH 
         *   If path is relative, search for the resource using the 
         *   include_path.  
         * - STREAM_REPORT_ERRORS 
         *   If this flag is set, you are responsible for raising errors using 
         *   trigger_error() during opening of the stream. If this flag is not 
         *   set, you should not raise any errors.  
         */
        int $options, 
        /**
         * If the path is opened successfully, and STREAM_USE_PATH is set in 
         * options, opened_path should be set to the full path of the file/
         * resource that was actually opened. 
         */
        string &$opened_path 
    )
    /**
     * called in response to fread() and fgets(). 
     */
    public string stream_read ( int $count )
    /**
     * called in response to fseek(). 
     * The read/write position of the stream should be updated according to 
     * the offset and whence. 
     */
    public bool stream_seek ( int $offset , int $whence  = SEEK_SET )
    /**
     * called to set options on the stream. 
     */
    public bool stream_set_option ( int $option , int $arg1 , int $arg2 )
    /**
     * called in response to fstat(). 
     */
    public array stream_stat ( void )
    /**
     * called in response to fseek() to determine the current position. 
     */
    public int stream_tell ( void )
    /**
     * respond to truncation, e.g., through ftruncate(). 
     */
    public bool stream_truncate ( int $new_size )
    /**
     * called in response to fwrite(). 
     */
    public int stream_write ( string $data )
    /**
     * called in response to unlink(). 
     */
    public bool unlink ( string $path )
    /**
     * called in response to all stat() related functions, such as: 
     * - chmod() (only when safe_mode is enabled)
     * - copy()
     * - fileperms()
     * - fileinode()
     * - filesize()
     * - fileowner()
     * - filegroup()
     * - fileatime()
     * - filemtime()
     * - filectime()
     * - filetype()
     * - is_writable()
     * - is_readable()
     * - is_executable()
     * - is_file()
     * - is_dir()
     * - is_link()
     * - file_exists()
     * - lstat()
     * - stat()
     * - SplFileInfo::getPerms()
     * - SplFileInfo::getInode()
     * - SplFileInfo::getSize()
     * - SplFileInfo::getOwner()
     * - SplFileInfo::getGroup()
     * - SplFileInfo::getATime()
     * - SplFileInfo::getMTime()
     * - SplFileInfo::getCTime()
     * - SplFileInfo::getType()
     * - SplFileInfo::isWritable()
     * - SplFileInfo::isReadable()
     * - SplFileInfo::isExecutable()
     * - SplFileInfo::isFile()
     * - SplFileInfo::isDir()
     * - SplFileInfo::isLink()
     * - RecursiveDirectoryIterator::hasChildren()

     */
    public array url_stat ( string $path , int $flags )
}
?>
```

__related functions__
- `array stream_get_wrappers ( void )`
- `boolean stream_wrapper_register ( string $protocol , string $classname )`
- `bool stream_wrapper_unregister ( string $protocol )`
- `bool stream_wrapper_restore ( string $protocol )`

# Protocol


# reference
- PHP manual