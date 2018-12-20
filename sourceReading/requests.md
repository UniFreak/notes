# Codique

- `from __future__ import print_function`

`__future__` is a pseudo-module which programmers can use to enable new language features which are not compatible with the current interpreter

see <https://stackoverflow.com/questions/7075082/what-is-future-in-python-used-for-and-how-when-to-use-it-and-how-it-works>

see <https://docs.python.org/3/reference/simple_stmts.html#future-statements>

- `from . import __version__ as requests_version`

and there is a `__version__` file store bunch of metadata variables

- `try ... except ... else:`

`else` runs when there is no exception but before the finally-clause.

in the Python world, using exceptions for flow control is common and normal,
your understanding that "exceptions are for the exceptional" is a rule that makes sense in some other languages, but not for Python

see <https://stackoverflow.com/questions/16138232/is-it-a-good-practice-to-use-try-except-else-in-python>

- use of `@pytext.fixture` @?

- use of `mocker` and `.patch()`

- `{event: [] for event in ['response']}`

see <https://docs.python.org/3/tutorial/datastructures.html> and look up for `list comprehension` and `dict comprehension`

- `@classmethod` and `@staticmethod`

see <https://stackoverflow.com/questions/12179271/meaning-of-classmethod-and-staticmethod-for-beginner>