common variation:
    BNF (Backus-Naur Form)
    EBNF (Extended Backus-Naur Form)
    ABNF (Augmented Backus-Naur Form)
    WSN (Wirth sysntax notation)
concepts
    terminal symbols
        e.g. "else", "if", "then", "while"
    nonterminal symbols
        e.g. <int>, <char>, <boolean>
    metasymbol
        e.g. :=, |, {}, (), [], *
common design
    definition          =
    concatenation       ,
    concatenation       <space>
    termination         ;
    termination         .
    alternation         |
    alternation         /
    optional            [ ... ]
    repetition          *
    repetition          ?
    repetition          +
    repetition          n<rule>
    repetition          { ... }
    grouping            ( ... )
    terminal string     " ... "
    terminal string     ' ... '
    comment             ;
    comment             (* ... *)
    special sequence    ? ... ?
    exception           -
    value range         -
self speaking
    BNF:
        <syntax>         ::= <rule> | <rule> <syntax>
        <rule>           ::= <opt-whitespace> "<" <rule-name> ">" <opt-whitespace> "::=" <opt-whitespace> <expression> <line-end>
        <opt-whitespace> ::= " " <opt-whitespace> | ""
        <expression>     ::= <list> | <list> <opt-whitespace> "|" <opt-whitespace> <expression>
        <line-end>       ::= <opt-whitespace> <EOL> | <line-end> <line-end>
        <list>           ::= <term> | <term> <opt-whitespace> <list>
        <term>           ::= <literal> | "<" <rule-name> ">"
        <literal>        ::= '"' <text> '"' | "'" <text> "'"
    EBNF:
    ABNF:
    WSN: