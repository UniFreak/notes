#Intallation

1. `curl -sS https://getcomposer.com/installer | php`
2. `php -r "readfile('https://getcomposer.org/installer');" | php`
3. _optional on cygwin_: see: http://www.pavlatka.cz/2015/01/install-composer-cygwin/

#配置用中国镜像(防被墙)

http://pkg.phpcomposer.com/

#composer.json

json schema: https://github.com/composer/composer/blob/master/res/composer-schema.json
属性
    name
    description
    version
        use exact version: 1.0.2
        use range operator: > >= < <= !=
            seperate with space(AND)
            or || (OR)
            AND has higher precedence than OR
        use range(inclusive): 1.0 - 2.0
        use wildecard: 1.0.*
        use tilde operator: ~1.2 (>=1.2 <2.0.0)
        use caret: ^1.2.3 (>=1.2.3 <2.0.0)
        stability:
            1.2.3-stable
            1.2.3-dev
    type    library|project|metapackage|composer-plugin
    keywords
    homepage
    time
    license
    authors
        name
        email
        homepage
        role
    support
        email
        issues
        forum
        wiki
        irc
        source
    require
    require-dev(root-only)
    conflict
    replace
    provide
    suggest
    autoload
    autoload-dev(root-only)
    include-path
    target-dir
    minimun-stability(root-only)
    prefer-stable(root-only)
    repositories(root-only)
    config(root-only)
    scripts(root-only)
    extra
    bin
    archive
    non-feature-branches

#CLI

Global options(every command can use)
    --verbose (-v)
        -v
        -vv
        -vvv
    --help (-h)
    --quiet (-q)
    --no-interaction (-n)
    --working-dir (-d)
    --profile
    --ansi
    --no-ansi
    --version (-V)
Process exit code
    0: OK
    1: Generic/unknown error code
    2: Dependency solving error code
Commands
    init
        --name
        --description
        --author
        --homepage
        --require
        --require-dev
        --stability (-s)
    install
        --prefer-source
        --prefer-dist
        --ignore-platform-reqs
        --dry-run
        --dev
        --no-dev
        --no-autoloader
        --no-scripts
        --no-plugins
        --no-progress
        --optimize-autoloader (-o)
        --classmap-authoritative (-a)
    update
        --prefer-source
        --prefer-dist
        --ignore-platform-reqs
        --dry-run
        --dev
        --no-dev
        --no-autoloader
        --no-scripts
        --no-plugins
        --no-progress
        --optimize-autoloader (-o)
        --classmap-authoritative (-a)
        --lock
        --with-dependencies
        --prefer-stable
        --prefer-lowest
    require
        --prefer-source
        --prefer-dist
        --ignore-platform-reqs
        --dev
        --no-update
        --no-progress
        --update-no-dev
        --update-with-dependencies
        --sort-packages
        --optimize-autoloader (-o)
        --classmap-authoritative (-a)
    remove
        --ignore-platform-reqs
        --dev
        --no-update
        --no-progress
        --update-no-dev
        --update-with-dependencies
        --optimize-autoloader (-o)
        --classmap-authoritative (-a)
    global
    search
        --only-name (-N)
    show
        --installed (-i)
        --platform (-p)
        --self (-s)
        --tree (-t)
    browse/home
        --homepage (-H)
    suggests
        --no-dev
        --verbose (-v)
    depends
        --link-type
        --match-constraint (-m)
        --invert-match-constraint (-i)
        --with-replaces
    validate
        --no-check-all
        --no-check-lock
        --no-check-publish
    status
        --verbose
    self-update
        --rollback (-r)
        --clean-backups
    config [options] [setting-key] [setting-value1]...[setting-valueN]
        --global (-g)
        --editor (-e)
        --unset
        --list (-l)
        --file="..." (-f)
        --absolute
    create-project
        --repository-url
        --stability (-s)
        --prefer-source
        --prefer-dist
        --dev
        --no-install
        --no-plugins
        --no-scripts
        --no-progress
        --keep-vcs
        --ignore-platform-reqs
    dump-autoload
        --optimize (-o)
        --classmap-authoritative (-a)
        --no-dev
    clear-cache
    licenses
        --no-dev
        --format
    run-script
        --no-dev
        --format
    diagnose
    archive
        --format (-f)
        --dir
    help
Enviroment variables
    COMPOSER
    COMPOSER_ROOT_VERSION
    COMPOSER_VENDOR_DIR
    COMPOSER_BIN_DIR
    HTTP_PROXY
    no_proxy
    HTTP_PROXY_REQUEST_FULLURI
    HTTPS_PROXY_REQUEST_FULLURI
    COMPOSER_HOME
    COMPOSER_HOME/config.json
    COMPOSER_CACHE_DIR
    COMPOSER_PROCESS_TIMEOUT
    COMPOSER_DISCARD_CHANGES
    COMPOSER_NO_INTERACTION

==================== Config ====================
process-timeout
use-include-path
preferred-install
store-auths
github-protocols
github-oauth
gitlab-oauth
disable-tls
cafile
capath
http-basic
platform
vendor-dir
bin-dir
data-dir
cache-dir
cache-files-dir
cache-repo-dir
cache-vcs-dir
cache-files-ttl
cache-files-maxsize
bin-compat
prepend-autoloader
autoloader-suffix
optimize-autoloader
sort-packages
classmap-authoritative
github-domains
github-expose-hostname
gitlab-domains
notify-on-install
discard-changes
archive-format
archive-dir

==================== Tips ====================
you probably want to add vendor/ in your .gitignore. You really don't want to add all of that code to your repository.