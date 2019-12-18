# See
- <https://sebastianraschka.com/Articles/2014_python_2_3_key_diff.html>
- book: introduction to programming using Python

# Heads Up!
No ++ or --

# TODO
- with & context manager
- ~~OOP~~
- pytest
- nested method
- decrator

# Concept
All data in Python are objects
A variable in Python is actually a reference to an object
System create an activation record that stores arguments and variables for each function when they are called, and place activation record in to call stack
Python create and stores objects in a separate memory space called heap

content of `immutable object` cannot be changed, like string or number
whenever you assign a new number to a variable, Python creates a new object for the new number and assigns the reference of the new object to the variable

name mangling: the interpreter changes the name of the variable in a way that makes it harder to create collisions when the class is extended later, It does this to protect the variable from getting overridden in subclasses

dunder: name begin and end with double underscore

# Comment

```python
    # line comment
    ''' cross line
        comment
    '''
```

# Identifier

can contain letters, digits and underscore
begin with letter or underscore
can not be keywords
case sensitive

# Data types
see <https://docs.python.org/3/reference/datamodel.html#types>

- no attribute is really private in Python
- `dunders`: names like `__this__`

conversion: int(val), str(val)
rounding: round(val)

## Basic
- bool: True, False
- numeric: int, float, complex

## Sequence
Immutable
- str: str(), ' ', " ", ''' ''', """ """, r' '
- tuple: tuple(), ()
- bytes: bytes(), b' ', b" ", b''' ''', b""" """

Mutable
- list: list(), []
- bytearray (mutable): bytearray()

- range: range()
- memoryview: memoryview()

escape: \b, \t, \n, \f, \r, `\\`, \', \''

common operatioin:
- in, not in
- +, *
- [i], [i: j]
- len(), min(), max(), sum()
- for in
- <, <=, >, <=, =, !=

list comprehension: [x for x in range(5)]

list methods
- append(x)
- count(x)
- extend(list)
- index(x)
- insert(i, x)
- pop(i)
- remove(x)
- reverse()
- sort()

to copy list, don't do `list2 = list1`, becuase this will only cause them to refer to on reference.
do this instead:
- `list2 = [for x in list1]`
- `list2 = [] + list1`


## Set
- set (mutable): set(), {element, ...}
- frozenset (immutable): frozenset()

{} can create empty dict, use set() to create empty set

not ordered, cannot use [] operator

set methods
- issubset(s) or <, <=
- issubset(s) or >, >=
- union(s) or |
- insertsect(s) or &
- difference(s) or -
- symmetric_difference(s) or ^

## Mapping
- dict: dict(), {key:val}

not ordered, cannot use >, >=, <, <=

dict methods
- keys()
- values()
- items()
- clear()
- get(key) # return None if key not exist rather error as using []
- pop(key) # same as del(dictName[key])


## Callable
- user-defined function: def
- instance methods
- generator function: yield
- coroutine function: async def
- asynchronous generator function: async def yield
- built-in function
- built-in method
- class
- class instance: __call__

## Others
- modules
- custom class
- I/O object
- internal types

# Operator
- arithmetic:
    - +  -  *  /  %
    - //:  integer/floor division  `11 // 2` is 0
    - **: exponentiation `4 ** 0.5` is 2.0
- comparison: ==  !=  <  >  <=  >=
- logical: and  not  or
- bitwise: &  |  ~  ^  >>  <<

- assignment: =
- augmented assignment: +=  -=  *=  /=  %=  //=  **=  &=  |=  ^=  >  <<=
- simultaneous assginments: `var1, var2, ..., varn = exp1, exp2, ..., expn`
  often to swap value: `x, y = y, x`

- identity: is      is not (the only common use in practice is `is None` or `is not None`)
- membership: in    not in

+ and += can do string concatenation

Precedence (low to high)
+, - (unary)
**
not
*, /, //, %
+, - (binary)
<, <=, >, >=
==, !=
and
or
=, +=, -=, *=, /=, //=, %=

# Flow control
selection
- if  elif  else
- conditional expression: <this> if <condition> else <that>
- no switch

loop
- while
- for in
- break  continue
- no do while

range():
range(a) same as range(0, a)
range(a, b, k) k is step, can be negative

# Function
parameters means formal parameters
argument means actual parameter

DEFINE:

```python
    def func(arg1, arg2):
        # statements
```

can be nested
non-default parameters must be defined before default parameters
no return means return None, return multiple value with `return a, b`
multiple same name function, latest win

CALL:

call with positional arguments: `func(a, b)`
or keyword arguments `func(arg1 = a, arg2 = b)`
positional arguments cannot appear after any keyword arguments

argument is passed to the parameter pass-by-value
the value is actually a reference value to some object

*args and **kwargs @?

# Errors & Excpetions
- syntax error: happen at the token processing
- exception: error detected during execution, all derived from `BaseException` class

Excpetion Class Level:
Base <- Exception <- StandardError
- <- ArithmeticError <- ZeroDivisionError
- <- EnvironmentError <- IOError & OSError
- <- RuntimeError
- <- LookupError <- IndexError & KeyError
- <- SyntaxError <- IndentationError

When creating a module that can raise several distinct errors, a common practice is to create a base class for exceptions defined by that module, and subclass that to create specific exception classes for different error conditions

```python
try:
    raise SomeError1 # can raise by class name or instance like `raise SomeError1('message')`
    # handle
except SomeError1: # can catch mutliple Error like `except (SomeError1, SomeError2)`
    # handle
    raise # will re-raise catched exception
except SomeError2 as err2: # using alias
    # handle
except: # all other exceptions
    # handle
else: # no exception
    # handle
finally: # always execute
    # handle
```

# namespacing
- module is a namespacing machanism
- top level code is in `__main__` namesapce

# Variable
- `del`
- `nonlocal`, `global`

```python
x = 1; # global by default
def func():
    global x # bind a local in the global scope
    global y # create a global inside function
    z # local by default
```

# Output format
- %
- .format

# Function
user-defined function has those special attributes:
- `.__doc__`
- `.__name__`
- `.__qualname__`
- `.__module__`
- `.__defaults__`
- `.__code__`
- `.__globals__`
- `.__dict__`
- `.__closure__`
- `.__annotations__`
- `.__kwdefaults__`

# OOP
see <https://stackoverflow.com/questions/7456807/python-name-mangling>

- in python, everything is an object
- each object has an identity (`id()`), a type (`type()`) and a value
- objects are never destroyed, only garbage-collected when they are unreachable(CPython: reference-counting)
- objects contain references to other objects are called containers
- but python does not impose object-oriented programming as the main programming paradigm
- using stateless functions is a better programming paradigm

## class definition

```python
class Dog(Animal, Friend): #  inherit by (), support multi-inheritance
                           #  can also be `module.ClassName`
    kind = 'canine' #  class variable shared by all instance
    _age #  underscore prefixed attributes **should be** considered non-public
    __mangle #  private, name mangling to Dog._Dog__mangle

    def __init__(self, name): # initializer, naming `self` is just a convention
        super().__init__() # also can be `Animal.__init__(self)`, but not preferred
                           # also note: super() don't require passing `self`
        self.name = name #  unique to each instance
```

instantiate: `d = Dog('maew')`

every class in Python is descendended from the `object` class
all methods defined in the `object` class are special methods:
- __new__()
- __str__()
- __init__()
- __eq__(other)

## name mangling

see <https://dbader.org/blog/meaning-of-underscores-in-python>

name mangling isn’t tied to class attributes specifically. It applies to any name starting with two underscore characters used in a class context.

## three new objects

**class object**: wrapper around the contents of the namespace created by the class definition
- attribute:
    + `__doc__`: return docstring
    + `__name__`
    + `__module__`
    + `__dict__`
    + `__bases__`
    + `__annotations__`
- methods
    + `__new__()`: when create
    + `__call__()`: after create
    + `__init__()` called when do instantiating **instance object**(by calling a **class object**)
    + `__del__()`: when destroy
    + `__str__()`, `__bytes__()`, `__repr__()`, `__format__()`
    + `__lt__()`, `__le__()`, `__eq__()`, `__ne__()`, `__gt__()`, `__ge__()`
    + `__getattr__()`, `__setattr__()`, `__delattr__()`
    + `__get__()`, `__set__()`, `__delete__()`
    + `__hash__()`, `__bool__()`, `__dir__()`
    + `__getitem__()`: [] operation
    + `__iter__()` and `__next__()` to add iterator bahavior

**instance object**: instantiated by calling a class object (`obj = Cls()`)

- attribute
    + `__class__`
    + `__dict__`
- methods (see method object)

**method object**: all attributes of a class that are function objects define corresponding methods of its instances. when a non-data attribute of an instance is referenced, the instance’s class is searched. If the name denotes a valid class attribute that is a function object, a method object is created by packing (pointers to) the instance object and the function object just found together in an abstract object: this is the method object

- attribute
    + `__self__`: return the instance object
    + `__func__`: return the function object defined in class

## some remarks

- data attributes override method attributes with the same name, use naming convention to avoid conflicts
- nothing in Python makes it possible to enforce data hiding — it is all based upon convention
- `self` is also an convention


## related functions
- isinstance(object, className)
- issubclass()

## Special Methods

