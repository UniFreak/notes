# See
- <https://sqlite.org/docs.html>

# Distinctive Features

- Zero configuration
- Serverless
    Any program that is able to access the disk is able to use an SQLite database. The only one that this author knows of that allows multiple applications to access the same database at the same time
- Single Database File
- Stable Cross-Platform Database File
- Compact
    the whole SQLite library with everything enabled is less than 500KiB in size
- Manifest typing
    the datatype is a property of the value itself, not of the column in which the value is stored. SQLite thus allows the user to store any value of any datatype into any column regardless of the declared type of that column. More reliable and easier to use, especially when used in combination with dynamically typed programming languages such as Tcl and Python
- Readable source code
- SQL statements compile into virtual machine code
    in most SQL engines that internal data structure (SQL statement compiled version) is a complex web of interlinked structures and objects. In SQLite, the compiled form of statements is a short program in a machine-language like representation. Users of the database can view this virtual machine language by prepending the EXPLAIN keyword to a query.
    great benefit to the library's development, a tremendous help in debugging.

# Dot-commands

.help

