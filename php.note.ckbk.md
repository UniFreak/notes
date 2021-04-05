# Strings

## PHP string are binary-safe

# Constants

M_E     e
NAN     Not A Number
INF     Infinite
## M_PI    Pi

# Funcs

## MIST

    constant
    define defined
    eval
    exit sleep usleep
    get_brawser
    pack unpack
    uniqid

## STRING

    (add/strip)[c]slashes
    bin2hex hex2bin
    chr ord
    [l/r]trim substr
    implode explode str_split chunk_split
    get_html_translation_table
    html(entities/specialchars/entity_decode)
    nl2br striptags
    crc32 crypt str_rot13 md5[_file] sha1[_file]
    (l/u)cfirst ucwords strto(upper/lower)
    str[n][case]cmp strnat[case]cmp substr_compare
    str_(replace/ireplace) substr_replace strtr
    count_chars str_word_count substr_count strlen
    strtok
    str[i]str str[r][i]pos strrchr
    strpad str_repeat
    strrev str_shuffle wordwrap
    str_getcsv parse_str sscanf
    (number/money)_format
    echo print
    [v][s/f]printf

## MATH

    [a](cos/sin/tan/tan2h)
    abs max min pi
    bas_convert dec(bin/hex/oct) (bin/hex/oct)dec deg2rad rad2deg
    exp[m1] pow sqrt log[1p/10]
    f(idv/mod) intdiv
    floor ceil round
    [mt_](getrandmax/rant/srand)
    is_(finite/infinite/nan)
    lcg_value hypot

## BC MATH: bc*

    add sub mul div pow powmod sqrt comp

## DATE/TIME

    checkdate
    date_default_timezone_(get/set)
         parse_from_format
         parse
    date idate
    get(date/timeofday)
    [mk/local/micro]time
    str(f/p/to)time
    gm(date/mktime/strftime)

    DateTime::
    ----------
    createFrom(Format/Immutable/Interface)
    set(Date/ISODate/Time/Timestamp/Timezone)
    get(Timestamp/Timezone)
    add sub modify diff
    format

    DateTimeZone::
    --------------
    get(Location/Name/Offset/Transitions)
    list(Abbreviations/Identifiers)

    DateInterval::
    --------------
    createFromDateString
    format

    DatePeriod::
    -----------
    get(DateInterval/EndDate/Recurrences/StartDate)

## ARRAY

    SORT_(NUMERIC/REGULAR/STRING/ASC/DESC)

    array_*                                              *
    ----------------------------------------------------------------------------
    combin fill_keys pad                             |   array range
    keys values                                      |
    chunk column slice unique                        |   compact
    change_key_case flip                reverse      |   shuffle
    splice filter map                   multisort    |   [a/k][r]sort u[a/k]sort
    (walk/replace/merge)[_recursive]                 |   nat[case]sort
    (diff/intersect)_[[u](key/assoc)]                |
    (udiff/uintersect)_[[u]assoc]                    |
    key_(first/last) rand search        pop push     |   key_exists in_array
    count_values reduce sum product     shift unshift|   count list extract
                                                     |   each current key reset
                                                     |   end prev next

## VARIABLE

    (bool/double/float/int/str)val
    get_(defined_vars/resource_(id/type))
    (get/set)type
    is_(array/bool/callable/countable/double/float/int/integer/null/real/resource/scalar/string)
    empty/isset/unset
    print_r/var_dump/var_export
    [un]serialize
    debug_zval_dump

## APCu: apcu_*

    enabled
    add delete cas inc dec
    exists store fetch
    entry clear_cache
    (key/sma/cache)_info

## SHMOP: shmop_*

    open close read write delete size

## SEMAPHORE

    *       msg_*                           sem_*       shm_*
    --------------------------------------------------------------
    ftok    (get/set/stat/remove)_queue     acquire     attach detach
            queue_exists                    get         (has/get/put/remove)_var
            receive send                    release     remove
                                            remove

## CTYPE

    alnum alpha cntrl digit graph lower upper print punct space xdigit

## FUNCTIONS

    call_user_func[_array]
    forward_static_call[_array]
    func_get_(arg/args)
    func_num_args
    function_exists
    get_defined_functions
    register_(shutdown/tick)_function
    unregister_tick_function

## CLASS & OBJECTS

    __CLASS__

    (class/interface/method/property/trait)_exists
    class_alias
    get_declared_(classes/interfaces/traits)
    get_class[_vars/methods]
    get_parent_class get_object_vars
    is_a is_subclass_of

## OUTPUT BUFFER

    ob_start
    ob_list_handlers ob_gzhandlers
    output_(add/reset)_rewrite_var
    ob_get_(status/level/length/contents/flush/clean)
    ob_end_(flush/clean)
    flush

## FITLER: filter_*

    SANITIZE_(EMAIL/URL/ENCODED/STRIPPED/MAGIC_QUOTES/
             NUMBER_(FLOAT/INT/STRING)
             FULL_SPECIAL_CHARS)
    VALIDATE_(BOOLEAN/FLOAT/INT/DOMAIN/EMAIL/ID/MAC/URL)
    CALLBACK

    list id
    has_var
    var var_array
    input input_array

