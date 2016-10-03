#Installation

- keep versions up to date, and make sure all server(production, test, dev) on same version

    + PHP
    + web server
    + database
    + third-party code
    + and so on...

- don't user `phpinfo` and `phpMyAdmin` on production server, if you must, then

- turn off `register_global`(<4.2:defualt on; 4.2-5.4:default off; >5.4:removed)
    
    __why harmful__: consider this code

        if (checkPassword($username, $password)) {
            $loggedIn = true;
        }

        if ($loggedIn) {
            // display secret
        }

    if `register_global` is on, and hacker type in the bellow url:

        http://yoursite.com?loggedIn=true

    then hacker is logged in even without a password

- configure error reporting

    configure in `php.ini` file if possible, related configuration:

    - error_reporting
    - display_errors
    - log_errors
    - error_log

    during development:
    
        error_reporting = E_ALL
        display_errors = On

    at production server:

        error_reporting = E_ALL ^ (WHAT_YOU_DONT_NEED)
        display_errors = Off
        log_errors = On
        error_log = /private/path/to/errors.log

- turn off `magic quotes` feature(removed in PHP 5.4)

    To prevent php beginner from SQL injection, PHP will automatically escapes all quotation mark, backslash an NULL in GET/POST/COOKIE, if magic quotes is on. But this bring more problem than benefits:

    - code was not portable
    - created false security(dev server is on, publish server is off)
    - need to un-escape data that's not going to database
    - prevent beginner from learning important security concepts

    So, just turn it off:

        ; gpc means Get/Post/Cookie
        magic_quotes_gpc = Off 
        ; runtime are broader than gpc, data like from files, database...
        magic_quotes_runtime = Off

- turn off `safe mode`(removed in PHP 5.4)
- other configuration

        ; don't show PHP version in response header
        ; also remember turn off Apache's server signature
        expose_php = Off
        ; expriment and limit those as small as possible
        memory_limit = 8M
        post_max_size = 8M
        max_execution_time = 30
        max_input_time = 60
        ; if you don't need, then disable those powerful functions
        disable_functions = show_source, exec, shell_exec, system, passthru, proc_open, popen
        ; if you don't need, disable apache dynamic loading features
        enable_dl = Off
        ; if you don't need, turn off file upload. else consider those related
        ; configs
        file_upload = On
        max_file_uploads = 20
        upload_max_filesize = 2M
        open_basedir = /path/to/public/directory
        upload_tmp_dir = /path/to/tmp/directory
        ; if you don't need, turn those remote file configs off
        allow_url_fopen = Off
        allow_url_include = Off

#Filter inputs & control output

##Validating input

- Regulating request
    + only accept expected request methods
    + request should tell you, what they are sending in(`Content-Type` header), and what they expect to get back(`Accept` header)

- Validation: reject if not acceptable
    + Only allow expected data in submission
    + Set default values
    + Common validation
        * Presence/Length
        * Type
        * Format
        * Within a set of values
        * Uniqueness
    + Be aware of language logic pitfalls

##Sanitizing data:render data harmless

- Use type casting, not type juggling
- Don't use custom sanitization methods
- How to sanitize data depends on how you are going to use the data
    * SQL(database)
    * HTML
    * Javascript
    * JSON
    * XML
    * URL
    * ...
- Don't try to remove or correct invalid data, sanitize by
    * Encode data: replace powerful character with harmless equivalents
    * Escaping data: add escape characters before powerful characters
- Consider where the data will go, or might go later, sanitize early, sanitize late, sanitize often
- Use variables to track whether data is sanitized:
    * dirty, raw, tainted, unsafe
    * clean, filtered, sanitized, safe

| PHP Function | Use | `filter_var()` Filters |
|--------------|-----|--------|
|htmlspecialchars()|HTML-encode key characters|FILTER_SANITIZE_SPECIAL_CHARS|
|htmlentities()|HTML-encode everything|-|
|strip_tags()|Remove all HTML and PHP tags|FILTER_SANITIZE_STRING|
|urlencode()|URL-encode|FILTER_SANITIZE_ENCODE|
|json_encode()|JSON-encode(PHP 5.2)|-|
|mysqli_real_escape_string()|MySQL-escape|-|
|addslashes()|Escape key meta characters(primarily quotes)|FILTER_SANITIZE_MAGIC_QUOTES|

_*note_: filter_var and the old way functions are not replacement for each others. the old way functions may have feature that filter_var don't have.

##Privacy

- Code
    + Public directory/Libraries directory
    + end all file with `.php`, so even accidentally exposed, content are not displayed
    + keep an index.php file in every directory, to redirect to homepage or show 404
    + config `documentRoot`(apache) or `root`(nginx)
- Credentials
    + plain text password is dangerous, hash password whenever possible
    + keep them seperate from code
    + keep them out of version control
    + have as few copies as possible
    + don't reuse password

##Logging

- Smart logging
    + Types: 
        * Errors
        * Sensitive actions/Audit trail
        * Possible attacks
    + Fileds:
        * Date and times
        * Source(user/IP)
        * Action
        * Target
        * Cookie/Session; URL and all parameters(in raw format)
        * Backtrace
    + Don't log sensitive data: passwords, keys, tokens
    + Keep old content: versioning, Paranoid delete
    + Review log routinely
