# Referece
- https://docs.python-guide.org
- https://python-packaging-user-guide.readthedocs.io/
- https://packaging.python.org/guides/distributing-packages-using-setuptools/

# Interpreter
- CPython: 官方, 用 C 编写
- IPython: 只是在交互方式上比 CPython 增强
- PyPy: 动态编译, 速度快, 但执行结果可能和 CPython 有差异
- Jython: 基于 java, 编译成 java 字节码执行
- IronPython: 基于 .Net, 编译成 .Net 字节码

# Concepts
- `PyPA`: Python Packaging Authority, a working group that maintains many of the relevant projects in Python packaging
- `PyPI`: Python Package Index
- `Virtual Environment`: keep the dependencies required by different projects in separate places

# Packaging

libirary distribution formats:

- `.py`: standalong module (single file, pure python)
- source distribution: provides metadata and the essential source files needed for installing by a tool like pip, or for generating a Built Distribution.
    + `sdist`
- built distribution: containing files and metadata that only need to be moved to the correct location on the target system
    + `binary distribution`
    + `egg`: introduced by `setuptools`
    + `wheel`: to replace `egg`.
        * `universal wheel`: pure Python(i.e. contain no compiled extension), support 2 and 3
        * `pure python wheel`: pure Python
        * `plateform wheel`: non-pure Python

complete application distribution:

- PEX: libraries included
- anaconda: Python ecosystem
- freezers: Python included (docker, AppImage...)
- images: system libraries included
- containers: sandbox images
- virtual machine: kernel included
- hardware: plug and play

# Distribute a wheel

1. make sure `setup.py` is created correctly, and you have `setuptools` installed
2. run `python3 setup.py sdist bdist_wheel` to generate `dist/pkg.whl` and `dist/pkg.tar.gz`
3. make sure you have PyPI account, and `twine` installed
4. run `twine upload --repository-url https://pypi.org/legacy/ dist/*` to push to repo
5. run `python3 -m pip install --index-url https://pypi.org/simple/ pkgname` to install



# Installer

- `pip`:
    + install from: pypi.org or others, VSC, local src
    + can install pre-built bianry archive: `sdist` or `wheels`(preferred)
    + will locally build a wheel and cache it for future installs
- `setuptools` & `wheel`: install from source archives

# Virtualenv

- `venv`: create virtual environments, available by default after(include) Python 3.3
- `virtualenv`: a tool to create isolated Python environments (remember to exclude the virtual environment folder from source control)
    + create virtual env: `virtualenv <my_env>`
    + activate virtual env: `$ source <my_env>/bin/activate`
    + deactivate virtual env: `deactivate`
    + delete virtual env: delete the folder
    + freeze current venv packages: `pip freeze > requirements.txt`
    + restore old venv packages: `pip install -r requirements.txt`
- `virtualenvwrapper`: makes working with virtual environments much more pleasant
    + install
        1. `pip install virtualenvwrapper`
        2. `export WORKON_HOME=~/Envs`
        3. `source /usr/local/bin/virtualenvwrapper.sh`
    + create venv: `mkvirtualenv my_project`
    + activate venv: `workon my_project`
    + deactivate venv: `deactivate`
    + delete venv: `rmvirtualenv venv`
- `virtualenv-burrito`:  have a working virtualenv + virtualenvwrapper environment in a single command
- `autoenv`: automagically activates the `.env` environment

# Dependeny management

- `pipenv`: install dependencies and manage virtual environments (wrap pip and virutalenv)
    + `pipenv shell --python <version>`
    + `pipenv install <package> [--dev]`
    + `pipenv lock`
    + `pipenv run python <script>`

# Linter
- sublime text: sublimeLinter & sublimeLinter-pycodestyle

# Debugger
- sublime text: Python Debugger

# Framework
- GUI: Cocoa, GTk, PyQt, Qt, Tk...
- Web: Django, Flask, Falcon, Tornado, Masonite...
- Cli: Clint, Click, docopt, Plac, Cliff, Cement...

# Hosting Pypi
- devpi
- pypiserver
- warehouse

# @?
- python-config
- wheel
- `site packages`: system-wide installed packages
- `future imports`
- `absolute imports`, `relative imports`
- covariant or contravariant behavior -> see <https://www.python.org/dev/peps/pep-0484/>
- `__all__`
- rich comprison

