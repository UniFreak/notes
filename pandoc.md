# See

<http://pandoc.org>

# Manual

Pandoc  is  a  Haskell library for converting from one markup format to another, and a command-line tool that uses this library.

## Using pandoc

If  no  input-files  are specified, input is read from stdin.  Output goes to stdout by default.  For output to a file, use the -o option.

If  multiple  input  files  are given, pandoc will concatenate them all (with blank lines between them) before parsing.

## Specifing format

-f/--form

-t/--to

Use pandoc --list-input-formats and pandoc --list-output-formats to print lists of supported formats.

If the input or output format is not specified explicitly, pandoc will attempt to guess it from the  exten-sions of the filenames.

## Charactor Encoding

Pandoc uses the UTF-8 character encoding for both input and output.  If your local  character  encoding  is not UTF-8, you should pipe input and output through iconv:

     iconv -t utf-8 input.txt | pandoc | iconv -f utf-8

## Creating PDF

By  default,  pandoc will use LaTeX to create the PDF. The tool used to generate the PDF  from  the  intermediate format may be specified using --pdf-engine.

You can control the PDF style using variables.

To  debug  the  PDF  creation,  it  can be useful to look at the intermediate representation: instead of -o test.pdf, use for example -s -o test.tex to output the generated LaTeX.


