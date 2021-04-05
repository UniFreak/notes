# See
- <http://sourceware.org/gdb/current/onlinedocs/gdb/>
- Mac Install: 
    - <https://sourceware.org/gdb/wiki/PermissionsDarwin>
    - <https://www.ics.uci.edu/~pattis/common/handouts/macmingweclipse/allexperimental/mac-gdb-install.html>

gdb.xml:

```xml
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE plist PUBLIC "-//Apple//DTD PLIST 1.0//EN"
"http://www.apple.com/DTDs/PropertyList-1.0.dtd">
<plist version="1.0">
<dict>
    <key>com.apple.security.cs.allow-jit</key>
    <true/>
    <key>com.apple.security.cs.allow-unsigned-executable-memory</key>
    <true/>
    <key>com.apple.security.cs.allow-dyld-environment-variables</key>
    <true/>
    <key>com.apple.security.cs.disable-library-validation</key>
    <true/>
    <key>com.apple.security.cs.disable-executable-page-protection</key>
    <true/>
    <key>com.apple.security.cs.debugger</key>
    <true/>
    <key>com.apple.security.get-task-allow</key>
    <true/>
</dict>
</plist>
```

`codesign --entitlements gdb.xml -fs gdbc /usr/local/bin/gdb`

# Config file

`system.gdbinit`: system-wide initialization file

`system.gdbinit.d`: system-wide initialization directory

GDB will check the current directory for a file called `.gdbinit`

# Sample Session

```sh
gdb m4
(gdb) set width 70
(gdb) break m4_changequote
(gdb) run
# call changequote
(gdb) n # advance to next line
(gdb) s # step in
(gdb) bt # backtrace: displays a stack frame for each active subroutine
(gdb) p lquote # print value of lquote
(gdb) p len_lquote=strlen(lquote) # p can print the value of any expression—and that expression can include subroutine calls and assignments
(gdb) l # display ten lines of source surrounding the current line
(gdb) c # continue executing
Ctrl-d # exit m4
(gdb) quit # quit gdb
```

## Behavior

A blank line as input to GDB (typing just RET) means to repeat the previous command

Any text from a # to the end of the line is a comment

Ctrl-o binding is useful for repeating a complex sequence of commands (?)

press `tab` for command completion

GNU C/C++ compiler, supports ‘-g’ with or without ‘-O’, making it possible to debug optimized code. We recommend that you always use ‘-g’ whenever you compile a program.
see: <https://gcc.gnu.org/onlinedocs/gcc/Debugging-Options.html#Debugging-Options>
You will have the best debugging experience if you use the latest version of the DWARF debugging format that your compiler supports. DWARF is currently the most expressive and best supported debugging format in GDB.

On certain operating systems4, GDB is able to save a snapshot of a program’s state, called a checkpoint, and come back to it later

GDB represents the state of each program execution with an object called an inferior. An inferior typically corresponds to a process, but is more general and applies also to targets that do not have processes. Inferiors may be created before a process runs, and may be retained after a process exits. Inferiors have unique identifiers that are different from process ids. Usually each inferior will also have its own distinct address space, although some embedded targets may have several inferiors running in different parts of a single address space. Each inferior may in turn have multiple threads running in it


## Usage

Ask for help

```sh
(gdb) help

(gdb) help status

(gdb) apropos [-v] regexp # searches through all of the GDB commands

(gdb) complete args # lists all the possible completions

(gdb) info # describing the state of your program

(gdb) show # describing the state of GDB itself
```

Specify executable file and core dump file

```sh
file filename # Use filename as the program to be debugged
file # Display file info

# Specify that the program to be run is found in filename
exec-file [ filename ] 

# Read symbol table information from file filename
symbol-file [ filename [ -o offset ]] 

# Specify the whereabouts of a core dump file to be used
core-file [filename]
core
```


Command setting

```sh
(gdb) set print elements 10

(GDB) print -elements 10 -- some_array

(gdb) with setting [value] [-- command]
(gdb) w setting [value] [-- command]
```


Run shell command

```sh
(gdb) !ls # run shell command ls

(gdb) pipe p var|wc # pipe `p var` to `wc`

(gdb) p /x var
(gdb) ||grep red # pipe prev output to `grep`
```

Log output

```sh
set logging ...
```


Debug already ran process

```sh
(gdb) attach process-id # you can use ‘jobs -l’ to find the process
(gdb) detach # release it from GDB control
```

- must also have permission to send the process a signal

Debug a core dump

```sh
(gdb) kill
```

Set breakpoints

