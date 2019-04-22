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

first-class citizen, can be passed around

can be closures: a function value that references variables from outside its body.

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

# If else

```go
if x < 0 { } // like `for`, no parentheses, always rquire braces

if v := math.Pow(x, n); v < lim { // can execute a short statement before condition

} else { // v still available in `else`
    fmt.Printf("%g >= %g\n", v, lim)
}
```

# Switch
- no `break` needed
- cases need not be constants

```go
switch os := runtime.GOOS; os {
case "darwin":
    fmt.Println("OS X.")
case "linux":
    fmt.Println("Linux.")
default:
    fmt.Printf("%s.\n", os)
}

// a clean way to write long if-then-else chains: switch without condition
t := time.Now()
switch {
case t.Hour() < 12:
    fmt.Println("Good morning!")
case t.Hour() < 17:
    fmt.Println("Good afternoon.")
default:
    fmt.Println("Good evening.")
}
```

# Defer

- A defer statement defers the execution of a function until the surrounding function returns
- but arguments are evaluated immediately
- multiple deferred calls are executed in last-in-first-out order (stacks)
- see <https://blog.golang.org/defer-panic-and-recover>

```go
fmt.Println("counting")

for i := 0; i < 10; i++ {
    defer fmt.Println(i)
}

fmt.Println("done")
```

# Pointer

- like C:
    + declaration use `*`: `var p *int`
    + generation use `&`: `p = &i`
    + dereferencing/indirecting use `*`: `*p = 21`
- unlike C: has no pointer arithmetic

# Struct: a collection of fields

```go
// declaration
type Vertex struct {
    X int
    Y int
}

// initialization: use {}
var (
    v = Vertex{1, 2}  // by listing field values
    w = Vertex{X: 1}  // by using `Name:` syntax, order is irrelevant, impliting Y:0
)

// access: by dot
p := &v
v.X = 4
p.Y = 5 // even for pointer, equvalent to `(*p).Y`
fmt.Println(v.X)
```

# Array

- fix-sized, cannot be resized

```go
// declaration
var a [2]string // [n]T
primes := [6]int{2, 3, 5, 7, 11, 13} // {}

// access: []
a[0] = "Hello"
```

# Slice

- zero value: `nil`
- does not store any data, are like references to array
- modifies to slice affect its underlying array, and other related slices
- length: the number of elements it contains
- capacity: the number of elements in the underlying array

```go
// declaration

// 1. from array: []T = [low:high], low-included, high-excluded
primes := [6]int{2, 3, 5, 7, 11, 13}
var a []int = primes[1:4] // type: []T, bounds: [low:high] (low-included, high-exclued)

// 2. from existing slice:
c =  a[:2] // omitted low default to 0, omitted high default to length of slice

// 3. using literals: will creates array then builds a slice from it
d := []int{2, 3, 5, 7, 11, 13} // like array without n
e := []struct {
    i int
    b bool
}{
    {2, true},
    {3, false},
}
f := [][]string{ // can contain other slices
    []string{"_", "_", "_"},
    []string{"_", "_", "_"},
    []string{"_", "_", "_"},
}

// 4. using `make`
g := make([]int, 3, 5) // make a []int slice with 3 length(zeroed) and 5 capacity


// len & cap
len(a)
cap(a)

// append
a = append(a, 1) // if underlying array too small, will point to newly allocated array

// iteration
for i, v := range a {} // range return index and value for each iteration
for _, v := range a {} // use _ to ignore index
for i, _ := range a {} // or value, the same as
for i := range a {}
```

# Maps

- zero value: `nil`

```go
type Vertex struct {
    Lat, Long float64
}

// declaration
var m map[string]Vertex
// 1. using make
m = make(map[string]Vertex)

// 2. using literals
var n = map[string]Vertex{
    "Bell Labs": Vertex{40.68433, -74.39967, },
    "Google": Vertex{37.42202, -122.08408, }, // type name `Vertex` can be omitted
}

// CURD
m["Bell Labs"] = Vertex{40.68433, -74.39967,} // set
v, ok := m["Bell Labs"] // access: v the value, ok whether element in m
delete(m, "BEll Labs") // delete
```
