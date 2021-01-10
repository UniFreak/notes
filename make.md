# See

- <https://www.gnu.org/software/make/>
- <https://www.gnu.org/software/make/manual/html_node/index.html>
- `man make`

# Concepts

`Make` is a build automation tool that automatically builds executable programs and libraries from source code by reading files called Makefiles which specify how to derive the target program

you can use make with any programming language whose compiler can be run with a shell command

A `makefile` is a file (by default named "Makefile") containing a set of directives used by a make build automation tool to generate a target/goal

# Usage

To prepare to use make, you must write a file called the makefile that describes the relationships among files in  your program,  and  the  states the commands for updating each file

In a program, typically the executable file is updated from object files, which are in turn made by compiling source files.