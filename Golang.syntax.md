# Package
Programs start running in package `main`

```go
package main // Programs start running in package `main`
```

Import package:

1. factored import is preferred

```go
import (
    "fmt"
    "math"
)
```

2. multiple statement import 

```go
import "fmt"
import "math"
```

When importing a package, you can refer only to its `exported names`. A name is exported if it begins with a capital letter

# Function

arguments type comes after the variable name (why: <https://blog.golang.org/gos-declaration-syntax>)

```go
func add(x int, y int) int {
    return x + y
}
```

if consecutive named function parameters share a type, you can omit the type from all but the last

```go
func add(x, y int) int {
    return x + y
}
```

can return any number of results

```go
func swap(x, y string) (string, string) {
    return y, x
}
// call
a, b := swap("hello", "world")
```

"naked" return: a return without argument, return named return values. **should be used only in short functions**

```go
func split(sum int) (x, y int) {
    x = sum * 4 / 9
    y = sum - x
    return
}
```

# Varialbe

types

- bool
- string
- int  int8  int16  int32  int64
- uint uint8 uint16 uint32 uint64 uintptr
- byte (alias for uint8)
- rune (alias for int32, represents a Unicode code point)
- float32 float64
- complex64 complex128

declaration:

```go
package main

import "fmt"

var c, python, java bool // package level var

func main() {
    var i int
    var j, k int = 1, 2 // with initalizers
    f = float64(j) // type conversion: `Type(var)`, must be explicit
    m := 3 // short assignment, only availabe in function
    var ( // block declaration
        // declaration without initalizer are assgiend `zero value`:
        n bool // bool: false
        o float32 // numeric: 0
        p string // string: ""
    )

    fmt.Println(i, j, k, m, n, o, p, c, python, java)
}
```

# Constant:

- declared with `const`
- can not use `:=`
- other things are just like variables

# For loop (the only loop)

```go
for i := 0; i < 10; i++ { } // no parentheses, always require braces

// init & post statement are optional
for ; i < 10; { }
// drop semicolons, you got a `while` spelled `for` in go
for i < 10 { }
// forever
for { }
```

# If

```go
if x < 0 { } // like `for`, no parentheses, always rquire braces

if v := math.Pow(x, n); v < lim { // can execute a short statement before condition

} else { // v still available in `else`
    fmt.Printf("%g >= %g\n", v, lim) 
}
```

