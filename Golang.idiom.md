# Ref
- <https://golang.org/doc/effective_go.html>

to write Go well, it's important to understand its properties and idioms, to know the established conventions for programming in Go

can apply to other language

# Formatting

let the machine take care of most formatting issues

source file level: `gofmt`
package level: `go fmt`
don't work around it

use tab
@? operator precedence hierarchy by spacing?

# Commentary

`godoc`

package comment: a block comment preceding the package clause
- every package should have
- for multi-file package, any file will do

exported (capitalized) name in a program should have a doc comment
begins with the name of the item it describes -> to grep
@? group declaration?

# Name

package name:
- good: short, concise, evocative
- convention: lower case, single-word
- convention: package name is the base name of source directory: `src/encoding/base64` -> `encoding/base64`
- @? `import .`
- @? consturctor name

no `Get` getter: `Owner()`
setter: `SetOwner()`

one method interface: `<method>er`: `String()` -> `Stringer`, `Write()` -> `Writer`...
