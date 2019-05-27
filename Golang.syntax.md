# Basics

## Package
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

## Function

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

## Varialbe

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

## Constant:

- declared with `const`
- can not use `:=`
- other things are just like variables

## For loop (the only loop)

```go
for i := 0; i < 10; i++ { } // no parentheses, always require braces

// init & post statement are optional
for ; i < 10; { }
// drop semicolons, you got a `while` spelled `for` in go
for i < 10 { }
// forever
for { }
```

## If else

```go
if x < 0 { } // like `for`, no parentheses, always rquire braces

if v := math.Pow(x, n); v < lim { // can execute a short statement before condition

} else { // v still available in `else`
    fmt.Printf("%g >= %g\n", v, lim)
}
```

## Switch
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

## Defer

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

## Pointer

- like C:
    + declaration use `*`: `var p *int`
    + generation use `&`: `p = &i`
    + dereferencing/indirecting use `*`: `*p = 21`
- unlike C: has no pointer arithmetic

## Struct: a collection of fields

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

## Array

- fix-sized, cannot be resized

```go
// declaration
var a [2]string // [n]T
primes := [6]int{2, 3, 5, 7, 11, 13} // {}

// access: []
a[0] = "Hello"
```

## Slice

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

## Maps

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

# Methods and interfaces

## Methods

- Go does not have classes
- a method **is a function** with a special **receiver** argument
- can define methods on types, struct or non-struct
- recevier's type definition and method definition must be in the same package
- this means you can **not** define methods on built-in types

```go
type Vertex struct {
    X, Y float64
}

// define a Abs() method on Vertex v (the receiver)
func (v Vertex) Abs() float64 {
    return math.Sqrt(v.X*v.X + v.Y*v.Y)
}

// define a Scale() method on Vertex pointer v, so to 
// 1. modify v
// 2. avoid copying, more efficient
func (v *Vertex) Scale(f float64) {
    v.X = v.X * f
    v.Y = v.Y * f
}

// call, vs functions:
// - functions with a pointer/value argument must take a pointer/value
// - methods with pointer/value receivers take either a value or a pointer
// - methods on a given type should have either value or pointer receivers, but not a mixture of both
v.Scale(10)
v.Abs()
```

## Interface

```go
// define interface Abser: a type defined as set of method signatures
type Abser interface {
    Abs() float64
}

type i interface {} // empty interface, used by code that handles values of unknown type

// implement interface Abser
// - by implementing methods
// - no `implements` keyword requried, it's implicit
type Vertex struct {
    X, Y float64
}
func (v *Vertex) Abs() float64 {
    // it's common to gracefully handle being called with a nil receiver
    if v == nil { 
        return 1.0
    }
    return math.Sqrt(v.X*v.X + v.Y*v.Y)
}

// use interface Abser: a interface value holds (<concreteValue>, <concreteType>)
func main() {
    var a Abser

    v := Vertex{3, 4}
    a = &v
    fmt.Printf("(%v, %T)", a, a) // interface value: (&{3 4}, *main.Vertex5)
    fmt.Println(a.Abs()) // 5

    var n *Vertex
    a = n
    fmt.Printf("(%v, %T)", a, a) // interface value: (<nil>, *main.Vertex<nil>)
    fmt.Println(a.Abs()) // 1

    var i Abser
    fmt.Printf("(%v, %T)", i, i) // nil interface value: (<nil>, <nil>)
    fmt.Println(i.Abs()) // run-time error, can not call method on a nil interface
}
```

## Common built-in interface

**Stringer**

- defined by `fmt` package
- `Stringer` is a type that can describe itself as a string
- `fmt` package (and many others) look for this interface to print values

```go
type Stringer interface {
    String() string
}
```

**error**

- Go programs express error state with error values
- Functions often return an error value
- calling code can test whether error is nil by `result, err := myFunc()`

```go
type error interface {
    Error() string
}
```

**Reader**

- defined by `io` package
- represents any type from which you can read bytes

```go
 type Reader interface {
     Read(p []byte) (n int, err error)
}
```

**Image**

- defined by `image` package

