# See

<https://www.gnu.org/savannah-checkouts/gnu/autoconf/manual/autoconf-2.70/autoconf.html>

# Concepts

Autoconf is a tool for producing shell scripts that automatically configure software source code packages to adapt to many kinds of Posix-like systems

it creates a configuration script from a template file that lists the system features that the package needs or can use

the primary goal is not to make the generation of configure automatic for package maintainers; rather, the goal is to make configure painless, portable, and predictable for the end user of each autoconfiscated package

for a more complete solution, it should be used in concert with other GNU build tools like Automake and Libtool

Autoconf requires GNU M4 version 1.4.6 or later in order to generate the scripts

The Gnu Build System:

- Automake      Escaping makefile hell

    Automake allows you to specify your build needs in a Makefile.am file with a vastly simpler and more powerful syntax than that of a plain makefile, and then generates a portable Makefile.in for use with Autoconf

- Gnulib        The GNU portability library

    Gnulib is a central location for common GNU code, intended to be shared among free software packages. . Its components are typically shared at the source level, rather than being a library that gets built, installed, and linked against.

- Libtool       Building libraries portably
    
    Libtool handles all the requirements of building shared libraries for you, and at this time seems to be the only way to do so with any portability. Libtool is used automatically whenever shared libraries are needed, and you need not know its syntax.
