# See

Official: <https://www.latex-project.org/>

Learn: <https://www.learnlatex.org/>

# Usage

Spaces
    multiple spaces treated as one
    two line break splite paragraph
Reserved Characters
    # $ % ^ & _ { } ~ \

    if you want to display them, type the bellow accordingly:
        \# 
        \$ 
        \% 
        \^{} or \textasciitilde 
        \& 
        \_ 
        \{ 
        \} 
        \~{} or \textasciicircum 
        \textbackslash{}
    \^ and \~ will add ^ and ~ in a letter. like, \~n will resule ñ
Group
    like a scope, the command in only apply in the group(scope)
    begin with { or \begingroup command, end with } or \endgroup command
Enviroment
    like group, but on a wider part of document

    syntax
        \begin{enviromentname}
        text to be influenced
        \end{enviromentname}
Commands
    case sensitive

    syntax
        \commandname[optionarg1, optionarg2]{arg1, arg2}...
Switch
    most standard LaTeX commands have a switch equivalent
    switch have no arguments but apply on the rest of the scope

    syntax
        {\switchname influeced text}, this is normal part
Comment
    begin with %
Document class file
    define the formatting