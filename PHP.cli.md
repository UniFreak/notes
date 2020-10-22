# Why use CLI
- no need to learn another language such as Perl, Bash or Awk
- running scheduled (CRON) tasks written in php
- making GUI applications with PHP and GTK
- reusage of your existing components
- write very robust scripts for your system by using PHP5 multithreading capabilities
- access system STDIN, STDOUT, STERR with PHP

# CLI VS CGI
- CLI writes no headers to the output by default
- There are some php.ini directives which are overridden by the CLI SAPI because they do not make sense in shell environments:
    + html_errors: CLI default is FALSE
    + implicit_flush: CLI default is TRUE
    + max_execution_time: CLI default is 0 (unlimited)
    + register_argc_argv: CLI default is TRUE
- You can have command line arguments with your script! Variable "$argc" provides you with a number of arguments passed to the application. And array "$argv" gives you an array of the actual arguments
- There are 3 new constant defined for the shell environment: STDIN, STDOUT, STDERR
- * PHP CLI does not change the current directory to the directory of the executed script. The current directory for the script would be the directory where your type PHP CLI command
- There are number of USEFUL options available for PHP CLI. Which will allow you to get some valuable information about you php setup, your php script or run it in different modes

# Option
Usage: php [options] [-f] <file> [--] [args...]
             php [options] -r <code> [--] [args...]
             php [options] [-B <begin_code>] -R <code> [-E <end_code>] [--] [args...]
             php [options] [-B <begin_code>] -F <file> [-E <end_code>] [--] [args...]
             php [options] -- [args...]
             php [options] -a

    -a               Run interactively
    -c <path>|<file> Look for php.ini file in this directory
    -n               No php.ini file will be used
    -d foo[=bar]     Define INI entry foo with value 'bar'
    -e               Generate extended information for debugger/profiler
    -f <file>        Parse <file>.
    -h               This help
    -i,--info        PHP information
    -l               Syntax check only (lint)
    -m               Show compiled in modules
    -r <code>        Run PHP <code> without using script tags <?..?>
    -B <begin_code>  Run PHP <begin_code> before processing input lines
    -R <code>        Run PHP <code> for every input line
    -F <file>        Parse and execute <file> for every input line
    -E <end_code>    Run PHP <end_code> after processing all input lines
    -H               Hide any passed arguments from external tools.
    -s               Display colour syntax highlighted source.
    -v               Version number
    -w               Display source with stripped comments and whitespace.
    -z <file>        Load Zend extension <file>.

    args...          Arguments passed to script. Use -- args when first argument
                                     starts with - or script is read from stdin

    --ini            Show configuration file names

    --rf <name> Show information about function <name>.
    --rc <name> Show information about class <name>.
    --re <name> Show information about extension <name>.
    --rz <name> Show information about Zend extension <name>.
    --ri <name> Show configuration for extension <name>.

Cli only:

    -b  --bindpath Bind Path for external FASTCGI Server mode
    -C  --no-chdir Do not chdir to the script's directory
    -q  --no-header Quiet-mode. Suppress HTTP header output
    -T  --timing Measure execution time of script repeated count times

# Usage

Run certain file:
- `php -f script.php -- args` or `php script.php args`
- `php -r 'echo "hi";'`
- use pipes: `some_app | php`

Retrive arguments via `$argv`. `$argv[0]` will always be script name
But if run with `-r`, it will be a dash `-`
`$argc` equals `$argv` length

Use the argument list separator `--` if you want to pass args start with `-`
You can use shebang and `chmod +x`, in this case you dont have
to worry about args start with `-`

# I/O Stream Constant

`STDIN`
`STDOUT`
`STDERR`

```php
$stdin = fopen('php://stdin', 'r');

$line = trim(fgets(STDIN)); // reads one line from STDIN
fscanf(STDIN, "%d\n", $number); // reads number from STDIN

$stdout = fopen('php://stdout', 'w');
$stderr = fopen('php://stderr', 'w');
```
