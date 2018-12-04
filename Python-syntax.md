# language
- no attribute is really private in Python 
- `dunders`: names like `__this__`

# module
- module name can be accessed via `__name__`
- bug if run module with `python modu.py <arguments>`, module name will be `__main__`. so to make module as a script(for testing or provide a user interface) as well as importable module, add following codes at the end:

```python
if __name__ == "__main__":
    import sys
    # do things
```

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
- you can define a `__all__` variale to specify what sub-module is availabel when do `import *`
- when do `import pack.modu`:
1. look for `__init__.py` in `pack`, execute its top-level statements
2. look for `pack/modu.py`, execute its top-level statements
3. any varialbe, function or class in `modu.py` is available in 

# import:
- `from modu import func [as alias]`: import `func` into global
- `from modu import *`: import all funcitons except those beging with `__` into global
- `import modu [as alias]`: import `modu` under `modu` namespace
- `from [. | .. | ..modu] import item`: relative import


# OOP
- in python, everything is an object
- but python does not impose object-oriented programming as the main programming paradigm
- using stateless functions is a better programming paradigm

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