# Style guide: PEP 8 (<http://pep8.org/>)
- PEPs: Python Enhancement Proposals (<https://www.python.org/dev/peps/>)
- do not break backwards compatibility just to comply with this PEP
- use UTF8
- prefer spaces
- line break after binary operator
- Surround top-level function and class definitions with two blank lines
- Method definitions inside a class are surrounded by a single blank line
- imports:
    + should be on separate lines
    + group order(blank line between each group)
        1. standard library imports
        2. related third party imports
        3. local application/library specific imports
    + Implicit relative imports & Wildcard imports should never be used
- naming:
    + `HTTPServerError` is better than `HttpServerError`
    + `_single_leading_underscore`: to name internal interfaces (packages, modules, classes, functions, attributes or other names)
    + `single_trailing_underscore_`: to avoid conflicts with Python keyword
    + `__double_leading_underscore`: inside class `FooBar`, `__boo` becomes `_FooBar__boo`. use this to name the attributes that you do not want subclasses to use
    + `__double_leading_and_trailing_underscore__`: Never invent such names; only use them as documented
    + Modules should have short, all-lowercase names
    + add suffixes `_co` or `_contra` to the variables used to declare covariant or contravariant behavior
    + suffix `Error` on your exception names
    + Class names should normally use the CapWords convention
    + Function, Method, Instance variables should be lowercase, with words separated by underscores
    + Cosntants should be all capital letters with underscores separating word
    + Always use `self` for the first argument to instance methods
    + Always use `cls` for the first argument to class methods
- coding
    + modules should explicitly declare the names in their public API using the `__all__` attribute.
    + use `'.join()` instead of `a += b` or `a = a + b`
    + use `is` or `is not` to do comparisons to singletons like `None`
    + Use `is not` operator rather than `not ... is`
    + beware of writing `if x` when you really mean `if x is not None`
    + When implementing ordering operations with rich comparisons, it is best to implement all six operations
    + Always use a `def` statement instead of an assignment statement that binds a lambda expression directly to an identifier
    + Derive exceptions from `Exception` rather than `BaseException`
    + Design exception hierarchies based on the distinctions that code catching the exceptions is likely to need, rather than the locations where the exceptions are raised
    + When catching exceptions, mention specific exceptions whenever possible instead of using a bare `except:` clause
    + When a resource is local to a particular section of code, use a `with` statement to ensure it is cleaned up promptly and reliably after use. A `try/finally` statement is also acceptable
    + Use string methods instead of the string module
    + Use `''.startswith()` and `''.endswith()` instead of string slicing to check for prefixes or suffixes
    + Object type comparisons should always use `isinstance()` instead of comparing types directly
    + Don’t compare boolean values to True or False using `==`, do `if greeting:`

# Structure

Cli app:

- One-off script: for your own

```
cmd.py
```

- One-off script: need distribute

```
cmd/
|- .gitignore
|- cmd.py
|- LICENSE
|- README.md
|- requirements.txt
|- setup.py
|- tests.py
```

- sample Repository

```
README.rst
LICENSE
TODO
CHANGELOG
Makefile
setup.py # build script for setuptools
requirements.txt

sample/__init__.py
sample/core.py
sample/helpers.py
// or just
sample.py

docs/conf.py
docs/index.rst
tests/test_basic.py
tests/test_advanced.py
```

- for Django: `$ django-admin.py startproject samplesite .`, note the `.`, resulting:

```
README.rst
manage.py
samplesite/settings.py
samplesite/wsgi.py
samplesite/sampleapp/models.py
```


# Test
- unit test: `unittest` module or `py.test` package
- mock: `mock` module
- main use cases: `doctest` module
- property based testing: `hypothesis` package
- automate and standardize testing: `tox` package

# Logging
- use `logging` module
- `logging` is always better then `print` except when want to display a help statement for a cli app

# Best practice

- you should always install Setuptools, Pip, and Virtualenv
- don’t namespace with underscores, use submodules instead

```python
import library.plugin.foo # OK
import library.foo_plugin # not OK
```

- you need to understand the import mechanism in order to use this concept properly and avoid some issues
- use properly mutable types for things that are mutable in nature and immutable types for things that are fixed
- avoid using the same variable name for different things or assigning to a variable more than once
- discourages the usage of the` %` operator in favor of the `str.format()` method
- one of the secrets of becoming a great Python programmer is to read, understand, and comprehend excellent code
    + Howdoi
    + Flask
    + Diamond
    + Werkzeug
    + Requests
    + Tablib
    + @see: https://click.palletsprojects.com/en/7.x/quickstart Screencast and Examples
- use `sphinx` and `read the doc` to doc your project
- use `Numpy style` doc string

# Gotchas
- default arguments are evaluated **once** when the function is defined, resued in each succesive calls

```python
def append_to(element, to=[]):
    to.append(element)
    return to

my_list = append_to(12)
print(my_list) # [12]

my_other_list = append_to(42)
print(my_other_list) # [12, 42], not expected [42]

# you should do
def append_to(element, to=None):
    if to is None:
        to = []
    to.append(element)
    return to
# but sometimes you can specifically “exploit” (read: use as intended) this behavior
```

# Codie & Idioms

- create a concatenated string from 0 to 19 (e.g. "012..1819")

```python
nums = map(str, range(20))
print "".join(nums)
```

- string concatenate

```python
foo = 'foo'
bar = 'bar'

foobar = foo + bar  # This is good
foo += 'ooo'  # This is bad, instead you should do:
foo = ''.join([foo, 'ooo'])
```

- unpacking

```python
a, *rest = [1, 2, 3]
# a = 1, rest = [2, 3]
a, *middle, c = [1, 2, 3, 4]
# a = 1, middle = [2, 3], c = 4

filename = 'foobar.txt'
# use __ as throw away variable
basename, __, ext = filename.rpartition('.')
```

- create repeated list

```python
four_nones = [None] * 4
# [None, None, None, None]

four_lists = [[] for __ in range(4)]
# [[], [], [], []]
```

# Tricks
- find out user base binary directory: `python -m site --user-base`

# debug @?

# Notes
- Pipfile (and requirements.txt) is for applications; setup.py is for packages. They serve different purposes. If you need to sync them, you’re doing it wrong (IMO)