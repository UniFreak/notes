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

first try switch openssl version:

1. see what versions are installed ``ls -al /usr/local/Cellar/openssl*`
2. `brew switch openssl <version>` php56->1.0.*

or try reinstall openssl:
1. `brew uninstall openssl`
2. for php56, use openssl 1.0.*:`brew install https://github.com/tebelorg/Tump/releases/download/v1.0.0/openssl.rb`

- When run php: `dyld: Library not loaded: /usr/local/opt/readline/lib/libreadline.7.dylib`

first try: `brew link readline --force`, if not working, try
1. `cd /usr/local/opt/readline/lib/`
2. `ln -s libreadline.dylib libreadline.7.dylib`

- Multiple version switcher:

```sh
alias sphp72="brew unlink php56 && brew unlink php71 && brew link --force php72"
alias sphp56="brew unlink php71 && brew unlink php72 && brew link php56"
```

# Built-in Server
Use Built-in server only for local development

1. cd into project directory
2. run `php -S <servername>:<port> [-c <iniFile>] [<routerFile>]`
