# concepts
- package

    package can be served from
    + dist: a packaged version of the package data, stable, released
    + source: used for development

- repository

    a list of packages/versions. such as packagist repository

    online repository can be one of these type:
    + composer

        uses a single `packages.json` file that contains all of the package metadata
        packgist.org use this type

    + pear
    + package

    you can also host your own by using:
    + privage packagist
    + satis
    + artifact
    + or path

# Intallation

1. `curl -sS https://getcomposer.com/installer | php`
2. `php -r "readfile('https://getcomposer.org/installer');" | php`
3. _optional on cygwin_: see: http://www.pavlatka.cz/2015/01/install-composer-cygwin/

# 配置用中国镜像(防被墙)

- see <http://pkg.phpcomposer.com/>
- run

```sh
composer config -g repo.packagist composer https://packagist.phpcomposer.com
```

- run this to restore to offical

```sh
composer config -g --unset repos.packagist
```

# Version

## Stability

- available **stability flag** (`@beta` part in ``1.0.*@beta`) are: `dev`, `alpha`, `beta`, `RC` (means Release Candidates), `stable`
- corresponding vcs tag name maybe: `v1.1-dev`, `v1.1-alpha`, `v1.1-beta`, `v1.1-RC1`, `v1.1-stable`
- If you are using a constraint that does not explicitly define a stability, Composer will default internally to -dev or -stable, depending on the operator(s) used
- `minimum-stability` can be secified on per-package basis: `1.0.*@beta`

## Install strategy

- `--prefer-dist`: downloads the right files without actually cloning the repo
- `--prefer-source`: clones the repo into the correct place in your `vendor` directory

## Tag and branch

- `1.0.*@beta` will be solved as tags, and package downloaded as `--prefer-dist` style
- `dev-<branchName>` will be solved as branch, and package downloaded as `--prefer-source` style
- `v1.x-dev` mean to checkout a branch `v1` or branch `v1.x` instead of tag. `.x-dev` is arbitary

# composer.json

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

# CLI

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
    require <vendor>/<name>:<version>
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

# Config
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

# Autoloading

## ?
- psr 0 with \\ vs not with \\?
- psr 0 vs psr 4

# Tips
- you probably want to add vendor/ in your .gitignore. You really don't want to add all of that code to your repository.
- to remove tests/ folder when prefer-dist: use a .gitattributes config file
- use `https://github.com/clue/graph-composer` to show dependecy