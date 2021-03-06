# Install

1. requirements:
    - java
    - graphviz
2. download `plantuml.jar`
3. run `java -jar plantuml.jar diagram.txt` to generate diagram

[optional]: for sublime text:

- install and use `PlantUmlDiagrams` package
- or simply use build system:

```json
{
    "shell_cmd": "java -jar /Applications/plantuml.jar $file && subl $file_base_name.png",
    "file_regex": ".uml$"
}
```

# Command line

better alias `plantuml` to `java -jar plantuml.jar`

- `plantuml file|dir...`, support wildcard
- `-help` help
- `-x` exclude
- `-o` output dir
- `-tsvg`, `-tpng`... specify output image type


# Syntax
<relation>:
    availabel joint point:
        <|
        *
        o
        (none)
    available joint line:
        --
        ..

    combine joint point and joint line in any way, such as
        classA <|--* classB
        classC o..|> classD
relation label:
    classA "left side label" <relation> "right side label" : relation label [<|>]
    e.g. Driver "1" -- "1" Car : drives >
properties
    property with () will be method
    can define a stereotype using << >>
    available modifier:
        -: private
        #: protected
        ~: package
        +: public

        {static}: static
        {absstract}: abstract
    available seperator:
        --comment or not--
        ==
        ..
        __

    e.g.
    class classA <<general>>{
        ==nonsence seperacoter==
        -String privateVar
        ..
        {static} method()
        +void {abstract} aMethod()
    }
notes
    class Object

    note top of Object : In java, every class\nextends this one.

    note "This is a floating note" as N1
    note "This note is connected\nto several objects." as N2
    Object .. N2
    N2 .. ArrayList

    class Foo
    note left: On last defined class
    note right: On last defined class
    note top
      In java, <size:18>every</size> <u>class</u>
      <b>extends</b>
      <i>this</i> one.
    end note

    note as N2
      This note is <u>also</u>
      <b><color:royalBlue>on several</color>
      <s>words</s> lines
      And this is hosted by <img:sourceforge.jpg>
    end note

    class Dummy
    Dummy --> Foo : A link
    note on link #red: note that is red

    Dummy --> Foo2 : Another link
    note right on link #blue
        this is my note on right link
        and in blue
    end note