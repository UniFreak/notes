# class naming
class
	first char must be letter
	use UpperCamelCase naming
	file convention: class.ClassName.inc
property & method
	first char must be letter
	use lowerCamelCase naming
	use _ if it is not public
	default value must not depend on runing time
constant
	ALL_CAPITAL_SEPERATED_BY_UNDERSCORE

# scope
- public: for api
- protected: for internal use
- private: least common

# magic method
list:
	__autoload($className)

	__get($name)
	__set($name, $value)
	__construct()
	__toString()
	__clone()
why use:
	trigger customer behavior when event happen
	customize object creation
	defaults like current time
why not use:
	3-20 times slower method call
	ignores scope(all is public), meaning can accidentally expose unpublic data
decide for yourself

# why static:
single connection for databases or services

avoids need for global scope(before PHP 5.3)

single instance of class

# why constant:

for properties that never change
	- error codes
	- data structure names

# overriding:
constants
	- just redeclare
	- but can't redeclare constant defined in interface
methods
	- must have same number of arguments(except constructor)
	- can call parent class methods and properties

# build-in class
stdClass
Exception

# design-pattern
singleton: restrict instantiation to one object
	- Database class
	- ? LazyInit ?
factory: create object without specifying exact class
strategy:
	- family of algorithms to perform a task
	- mechanism to determin which algorithm to use
?gateway?
ORM