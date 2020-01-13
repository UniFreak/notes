# See
- <http://mywiki.wooledge.org/BashGuide>
- <https://wiki.bash-hackers.org/>

# Concepts

BASH: Bourne Again Shell

Bash is written in C

merely a layer between system function calls and the user

Almost everything is a string: We need to be sure everything that needs to be separated is separated properly, and everything that needs to stay together stays together properly

Types of commands:
- alias: a word mapped to string, only useful as simple textual shortcuts
- functions: a name mapped to a set of commands, more powerful alias
- builtins: functions already provided, like `[]`
- keywords: like builtin, but with special parsing rule apply to them, like `[[ ]]`
- executable/external/application

String VS Stream:
- stream is read sequentially (you usually can't jump around)
- stream is unidirectional (you can read from them, or write to them, but typically not both)
- stream can contain NUL bytes

Shell 脚本的关键在于输入多个命令并处理每个命令的结果, 用 `;` 可将多个命令分开

# Get Help

be familiar with
- `man`
- `aprops` = `man -k`
- `whatis` = `man -f`
- `help`
- `type`: `type -a bash` print all bash executable in PATH

to find out built-in commands: `man bash`

# Basic

Command pattern: `command options... -- arguments...`

Options traditionally end with `--` (optinal): `tar -x -f archive.tar -v -- file1 file2 file3`
- standalone, presente or not: `-x`
- with arguments: `-f archive.tar`

Print message with `echo msg`, print without linebreak with `echo -n msg`

Comment begin with `#`: `echo "hi" # this is comment`

Arguments are seperated by whitespace

The amount of whitespace between arguments does not matter

Quotes (`"` or `'`) group everything inside them into a single argument

You should be very well aware of how expansion works see [Expansion](#scripts)



# Script

Typical interpreter directive / shebang / hashbang (see <https://unix.stackexchange.com/a/29620>)
- `#!/bin/bash`
- `#!/usr/bin/env bash`

Typical header:

```bash
#!/usr/bin/env bash
# scriptname - a short explanation of the scripts purpose.
#
# Copyright (C) <date> <name>...
#
# scriptname [option] [argument] ...
```

run:
- `bash myscript`
- or: `chmod +x myscript` and `./myscript`

to use a directory to hold your scripts:
1. mkdir: `$ mkdir -p "$HOME/bin"`
2. modify PATH: `$ echo 'PATH="$HOME/bin:$PATH"' >> "$HOME/.bashrc"`
3. source: `$ source "$HOME/.bashrc"`

# Handle Options/Arguments

see <http://mywiki.wooledge.org/BashFAQ/035>

Manually, best:

```bash
#!/bin/sh
# POSIX

die() {
    printf '%s\n' "$1" >&2
    exit 1
}

# Initialize all the option variables.
# This ensures we are not contaminated by variables from the environment.
file=
verbose=0

while :; do
    case $1 in
        -h|-\?|--help)
            show_help    # Display a usage synopsis.
            exit
            ;;
        -f|--file)       # Takes an option argument; ensure it has been specified.
            if [ "$2" ]; then
                file=$2
                shift
            else
                die 'ERROR: "--file" requires a non-empty option argument.'
            fi
            ;;
        --file=?*)
            file=${1#*=} # Delete everything up to "=" and assign the remainder.
            ;;
        --file=)         # Handle the case of an empty --file=
            die 'ERROR: "--file" requires a non-empty option argument.'
            ;;
        -v|--verbose)
            verbose=$((verbose + 1))  # Each -v adds 1 to verbosity.
            ;;
        --)              # End of all options.
            shift
            break
            ;;
        -?*)
            printf 'WARN: Unknown option (ignored): %s\n' "$1" >&2
            ;;
        *)               # Default case: No more options, so break out of the loop.
            break
    esac

    shift
done

# if --file was provided, open it for writing, else duplicate stdout
if [ "$file" ]; then
    exec 3> "$file"
else
    exec 3>&1
fi

# Rest of the program here.
# If there are input files (for example) that follow the options, they
# will remain in the "$@" positional parameters.

# NOTE:
# does not handle single-letter options concatenated together (like -xvf)
# Fancy option processing is only desirable if you are releasing the program for general use
```

getopts: only use it if you need concatenated options

# Special Chars

`$`: expansion
- parameter: `${var}` or `$var`
- command substitution: `$(command)`
- arithmetic: `$((expression))`

quotes:
- `' '`: no expansion, ignore escape `\`
- `" "`: with expansion

...

# Parameters

Two flavour:
- variables: user defined
- special parameters: read-only, preset by BASH

## Varialbes:

assign: `identifier=data`
- no space around `=`
- identifier can begin with letter/underscore, can contain letter/digit/underscore

## Special Parameters:

- `$0`: script name/path
- `$1`, `$2`, `${10}` etc: positional parameter, contain passed-in arguments
- `$*`: string of all positional parameter
- `$@`: list of all positional parameter
- `$#`: number of positional parameter
- `$?`: exit code of most recently completed foreground command
- `$$`: PID of current shell
- `$!`: PID of most recently executed background command
- `$_`: last argument of last command

## Types

- integer: `declare -i var`, rarely used, better use arithmetic command `(( ))` or `let`
- indexed array: `declare -a var`, rarely used, better use `array()`
- associative array: `declare -A var`
- read only: `declare -r var`
- export: `declare -x var`, will be inherited by any child process

## Concatenate

- `var=$var1$var2`: command
- `var="$var1 - $var2"`: with whitespace
- `var=${var1}xyzzy` or `var="$var1"xyzzy`: diambiguate with `{}` or `""`
- `logname="log.$(date +%Y-%m-%d)"`: command substitute
- `string="$string more data here"`: reassign
- `var=( "${arr1[@]}" "${arr2[@]}" )`: array

## Parameter Expansion (PE)

`${parameter:-word}`:

Use Default Value. If 'parameter' is unset or null, 'word' (which may be an expansion) is substituted. Otherwise, the value of 'parameter' is substituted.

`${parameter:=word}`:

Assign Default Value. If 'parameter' is unset or null, 'word' (which may be an expansion) is assigned to 'parameter'. The value of 'parameter' is then substituted.

`${parameter:+word}`:

Use Alternate Value. If 'parameter' is null or unset, nothing is substituted, otherwise 'word' (which may be an expansion) is substituted.

`${parameter:offset:length}`:

Substring Expansion. Expands to up to 'length' characters of 'parameter' starting at the character specified by 'offset' (0-indexed). If ':length' is omitted, go all the way to the end. If 'offset' is negative (use parentheses!), count backward from the end of 'parameter' instead of forward from the beginning. If 'parameter' is @ or an indexed array name subscripted by @ or *, the result is 'length' positional parameters or members of the array, respectively, starting from 'offset'.

`${#parameter}`:

The length in characters of the value of 'parameter' is substituted. If 'parameter' is an array name subscripted by @ or *, return the number of elements.

`${parameter#pattern}`:

The 'pattern' is matched against the beginning of 'parameter'. The result is the expanded value of 'parameter' with the shortest match deleted.
If 'parameter' is an array name subscripted by @ or *, this will be done on each element. Same for all following items.

`${parameter##pattern}`:

As above, but the longest match is deleted.

`${parameter%pattern}`:

The 'pattern' is matched against the end of 'parameter'. The result is the expanded value of 'parameter' with the shortest match deleted.

`${parameter%%pattern}`:

As above, but the longest match is deleted.

`${parameter/pat/string}`:

Results in the expanded value of 'parameter' with the first (unanchored) match of 'pat' replaced by 'string'. Assume null string when the '/string' part is absent.

`${parameter//pat/string}`:

As above, but every match of 'pat' is replaced.

`${parameter/#pat/string}`:

As above, but matched against the beginning. Useful for adding a common prefix with a null pattern: "${array[@]/#/prefix}".

`${parameter/%pat/string}`:

As above, but matched against the end. Useful for adding a common suffix with a null pattern.

# Pattern

Is a string with a special format designed to match filenames, or to check, classify or validate data strings

Three type:
- glob
- extended glob
- regular expression

Glob or extended glob can be used to do filename expansions:

Bash sees the glob, for example a*. It expands this glob, by looking in the current directory and matching it against all files there. Any filenames that match the glob are gathered up and sorted, and then the list of filenames is used in place of the glob

All of them can do pattern matching in `[[ ]]` or `case`

## Glob

Anchored at both ends

Metachars:
- `*`: Matches any string, including the null string.
- `?`: Matches any single character.
- `[...]`: Matches any one of the enclosed characters.

## Extended Glob

turn on by `shopt -s extglob`

Metachars:
- `?(list)`: Matches zero or one occurrence of the given patterns
- `*(list)`: Matches zero or more occurrences of the given patterns
- `+(list)`: Matches one or more occurrences of the given patterns
- `@(list)`: Matches one of the given patterns
- `!(list)`: Matches anything but the given patterns

The list inside the parentheses is a list of globs or extended globs separated by the `|` character

## Regular Expression

Bash use `ERE` (Extended Regular Expression) dialect

Captured stringa captured by capture groups are assigned to `BASH_REMATCH` array

Syntax: `$var =~ $pattern`

see <Regex.md>

# Brace Expansion

Not sorted

- list: `{a,e}`
- range: `{0..9}`, `{b..Y}`

# Test And Conditional

## Exit Code

`exit` command, Range from 0~255, typically 0 indicate success

## Control Operator

only for simple cases:
- <if success> `&&` <then do this>
- <if failed> `||` <then do this>

## Grouping Statement

`{ }`, you need a semicolon or newline before the closing curly brace.

grouping conditional operator:

```sh
cd "$appdir" || { echo "Please create the appdir and try again" >&2; exit 1; }
```

or redirect to group of statements:

```sh
{
    read firstLine
    read secondLine
    while read otherLine; do
        something
    done
} < file
```

## Conditional Blocks

`true`|`false` **is command** that always exit success|fail

### Choices

if:

```sh
if COMMANDS; then
    OTHER COMMANDS
elif COMMANDS; then
    OTHER COMMANDS
else
    OTHER COMMANDS
fi
```

case:

```sh
case $LANG in
    en*) echo 'Hello!' ;;
    fr*) echo 'Salut!' ;;
    de*) echo 'Guten Tag!' ;;
    nl*) echo 'Hallo!' ;;
    it*) echo 'Ciao!' ;;
    es*) echo 'Hola!' ;;
    C|POSIX) echo 'hello world' ;;
    *)   echo 'I do not speak your language.' ;;
esac
```

select:

```sh
echo "Which of these does not belong in the group?"; \
select choice in Apples Pears Crisps Lemons Kiwis; do
if [[ $choice = Crisps ]]
then echo "Correct!  Crisps are not fruit."; break; fi
echo "Errr... no.  Try again."
done
```

### `test`/`[`/`[[`

`[` **is a command** alias to `test`, that receive four arguments, so `[ "$a" = "$b" ]` means run `[` with argument `$a`, `=`, `$b` and required `]`

`[[` is **a shell keyword**, it parse its arguments before bash expand them

when not quoting right-hand side, `[[` do pattern matching

```sh
$ foo=[a-z]* name=lhunath
$ [[ $name = $foo   ]] && echo "Name $name matches pattern $foo"
Name lhunath matches pattern [a-z]*
$ [[ $name = "$foo" ]] || echo "Name $name is not equal to the string $foo"
Name lhunath is not equal to the string [a-z]*
```

all supported operators:

- `=`, `!=`: string comparision
- `-eq`, `-ne`, `-lt`, `-gt`, `-le`, `-ge`: number comparision
- `-z`, `-n`: empty test
- `! EXPR`: logical NOT
- files:
    + `-e FILE`: True if file exists
    + `-f FILE`: True if file is a regular file
    + `-d FILE`: True if file is a directory
    + `-h FILE`: True if file is a symbolic link
    + `-p PIPE`: True if pipe exists
    + `-r FILE`: True if file is readable by you
    + `-s FILE`: True if file exists and is not empty
    + `-t FD` : True if FD is opened on a terminal.
    + `-w FILE`: True if the file is writable by you.
    + `-x FILE`: True if the file is executable by you.
    + `-O FILE`: True if the file is effectively owned by you.
    + `-G FILE`: True if the file is effectively owned by your group.
    + `FILE -nt FILE`: True if the first file is newer than the second.
    + `FILE -ot FILE`: True if the first file is older than the second.

`[` only operators:

- `\(`, `\)`: expression group
- `\<`, `\>`: string lesser, greater
- `-a`, `-o`: logical AND, OR

`[[` only operators:

- `()`: expression group
- `<`, `>`: string lesser, greater
- `&&`, `||`: logical AND, OR
- `= PATTERN`, `== PATTERN`, `!= PATTERN`, `=~ REGEX`: pattern matching
- `FILE -ef FILE`: files are the same

## Conditional Loop

while:

```sh
while COMMAND; do
    OTHER COMMAND
done
```

until (in practice, most people simply use `while !`)

```sh
until COMMAND; do
    OTHER COMMAND
done
```

for:

```sh
for (( INIT; EVALUATE; STEP )); do
    OTHER COMMAND
done
```

for-in:

```sh
for ITEM in WORDS; do
    OTHER COMMAND
done
```
NOTE: a simple `for ITEM` is equivalent to `for ITEM in "$[@]"`

`continue` or `break` can be used in all of them

# Array

Zero-based index

It's important to keep our data safely contained in the array as long as possible

Associative array since after Bash 4

Create:

- `a=(word1 word2 "$word3" ...)`: from a word list
- `a=(*.png *.jpg)`: with glob
- `a=([0]="Bob" [1]="Peter" [20]="$USER" [21]="Big Bad John")`: sparsed
- from command output: `NUL` byte is very often the best choice for delimiter, like below

```sh
files=()
while read -r -d ''; do
    files+=("$REPLY")
done < <(find /foo -print0)
```

Use:

- `declare -p a`: Show/dump the array, in a bash-reusable form
- `"${a[i]}"`: Reference one element
- `"$(( a[i] + 5 ))"`: Reference one element, in a math context
- `a[i+1]=word`: Set one element, note the index is in a math context
- `a[i]+=suffix`: Append suffix to one element
- `a+=(word ...)` | `a+=([3]=word3 word4 [i]+=word_i_suffix)`: Append more elements
- `unset 'a[i]'`: Unset one element. Note we use quotes to avoid `a[i]` intepreted as glob
- `"${#a[@]}"`: Number of elements (size, length)

Expand:

- `"${a[@]}"`: Expand all elements as a list of words
- `"${!a[@]}"`: Expand all indices as a list of words (bash 3.0)
- `"${a[*]}"`: Expand all elements as a single word, with the first char of IFS as separator
- `"${a[@]:start:len}"`: Expand a range of elements as a list of words, cf. string range
- `"${a[@]#trimstart}" "${a[@]%trimend}"` | `"${a[@]//search/repl}"`: Expand all elements as a list of words, with modifications applied to each element separately.

# Input And Output

input can come from:
- Command-line arguments (which are placed in the positional parameters)
- Environment variables, inherited from whatever process started the script
- Files
- Anything else a File Descriptor can point to (pipes, terminals, sockets, etc.)

output can go to:
- Files
- Anything else a File Descriptor can point to
- Command-line arguments to some other program
- Environment variables passed to some other program

## Command-line Arguments

see <#Special Parameters>

## Enviroment

Can be set
- in user dot files: affect every program
- on the fly: affect only current typed commmand: `$ LANG=C ls /tpm`
- export: affect only child process: `export ENV=val`

## File Descriptors(FDs)

are the way programs refer to files, or to other resources that work like files (such as pipes, devices, sockets, or terminals). FDs are kind of like pointers to sources of data, or places data can be written. When something reads from or writes to that FD, the data is read from or written to that FD's resource

By default, every new process starts with three open FDs:
- Standard Input (`stdin`): File Descriptor 0
- Standard Output (`stdout`): File Descriptor 1
- Standard Error (`stderr`): File Descriptor 2

## Redirection

The practice of changing a FD to read its input from, or send its output to, a different location

Redirection apply only to one command/**loop**, and occurs before the command/loop is executed

Syntax:
- change target FD location: `>` or `<` preceded by FD number(default to `stdout` or `stdin`)
- appending: `>>` or `<<`
- duplicate target FD: `&` followed by FD number
- space between redirection operator and file is optional, means `2>error` is okay

Examples:
- `>` | `1>`: changes the `stdout` FD destination
- `<` | `0<`: changes the `stdin` FD destination
- `2> error`: change the `stderr` FD destination to file `error`
- `2> /dev/null`: change the `stderr` FD destination to file `/dev/null` -> silent error
- `> logfile 2>&1`: change `stdout` to logfile, then duplicate `stdout` and put it in `stderr`
- `&> logfile`: same as above, redirecting both stdout and stderr to logfile, **not portable**

## Heredocs And Herestrings

Heredocs and Herestrings are themselves redirects just like any other, so additional redirections can occur on the same line

**Heredoc**

basic: with indentation, and Bash substitution

```sh
level=1
cat <<END # sentinel
    indented by "${level}"
END
#   indented by "1"
```

use `-END` to auto-remove `tab` (but **not space**)

use `'END'` to avoid Bash substitution

use `-'END'` to do both

**Herestring**

Less portable, with Bash institution

```sh
grep proud <<<"$USER sits proudly on his throne in $HOSTNAME."
```

## Pipes

`|`: Connects the stdout of one process to the stdin of another

`FIFOs` aka `named pipes` accomplish the same but through a filename

The pipe operator creates a subshell environment for each command. This is important to know because any variables that you modify or initialize inside the second command will appear unmodified outside of it

## Process Substitution

Convenient way to use named pipes without having to create temporary files. Whenever you think you need a temporary file to do something, process substitution might be a better way to handle things

`<()`: put command output in a named pipe

```sh
$ diff -y <(head -n 1 .dictionary) <(tail -n 1 .dictionary)
```

`>()`: redirect the file to the command's input

```sh
$ tar -cf >(ssh host tar xf -) .
```

# Compound Commands

`if`, `for`, `[[`... are all compound commands, others are
- subshell
- command grouping
- arithmetic evaluation

`function` and `alias` are not compound commands, but works similar

## Subshell

Similar to a child process, except that more information is inherited

When the subshell terminates, the cd command's effect is gone

Created
- implicitly for each command in pipeline
- explicitly by using `()` around a command

## Command grouping

`{}`: Allow a collection of commands to be considered as a whole with regards to redirection and control flow

## Arithmetic Evaluation

Ways to do arithmetic:

use `let`: `let a=4+5`, `let a='(5+2)*3'`

or use compound command `(())`: `((a=(5+2)*3))`. this way:
- can be used as command in `[[`
- can do arithmetic substitution: `echo "There are $(($rows * $columsn)) cells`
- can do ternary: `((abs= (a >= 0) ? a : -a))`
- can use integer as truth value: `if ((flag)); then echo "uh oh, our flag is up"; fi`, NOTE that `flag` don't even need `$`

## Function

```sh
dummy() {
    local i # local variable
    echo "$1" # use parameter
    return 9 # return code
}

# call
dummy one
r=dummy
t=$(dummy "two")
echo "$r" "$t" "$?"

# outputs:
# one
# dummy two 9
```

## Alias

If you need complex behavior, use a function instead

`alias`, `unalias`

# Expansion (by order)

- brace expansion

```
$ echo a{d,c,b}e
ade ace abe
```

- tilde expansion

`~`             The value of `$HOME`
`~/foo`         `$HOME/foo`
`~fred/foo`     The subdirectory foo of the home directory of the user fred
`~+/foo`        `$PWD/foo`
`~-/foo`        `${OLDPWD-’~-’}/foo`
`~N`            The string that would be displayed by `‘dirs +N’`
`~+N`           The string that would be displayed by `‘dirs +N’`
`~-N`           The string that would be displayed by `‘dirs -N’`

- shell parameter expansion: see <#Parameter Expansion>
- variable
- arithmetic expansion `$(( expression ))`
- command substitution (done in a left-to-right fashion) `$(cmd)`
- process substitution `<(list)` `>(list)`
- word splitting
- filename expansion

# Debug
- `set -o xtrace`
- see <https://www.shellcheck.net/>

# Tricks

use Heredoc to dump documentation:

```sh
usage() {
    cat <<EOF
usage: foobar [-x] [-v] [-z] [file ...]
A short explanation of the operation goes here.
It might be a few lines long, but shouldn't be excessive.
EOF
}
```

# Pitfalls

```sh
$ myname='Greg Wooledge' yourname='Someone Else'
$ [ $myname = $yourname ]
-bash: [: too many arguments
```

why: `[` was executed with the arguments `Greg`, `Wooledge`, `=,` `Someone`, `Else` and `]`. That is 6 arguments, not 4

fix: `[ "$myname" = "$yourname" ]` or use `[[`

# Best practice

- Avoid `.sh` file name extension
- Don't use `#!/bin/sh`, it's `bash`, not `sh`
- Always use `[[` instead of `[`
- Always use `$()` instead of \`\`
- Always use built-int math instead of `expr`
- Always quote sentences or strings that belong together, omit only when the specific situation requires unquoted behavior, like in `[[`
- Just use function to run repeat commands
- Put double quotes around every parameter expansion
- PE is better then `sed` `awk` `cut`
- DON'T EVER parse the output of `ls`, use globs instead
- DON'T EVER test or filter filenames with grep, use globs and path expansion
- Don't use cat to feed a single file's content to a filter, pass file name as parameter or use redirection
- Use while loop to read the lines of file instead of for loop
- The best way to always be compatible is to put your regex in a variable and expand that variable in `[[` without quotes
- Never use `[`'s `-a` (use multiple `[` instead) or `-o`, always prefer `[[` if you can
- If you have a list of things, you should always put it in an array
- Change `IFS` in subshell to avoid change current shell's default
- Don't use all-capital variable names in your scripts, unless they are environment variables
- Send your custom error messages to the `stderr` FD
- DO NOT use `cat` to pipe files to commands in your scripts, use redirection instead
- You should keep your logic (your code) and your input (your data) separated
- Herestrings should be preferred over pipes when sending output of a variable as stdin into a command
- If you end up making a pipeline that consists of three or more applications, it is time to ask yourself whether you're doing things a smart way

# Coodies

batch rename

```sh
for file in *.JPG *.jpeg
do mv -- "$file" "${file%.*}.jpg"
done
```
