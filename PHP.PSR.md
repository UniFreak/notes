- 1. Basic Coding Standard
- 3. Logger Interface
- 4. Autoloading Standard
- 6. Caching Interface
- 7. HTTP Message Interface
- 11. Container Interface
- 12. Extended Coding Style Standard
- 13. Hypermedia Links
-

# Autoloader

# Coding Standard

use <?php / ?> tag or <?= / ?> tag

use utf-8 without BOM

a file should either declare new symbols(classes, functions, constants, etc.) or cause side effects, but *NOT* both

class names: StudlyCaps

class constants: ALL_UPPER

method name: camelCase

# Coding Style

indent using 4 space, not tabs

line length: 0~80 always ok, 80~120 acceptable, 120+ linter must show a warning

one space after `namespace` declaration, one space after `use` declaration

opening braces for class and methods must go on the next line(I hate this, too)

opening braces for control structures must go on the same line

opening/closing parenthses for control structures must not have a space after/before them

visibility must be delcared, `abstract` and `final` must before visibility, `static` must after

constrol structure keywords must have one space after them, method and function call must not

file must be UNIX LF line ending, end with a single blak line, and omit closing ?> if is pure PHP

there must not be a trailing space at the end of non-blank lines

there must not be more than one statement per line

keywords must be in lower case(including `true`, `false`, `null`)

property and method name should *NOT* be prefixed with a single underscore to indicate protected or private

in the argument list, there must not be a space before each comma, must be after comma

the arguments with defualt value must go at the end of the argument list

if argument list splited into multiple line, subsequent line is indented once, and one argument per line, and the wrapping parenthesis must be on their own line

use `elseif` instead of `else if`

when use `switch`, if there is a intentional fall-through in a non-empty `case` body, there must be a comment `// no break`

# Logger

# Comment
phpDocumentor tags:

```
@abstract @access @author @category @copyright @deprecated @example @final @filesource @global @ignore @internal @license @link @method @name @package @param @property @return @see @since @static @staticvar @subpackage @todo @tutorial @uses @var @version
```

phpDocumentor inline tags:

```
inline {@example} inline {@id} inline {@internal}} inline {@inheritdoc} inline {@link} inline {@source} inline {@toc} inline {@tutorial}
```
