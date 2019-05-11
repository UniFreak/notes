see <https://golang.org/doc/code.html>

A workspace is a directory hierarchy with two directories at its root:

src contains Go source files, and
bin contains executable commands.

The go tool builds and installs binaries to the bin directory

A typical workspace contains many source repositories containing many packages and commands. Most Go programmers keep all their Go source code and dependencies in a single workspace.

Note that symbolic links should not be used to link files or directories into your workspace

GOPATH environment variable specifies the location of your workspace, default to $home/go
must not be the same path as your Go installation

for convinience: `export PATH=$PATH:$(go env GOPATH)/bin`

Executable commands must always use package main

# Package

import path: a string that uniquely identifies a package, can be
- location inside a workspace
- location in a remote repository

if you have a GitHub account at github.com/user, that should be your base path

new package in `mkdir $GOPATH/src/github.com/user/hello/hello.go`

```go
package main

import "fmt"

func main() {
    fmt.Println("Hello, world.")
}
```

run `go install github.com/user/hello`, or `go install` if you alreay inside `hello/`


# Library

1. `mkdir $GOPATH/src/github.com/user/stringutil`
2. create `reverse.go`

```go
// Package stringutil contains utility functions for working with strings.
package stringutil

// Reverse returns its argument string reversed rune-wise left to right.
func Reverse(s string) string {
    r := []rune(s)
    for i, j := 0, len(r)-1; i < len(r)/2; i, j = i+1, j-1 {
        r[i], r[j] = r[j], r[i]
    }
    return string(r)
}
```

3. `go build github.com/user/stringutil` or `go build` if already inside source dir. this saves the compiled package in the local build cache
4. modify `hello.go`

```go
package main

import (
    "fmt"
    // here
    "github.com/user/stringutil"
)

func main() {
    fmt.Println(stringutil.Reverse("!oG ,olleH"))
}
```

5. isntall hello again
6. 