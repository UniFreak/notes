# 解释器
- CPython: 官方, 用 C 编写
- IPython: 只是在交互方式上比 CPython 增强
- PyPy: 动态编译, 速度快, 但执行结果可能和 CPython 有差异
- Jython: 基于 java, 编译成 java 字节码执行
- IronPython: 基于 .Net, 编译成 .Net 字节码

# Jargons
- `dunders`: names like `__this__`

# Language
- We don’t use the term “private” (instead, non-public) here, since no attribute is really private in Python 

# @?
- `future imports`
- `absolute imports`, `relative imports`
- covariant or contravariant behavior
- `__all__`
- rich comprison

# 学习
- 可以一边在文本编辑器里写代码，一边开一个交互式命令窗口，在写代码的过程中，把部分代码粘到命令行去验证

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

# linter: 



# Best practice

- typical code structur:

    ```
    README.rst
    LICENSE
    setup.py
    requirements.txt
    sample/__init__.py
    sample/core.py
    sample/helpers.py
    docs/conf.py
    docs/index.rst
    tests/test_basic.py
    tests/test_advanced.py
    ```
- any directory with an `__init__.py` file is considered a Python package, `__init__.py` is used to gather all package-wide definitions. Leaving an `__init__.py` file empty is considered normal and even a good practice
- Using properly mutable types for things that are mutable in nature and immutable types for things that are fixed in nature helps to clarify the intent of the code

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