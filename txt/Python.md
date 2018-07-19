comment
	#
	""" """
**
Methods that use dot notation only work with strings.
On the other hand, len() and str() can work on other data types.

------------------------------ CODE[String] ------------------------------
name = raw_input("What is your name?")
quest = raw_input("What is your quest?")
color = raw_input("What is your favorite color?")

print "Ah, so your name is %s, your quest is %s, " \
"and your favorite color is %s." % (name, quest, color)

------------------------------ CODE[Date/Time] ------------------------------
from datetime import datetime
now = datetime.now()

print '%s/%s/%s %s:%s:%s' % (now.year,now.month,now.day,now.hour, now.minute, now.second)

not is evaluated first;
and is evaluated next;
or is evaluated last.


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
- avoid using `import *`
    + bad: `from modu import *`
    + better `from modu import sqrt`
    + best `import modu`
- python's `import` is different with `include file`, imported code is isolated in a module namespace, which means that you generally don’t have to worry that the included code could have unwanted effects
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

# Coding guide

- see <http://pep8.org/>
- Don’t use the `dict.has_key()` method. Instead, use `x in d` syntax, or pass a default argument to `
- use `list comprehensions` to work with lists
- The `enumerate()` function has better readability than handling a counter manually
- Use the with open syntax to read from files