```sh
(gdb) break location # a function name, a line number, or an address of an instruction

(gdb) break … if cond # break conditionally

(gdb) tbreak args #  breakpoint enabled only for one stop

(gdb) rbreak regex # breakpoints on all functions matching the regular expression regex

(gdb) rbreak file:regex # limits the search for functions matching the given regular expression to the specified file

(gdb) info break # show breakpoints
```

Set watchpoint (break if value of expression changed)

```sh
# watchpoint for expr
watch [-l|-location] expr [thread thread-id] [mask maskvalue] 

# break when the value of expr is read by the program
rwatch [-l|-location] expr [thread thread-id] [mask maskvalue] 

# break when expr is either read from or written into by the program
awatch [-l|-location] expr [thread thread-id] [mask maskvalue]

# prints a list of watchpoints
info watchpoints
```

Set catchpoint (stop for certain kinds of program events)

```sh
# event can be:
# - throw [regexp]
# - rethrow [regexp]
# - catch [regexp]
# - exception [name]
# - exception unhandled
# - handlers [name]
# - assert
# - exec
# - syscall [name | number | group:groupname | g:groupname] …
# - fork
# - vfork
# - load [regexp]
# - unload [regexp]
# - signal [signal… | ‘all’]

catch event # Stop when event occurs

tcatch event # enabled only for one stop
```

Edit breakpoint, watchpoint and catchpoint

```sh
clear
clear function
clear filename:function
clear linenum
clear filename:linenum

delete [breakpoints] [list…]

disable [breakpoints] [list…] 
enable [breakpoints] [list…]

# Specify expression as the break condition for breakpoint, watchpoint, or catchpoint number bnum
condition bnum expression
```

Dynamic printf

```sh
# Whenever execution reaches location, print the values of one or more expressions under the control of the string template.
dprintf location,template,expression[,expression…]
```

Continuing, Stepping

```sh
c # Resume program execution, at the address where your program last stopped
step # Continue running your program until control reaches a different source line
step count # Continue running as in step, but do so count times.
next [count] # similar to step, but function calls that appear within the line of code are executed without stopping
finish # Continue running until just after function in the selected stack frame returns
until # Continue running until a source line past the current line, in the current stack frame, is reached
advance location # Continue running the program up to the given location
stepi arg # Execute one machine instruction, then stop and return to the debugger
nexti arg # Execute one machine instruction, but if it is a function call, proceed until the function returns
```

Skipping

```sh
skip function [linespec] # unction named by linespec or the function containing the line named by linespec will be skipped over when stepping
skip file [filename] # function whose source lives in filename will be skipped over when stepping
skip delete [range] # Delete the specified skip(s)
skip enable [range] # Enable the specified skip(s)
skip disable [range] # Disable the specified skip(s)
```

Examining stack

Examing source code

```sh
list linenum # Print lines centered around line number linenum
list function # Print lines centered around the beginning of function function
list # Print more lines
list - # Print lines just before the lines last printed
list location # Print lines centered around the line specified by location
list first,last # Print lines from first to last
list ,last # Print lines ending with last.
list first, # Print lines starting with first.
list + # Print lines just after the lines last printed.
```

Search source file

```sh
forward-search regexp
search regexp
reverse-search regexp
```

Examining data

```sh
print [[options] --] expr # print expr
print [[options] --] /f expr # print expr with specified format: x, d, u, o, t, a, c, f, s, z, r
# options
# -address [on|off]             Set printing of addresses
# -array [on|off]               Pretty formatting of arrays
# -array-indexes [on|off] 
# -elements number-of-elements|unlimited
# -max-depth depth|unlimited
# -null-stop [on|off]           char arrays to stop at first null char
# -object [on|off]              printing C++ virtual function tables
# -pretty [on|off]              pretty formatting of structures
# -raw-values [on|off]          whether to print values in raw form
# -repeats number-of-repeats|unlimited
# -static-members [on|off]      printing C++ static members
# -symbol [on|off]              printing of symbol names when printing pointers
# -union [on|off]               printing of unions interior to structures
# -vtbl [on|off]                printing of C++ virtual function tables

print *p@<len>    # print <len> elements of *p as array 

explore arg # interactive way
explore value expr # explores the value of the expression expr
explore type arg # explores the type of arg
```

C Preprocessor Macros

```sh
macro exp expression # expanding all preprocessor macro invocations in expression
info macro [-a|-all] [--] macro # current definition or all definitions of the named macro
macro define macro replacement-list # define a macro
macro undef macro
macro list

```



# Coodie

`p sizeof(char)`

`show architecture`

`set architecture i386:x86-64`

`b zend_gc.c:289`