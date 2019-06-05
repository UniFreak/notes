# TODO
- with & context manager
- ~~OOP~~
- pytest
- nested method
- decrator

# data types
- no attribute is really private in Python
- `dunders`: names like `__this__`

## basic
- bool: True, False
- numeric: int, float, complex
- str: '' (also an immutable sequence)

## data structure
sequence:
- list: []
- tuple: ()
- range: range()

text sequence:
- str: ' ', " ", """ """

binary:
- bytes
- bytearray
- memoryview

- set: unique, unordered: `set()`
- dict: {}

# operator
- arithmetic: +  -  *  /  %  //  **
- comparison: ==  !=  <  >  <=  >=
- logical: and  not  or
- bitwise: &  |  ~  ^  >>  <<
- assignment: =  +=  -=  *=  /=  %=  //=  **=  &=  |=  ^=  >  <<=
- identity: is      is not (the only common use in practice is `is None` or `is not None`)
- membership: in    not in

# flow control
- if  elif  else
- while
- break  continue
- for in
- <this> if <condition> else <that>

# errors
- syntax error: happen at the token processing
- exception: error detected during execution, all derived from `BaseException` class

When creating a module that can raise several distinct errors, a common practice is to create a base class for exceptions defined by that module, and subclass that to create specific exception classes for different error conditions

```python
try:
    raise SomeError1 # can raise by class name or instance like `raise SomeError1('message')`
    # do something
except SomeError1: # can catch mutliple Error like `except (SomeError1, SomeError2)`
    # do something
    raise # will re-raise catched exception
except SomeError2 as err2: # can also chain the `except` clause
    # do something
else: # executed if try clause does not raise an exception
    # do something
finally: # always execute
    # do something
```

# namespacing
- module is a namespacing machanism
- top level code is in `__main__` namesapce

# variable
- `del`
- `nonlocal`, `global`

# function
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
    _age #  underscore prefixed attributes should be considered non-public
    __mangle #  `name mangling` to _Dog__mangle @?

    def __init__(self, name):
        self.name = name #  unique to each instance
        Animal.do() #  call Base class method
```

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
- isinstance()
- issubclass()

# module
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