operator overloading:
__add__(self, other)
__mul__(self, other)
__sub__(self, other)
__truediv__(self, other)
__mod__(self, other)
__cmp__(self, other)
__lt__(self, other)
__le__(self, other)
__eq__(self, other)
__ne__(self, other)
__gt__(self, other)
__ge__(self, other)
__getitem__(self, index)
__contains__(self, value)
__len__(self)
__str__(self)
__float__(self)
__int__(self)

# Module
simply a `.py` file

- bug if run module with `python modu.py <arguments>`, module name will be `__main__`. so to make module as a script(for testing or provide a user interface) as well as importable module, add following codes at the end:

```python
if __name__ == "__main__":
    import sys
    # do things
```

special atributes:
- `__name__`
- `__doc__`
- `__annotation__`
- `__file__`
- `__dict__`

- access module function via `modu.func`
- access module global variable via `module.var`
- module search path

    1. search built-in modules
    2. search `sys.path`: current directory -> then `PYTHONPATH` -> then `$PATH`
    3. raise ImportError if not found

- **unlike to php's `include file`**, the `import <modu>` imported code is isolated in a module namespace, function and class definitions are stored in the module’s dictionary

# package
- a way of structuring Python’s module namespace by using “dotted module names”
- any directory with an `__init__.py` file is considered a Python package
- leaving an `__init__.py` file empty is considered normal and even a good practice
- you can define a `__all__` variable to specify what sub-module is availabel when do `import *`
- when do `import pack.modu`:
1. look for `__init__.py` in `pack`, execute its top-level statements
2. look for `pack/modu.py`, execute its top-level statements
3. any varialbe, function or class in `modu.py` is available

# import:
- `from modu import func [as alias]`: import `func` into global
- `from modu import *`: import all funcitons except those beging with `__` into global
- `import modu [as alias]`: import `modu` under `modu` namespace
- `from [. | .. | ..modu] import item`: relative import

# decorators
- a decorator is a function or a class that wraps (or decorates) a function or a method
- useful for separating concerns and avoiding external un-related logic ‘polluting’ the core logic of the function or method
- functions can be decorated manually or by using `@decrator`

```python
def foo():
    # do something

def decorator(func):
    # manipulate func
    return func

foo = decorator(foo)  # Manually decorate

@decorator
def bar():
    # Do something
# bar() is decorated
```

# context manager
- is a Python object that provides extra contextual information to an action
- running a callable upon initiating the context using the with statement
- running a callable upon completing all the code inside the with block

```python
with open('file.txt') as f: # ensure f.close() is called
    contents = f.read()
```

- you can implement this by yourself, using a class or a generator

```python
# using a class: better if there’s a considerable amount of logic to encapsulate
class CustomOpen(object):
    def __init__(self, filename):
        self.file = open(filename)

    def __enter__(self):
        return self.file

    def __exit__(self, ctx_type, ctx_value, ctx_traceback):
        self.file.close()

with CustomOpen('file') as f:
    contents = f.read()
```

```python
# using generator: better when we’re dealing with a simple action
from contextlib import contextmanager

@contextmanager
def custom_open(filename):
    f = open(filename)
    try:
        yield f
    finally:
        f.close()

with custom_open('file') as f:
    contents = f.read()
```

# 3 vs 2
- 2 can behave like 3 using `__furture__` module
- `print` is a function now, not a statement, must call with parenthesis
- `5 / 2` now return `2.5`, not `2`
- use unicode by default, not ASCII
- `range` behave like `xrange` now, no `xrange` anymore

# I/O

## File

- open(file, mode) create a _io.TextIOWrapper

_io.TextIOWrapper
- read(n) n chars
- readline() a line
- readlines() all line
- write(s)
- close()

mode: r, w, a, rb, wb

snippets: read all lines:
- `while line != '':` or
- `for line in infile:`


## Web

urllib.request.urlopen(url)

## Binary

pickle.dump(o, f)
pickle.load(f)

# Common functions
input
print(item, end='')
format(var, specifier)
    format specifier
    <10.2f: type can be f,e,d,x,o,b,%,s, use <,> do justify, 10 is width, 2 is precision
eval
id(var)
type(var)

## Built-in
abs(x)
max(x1, x2, ...)
min(x1, x2, ...)
pow(a, b) # same as a ** b
round(x)
round(x, n) round to n digits after decimal point

## Do Math: `math`

fabs(x)
ceil(x)
floor(x)
exp(x) exponential function # exp(1) is 2.71828
log(x) natural logarithm
log(x, base)
squrt(x)
sin(x)
asin(x)
cos(x)
acos(x)
tan(x)
degrees(x)
radians(x)

## String Manipulation
ord(ch)
chr(code)

## Generate Random `random`
.randint(min, max)
.random(max) random float