```go
type Image interface {
    ColorModel() color.Model
    Bounds() Rectangle
    At(x, y int) color.Color
}
```




## Type assertion: `t, ok := i.(T)` and Type switch

```go
var i interface{} = "hello"

// Type assertion
s := i.(string) // assert i hold concret type `string` and assign the string value to s
f = i.(float64) // if assertion failed, then `panic` (see )
s, ok := i.(string) // `ok` is a boolean indicate whether assertion succeed. this mute panic if assertion failed

// Type switch
switch v := i.(type) { // `v` be the type of `i`, and hold value of `i`
case int:
    fmt.Printf("Twice %v is %v\n", v, v*2)
case string:
    fmt.Printf("%q is %v bytes long\n", v, len(v))
default:
    fmt.Printf("I don't know about type %T!\n", v)
}
```

# Concurrency

## Goroutines

are lightweight threads managed by the Go runtime

```go
func say(s string) {
    for i := 0; i < 5; i++ {
        time.Sleep(100 * time.Millisecond)
        fmt.Println(s)
    }
}

func main() {
    // start a goroutine
    // - evaluation of `say("world")` happens in the current goroutine
    // - execution of `say("world")` happens in the new goroutine
    // - access to shared memory must be synchronized
    go say("world")
}
```

## Channels

- typed conduit through which you can send and receive values, using channel operator `<-`
- great for communication among goroutines

**unbuffered channel**

```go
func sum(s []int, c chan int) {
    sum := 0
    for _, v := range s {
        sum += v
    }
    c <- sum // send to channel
}

s := []int{7, 2, 8, -9, 4, 0}
c := make(chan int) // create `unbuffered channel`: sends and receives **block** until the other side is ready
go sum(s[:len(s)/2], c)
go sum(s[len(s)/2:], c)
x, y := <-c, <-c // receive from channel
fmt.Println(x, y, x+y)
```

**buffered channel**

```go
// create `buffered channel`, by pass into `make()` buffer size 2
// - send block only when the buffer is full
// - receive block when the buffer is empty
ch := make(chan int, 2) 
ch <- 1
ch <- 2
fmt.Println(<-ch)
fmt.Println(<-ch)
```

**range and close**

```go
func fibonacci(n int, c chan int) {
    x, y := 0, 1
    for i := 0; i < n; i++ {
        c <- x
        x, y = y, x+y
    }
    // close a channel to indicate that no more values will be sent
    // only the sender should close a channel, never the receiver
    // sending on a closed channel will cause a panic
    // only necessary when the receiver must be told there are no more values coming
    close(c)
}

c := make(chan int, 10)
go fibonacci(cap(c), c)
for i := range c { // `range` will receive values from channel until it is closed
                   // can also check whether channel is close manually by `v, ok := <-ch`
    fmt.Println(i)
}
```

## Select

- lets a goroutine wait on multiple communication operations
- blocks until one of its cases can run, then it executes that case
- chooses one at random if multiple are ready

```go
func fibonacci(c, quit chan int) {
    x, y := 0, 1
    for {
        select {
        case c <- x:
            x, y = y, x+y
        case <-quit:
            fmt.Println("quit")
            return
        default:
            // run if no other case is ready
        }
    }
}

c := make(chan int)
quit := make(chan int)
go func() {
    for i := 0; i < 10; i++ {
        fmt.Println(<-c)
    }
    quit <- 0
}()
fibonacci(c, quit)
```

## sync.Mutex

- used to make sure only one goroutine can access a variable at a time to avoid conflicts
- great for `mutual exclusion` among goroutines

```go
type SafeCounter struct {
    v   map[string]int
    mux sync.Mutex
}

func (c *SafeCounter) Inc(key string) {
    // code between `Lock()` and `UnLock()` are executed in mutual exclusion
    c.mux.Lock()
    c.v[key]++
    c.mux.Unlock()
}

func (c *SafeCounter) Value(key string) int {
    c.mux.Lock()
    // can use defer to ensure the mutex will be unlocked
    defer c.mux.Unlock()
    return c.v[key]
}
```
