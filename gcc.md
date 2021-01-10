# See

official doc: <https://gcc.gnu.org/onlinedocs/>

# Conditional

preprocessing conditional directive is a directive that instructs the preprocessor to select whether or not to include a chunk of code 

`#if` `#ifdef` `#ifndef`
`#defined` `#else` `#elif`

- `__has_attribute`:  test whether the attribute referenced by its operand is recognized by GCC

```cpp
#if defined __has_attribute
#  if __has_attribute (nonnull)
#    define ATTR_NONNULL __attribute__ ((nonnull))
#  endif
#endif
```

- `__has_cpp_attribute`:  in C++ code to test whether the attribute referenced by its operand is recognized by GCC

- `__has_c_attribute`: in C code to test whether the attribute referenced by its operand is recognized by GCC in attributes using the ‘[[]]’ syntax

- `__has_builtin`: whether the symbol named by its operand is recognized as a built-in function by GCC in the current language and conformance mode

```c
#if defined __has_builtin
#  if __has_builtin (__builtin_object_size)
#    define builtin_object_size(ptr) __builtin_object_size (ptr, 2)
#  endif
#endif
#ifndef builtin_object_size
#  define builtin_object_size(ptr)   ((size_t)-1)
#endif
```

- `__has_include`: whether the header referenced by its operand can be included using the ‘#include’ directive

```c
#if defined __has_include
#  if __has_include (<stdatomic.h>)
#    include <stdatomic.h>
#  endif
#endif
```

# C Extension

To test for the availability of these features in conditional compilation, check for a predefined macro __GNUC__, which is always defined under GCC

## Specify attributes

__attribute__ allows you to specify special properties of variables, function parameters, or structure, union, and, in C++, class members, and specify special attributes when making a declaration.

`__attribute__ ((attribute-list))`

attribute list:
- `noreturn`
- `noinline`
- `always_inline`
- `pure`
- `const`
- `format(archetype, string-index, first-to-check)`

    takes printf, scanf, strftime or strfmon style arguments which should be type-checked against a format string.

- `format_arg`
- `no_instrument_function`
- `section`
- `constructor`
- `destructor`
- `used`
- `unused`
- `deprecated`
- `weak`
- `malloc`
- `alias`

## Builtin functions

provided for optimization purposes

GCC includes built-in versions of many of the functions in the standard C library. These functions come in two forms: one whose names start with the __builtin_ prefix, and the other without.