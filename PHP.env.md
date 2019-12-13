# Install

## Compile from source

- When do `./configure...`: icon problem

see <https://stackoverflow.com/questions/24987305>

try add option `--with-iconv=/usr/local/Cellar/libiconv/1.15` or
try add option `--with-iconv=$(brew --prefix libiconv)`

- When run `php`: `dyld: Library not loaded`

try `brew upgrade`

- When do `make & make install`

1. open `MakeFile`
2. search for variable `EXTRA_LIBS`
3. replace `-liconv` with `/usr/local/opt/libiconv/lib/libiconv.dylib`

## Using Homebrew

- `configure: error: Cannot find libz`

try `xcode-select --instal`
or `xcode-select -p`
or try reinstall zlib: `brew reinstall zlib`. remember to do the `export` as prompted

- When run php: `dyld: Library not loaded: /usr/local/opt/openssl/lib/libssl.1.0.0.dylib`

reinstall openssl:
1. `brew uninstall openssl`
2. `brew install https://github.com/tebelorg/Tump/releases/download/v1.0.0/openssl.rb`

- When run php: `dyld: Library not loaded: /usr/local/opt/readline/lib/libreadline.7.dylib`

first try: `brew link readline --force`, if not working, try
1. `cd /usr/local/opt/readline/lib/`
2. `ln -s libreadline.dylib libreadline.7.dylib`


# Built-in Server
Use Built-in server only for local development

1. cd into project directory
2. run `php -S <servername>:<port> [-c <iniFile>] [<routerFile>]`
