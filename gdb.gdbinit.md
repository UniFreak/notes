# See

`man gdbinit`

<https://sourceware.org/gdb/current/onlinedocs/gdb/Sequences.html#Sequences>

# Usage

## User defined command

```sh
define adder
  set $i = 0
  set $sum = 0
  while $i < $argc
    eval "set $sum = $sum + $arg%d", $i
    set $i = $i + 1
  end
  print $sum
end
```

Document the user-defined command

```sh
document commandname
```

Define or mark the command commandname as a user-defined prefix command

`define-prefix commandname`

display definitions

```sh
show user
show user commandname
```