## DATABASE

    PDO::                                   PDOStatement::
    -----                                   --------------
    quote query                             bind(Column/Param/Value)
    prepare exec                            execute
    begin inTransaction commit rollback     setFetchMode
    lastInsertId                            fetch fetch(All/Column/Object)
                                            (column/row)Count
                                            getColumnMeta
                                            debugDumpParams
                                    setAttribute
                                    error(Code/Info)
    PDO::FETCH_*
    -------------------------------
    BOTH NUM ASSOC OBJ LAZY INTO CLASS BOUND

    DBA: dba_*
    ----------
    open popen close
    list handlers
    exists fetch firstkey insert delete
    optimize sync

## SESSION

    register_shutdown
    set_save_handler
    (set/get)_cookie_params
    id name module_name save_path cache_expire cache_limiter
    start status unset reset abort destroy gc encode decode commit write_close

    configs: session.*
    -----------------
    save_(path/handler)
    name auto_start lazy_write
    gc_(probability/divisor/maxlifetime)
    serialize_handlers
    cookie_(lifetime/path/domain/secure/httponly/samesite)
    use_(strict_mode/cookies/only_cookies/trans_sid)
    refrer_check
    cache_(limiter/expire)
    trans_sid_(tags/hosts) sid_length sid_bit_per_character
    upload_progress.(enabled/cleanup/prefix/name/freq/min_freq)

    SessionHandler::
    ----------------
    create_sid
    open read write close
    destroy gc

## URL

    (base64/rawurl/url)_(encode/decode)
    get_(header/meta_tags)
    http_build_query
    parse_url

cURL: curl_*

    version
    init copy_handle file_create
    setopt setopt_array reset
    exec pause close
    [un]escape
    error errno getinfo
    multi_(init/setopt/exec/close/add_handle/remove_handle/
           select/getcontent/errno/strerror/info_read)
    share_(init/setopt/close/errno/strerror)

## JSON: json_*

    decode encode
    last_error last_error_msg

## NETWORK

    (open/close/sys)log
    define_syslog_variables
    checkdnsrr
    dns_((check/get)_record/get_mx)
    [p]fsockopen
    socket_(get_status/set_blocking/set_timeout)
    gethostby(addr/name/namel)
    get(hostname/mxrr)
    getprotoby(name/number)
    getservby(name/port)
    header[_remove/registercallback]
    headers_(list/sent)
    http_response_code
    inet_ntop/pton
    ip2long long2ip
    set[raw]cookie

## PASSWORD HASHING: password_*

    alog get_info hash need_rehash verify

## GnuPG: gnupg_*

    add(decrypt/encrypt/sign)key
    clear(decrypt/encrypt/sign)keys
    encrypt decrypt
    encryptsign decryptverify
    import export
    keyinfo
    init sign verify
    get(error/protocol)
    set(armor/errormode/signmode)

## ICONV: iconv_*

    (get/set)_encoding
    mime_(encode/decode)
    mime_decode_headers
    str(len/pos/rpos)
    substr
    iconv
    ob_iconv_handler

## ERORR

    debug_[print_]backtrace
    error_(log/reporting/clear/get_last)
    (restore/set)_(error/exception_handlers)
    trigger_error

## PHP OPTTION & INFO

    assert
    extension_loaded
    get_(cfg_var/defined_constants/current_use/include_path/loaded_extension/required_files)
    (get/set)env
    ini_(get/set/restore/get_all)
    memory_get_[peak_]usage
    php_ini_(loaded/scanned)_files
    php_sapi_name
    php(info/version)
    set_(include_path/time_limit)
    version_compare

## REGEX: preg_*

    constants: PREG_*
    -----------------
    SPLIT_(NO_EMPTY/DELIM_CAPTURE/OFFSET_CAPTURE)
    UNMATCHED_AS_NULL
    (SET/PATTERN)_ORDER

    filter
    grep
    split
    quote
    match[_all]
    replace[_callback[_array]]
    last_error[_msg]

## PROGRAME EXEC

    escapeshell(arg/cmd)
    exec passthru shell_exec system
    proc_(close/get_status/nice/open/terminate)

## FILE SYSTEM

    basename
    ch(grp/mod/own) lch(grp/own) umask
    clearstatcache
    [f/l]stat link[info] pathinfo
    copy rename delete unlink rmdir
    dirname fnmatch glob
    disk_(free/total)_space
    f(open/lock/seek/tell/eof/close/rewind)
    f(write/puts/putcsv/read/scnf/truncate)
    fget(c/csv/s/ss)
    p(open/close)
    read(file/link)
    realpath[_cache_(get/size)]
    is_(dir/executable/file/link/readable/uploaded_file/writable)
    move_uploaded_file
    parse_ini_(file/string)
    symlink link tempnam tmpfile touch
    set_file_buffter
    file file_exists
    file_(get/put)_contents
    file(atime/ctime/mtime)
    file(group/incode/owner/perms)
    file(size/type)

## DIRECTORY

    ch(dir/root/)
    [close/open/read/rewind/scan]dir
    getcwd

## CLI: readline_*

    ()
    (add/list/read/write/clear)_history
    callback_handlers_(install/remove)
    callback_read_char
    completion_function
    info
    on_new_line
    redisplay