#YAML(rhymes with 'camel')

YAML Ain't Markup Languages

YAML is a data serialiazation languages useful for such as:

- configuration file
- log file
- Internet messaging
- Interprocess messaging
- object persistence 
- cross-languages data sharing
- data auditing

#Relatingship with JSON

can be viewed as a natural super set of JSON, every JSON file is also a valid YAML file

more human-readable, less easier to parse

#Rules

- file extension: .yml
- a BOM must not appear inside a document
- use SPACE(not ~~TAB~~) to indent
- indent property or lists with 1 or more spaces
- case sensitive

#Concepts

##Directives: instruction to the YAML processor

- %YAML
- %TAG

##Nodes: a single native data structure, may be those types

- Scalar
- Collection
    - Sequence(array)
    - Mapping(hash/map)

##Tags: represent type information of native data structure, including

- Global tags: URI, globally unique across all application, recommend to start with 'tag:'
- Local tags: not URI, specific to a single application, start with '!'

##Node Styles

- block style: use indentatoin to denote structure
    - block scalar
        - literal
        - folded
    - block collection
        - next line
        - in-line
- flow style: rely on explicit indicators
    - flow scalar
        - plain
        - single-quoted
        - double-quoted
    - flow collection
        - explicit
        - single pair

##Chomping: how final line breaks and trailing empty line are interpreted

- strip: '-', all excluded
- clip: default, final line breaks preserved, trailing empty line excluded
- keep: '+', all preserved

#Official Reference Card

```YAML
%YAML 1.1   # Reference card
---
Collection indicators:
    '? ' : Key indicator.
    ': ' : Value indicator.
    '- ' : Nested series entry indicator.
    ', ' : Separate in-line branch entries.
    '[]' : Surround in-line series branch.
    '{}' : Surround in-line keyed branch.
Scalar indicators:
    '''' : Surround in-line unescaped scalar ('' escaped ').
    '"'  : Surround in-line escaped scalar (see escape codes below).
    '|'  : Block scalar indicator.
    '>'  : Folded scalar indicator.
    '-'  : Strip chomp modifier ('|-' or '>-').
    '+'  : Keep chomp modifier ('|+' or '>+').
    1-9  : Explicit indentation modifier ('|1' or '>2').
           # Modifiers can be combined ('|2-', '>+1').
Alias indicators:
    '&'  : Anchor property.
    '*'  : Alias indicator.
Tag property: # Usually unspecified.
    none    : Unspecified tag (automatically resolved by application).
    '!'     : Non-specific tag (by default, "!!map"/"!!seq"/"!!str").
    '!foo'  : Primary (by convention, means a local "!foo" tag).
    '!!foo' : Secondary (by convention, means "tag:yaml.org,2002:foo").
    '!h!foo': Requires "%TAG !h! <prefix>" (and then means "<prefix>foo").
    '!<foo>': Verbatim tag (always means "foo").
Document indicators:
    '%'  : Directive indicator.
    '---': Document header.
    '...': Document terminator.
Misc indicators:
    ' #' : Throwaway comment indicator.
    '`@' : Both reserved for future use.
Special keys:
    '='  : Default "value" mapping key.
    '<<' : Merge keys from another mapping.
Core types: # Default automatic tags.
    '!!map' : { Hash table, dictionary, mapping }
    '!!seq' : { List, array, tuple, vector, sequence }
    '!!str' : Unicode string
More types:
    '!!set' : { cherries, plums, apples }
    '!!omap': [ one: 1, two: 2 ]
Language Independent Scalar types:
    { ~, null }              : Null (no value).
    [ 1234, 0x4D2, 02333 ]   : [ Decimal int, Hexadecimal int, Octal int ]
    [ 1_230.15, 12.3015e+02 ]: [ Fixed float, Exponential float ]
    [ .inf, -.Inf, .NAN ]    : [ Infinity (float), Negative, Not a number ]
    { Y, true, Yes, ON  }    : Boolean true
    { n, FALSE, No, off }    : Boolean false
    ? !!binary >
        R0lG...BADS=
    : >-
        Base 64 binary value.
Escape codes:
 Numeric   : { "\x12": 8-bit, "\u1234": 16-bit, "\U00102030": 32-bit }
 Protective: { "\\": '\', "\"": '"', "\ ": ' ', "\<TAB>": TAB }
 C         : { "\0": NUL, "\a": BEL, "\b": BS, "\f": FF, "\n": LF, "\r": CR,
               "\t": TAB, "\v": VTAB }
 Additional: { "\e": ESC, "\_": NBSP, "\N": NEL, "\L": LS, "\P": PS }
...
```

#Resources

- wikipedia: <https://en.wikipedia.org/wiki/YAML>
- official site: <http://www.yaml.org/spec/1.2/spec.html>
- linter: <http://www.yamllint.com>