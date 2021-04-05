# See
- <https://xdebug.org/docs>

# Install

`pecl install xdebug`

# Config

`zend_extension=path/to/xdebug.so`



# setup
- using docker-php: see: macUp.md
- run phpunit locally in command line:
    1. make sure local php's xdebug conf file(use `php -ini` to find out the file location) have those setting:

    ```ini
    [xdebug]
    zend_extension="/usr/local/opt/php56-xdebug/xdebug.so"
    xdebug.remote_enable=1
    ```

    2. comment out path_mapping in sublime text xdebug preference
    3. do `export XDEBUG_CONFIG` as showed in <https://tighten.co/blog/configure-vscode-to-debug-phpunit-tests-with-xdebug>

