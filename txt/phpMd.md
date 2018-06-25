# concepts
- rule set
- exit code
    + 0: no error/exception, no rule violation
    + 1: error/exception occur
    + 2: rule violation occur
- renderer: xml/text/html

# install

# usage
- `phpmd [filename|directory] [report format] [ruleset file]`
- options
    + `minimumpriority`
    + `reportfile`
    + `suffixes`
    + `exclude`
    + `strict`
    + `ignore-violations-on-exit`
- special comment
    + `@SupressWarning(PHPMD.*)

# custom rules
1. make a class that extends from `\PHPMD\Rule\ClassAware`. availabel marker interface:
- `\PHPMD\Rule\ClassAware`
- `\PHPMD\Rule\FunctionAware`
- `\PHPMD\Rule\InterfaceAware`
- `\PHPMD\Rule\MethodAware`

2. config the rule in rule set file