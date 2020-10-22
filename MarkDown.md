# See

- <https://daringfireball.net/projects/markdown/>
- <https://github.github.com/gfm/>
- <https://www.markdownguide.org/>
- <https://stackoverflow.com/questions/6695439/how-to-link-to-a-named-anchor-in-multimarkdown>

# Notes
- You can always use HTML tag & attributs in Markdown file
- Not all app support all syntax, you need to experiment

# Basic Syntax

# Header

```
header level one
==========
header level two
-----------------

or:

# header level one
# header level two
## header level three
### header level four
#### header level five
##### header level six
```

# Block Quote

> this is a blockquote with two paragraphs
> - markdown list is supported inside blockquote
> - also **bold** and _italic_
> - you can experiment other supported syntax
>
> the second paragraph
>
> > blcokquote also can be *nested*

# Hard Line Break

end with \
or end with two space

# Listing

* unordered list item 1
* unordered list item 2
* unordered list item 3
+ unordered list item 1
+ unordered list item 2
+ unordered list item 3
- unordered list item 1
- unordered list item 2
- unordered list item 3

1. unordered list item 1
2. unordered list item 2
3. unordered list item 3

# Horizontal Ruling

hr1
* * *
hr2
***
hr3
*****
hr4
- - -

# Code

`code fragment`
``code fragment if you wanna encode a ` in fragment``

# Code Block

indent four space or one tab

    like this

# Emphasising

*emphasis*
_emphasis_
**strong**
__strong__
***bold italic***
___bold italic___
**_bold italic_**
__*bold italic*__

# Linking {#anchor-id}

with title: [with title](http://sample.com/ "Title")

without title: [without title](http://sample.com/)

local server resource [local](/about/)

[to anchor](#anchor-id)

autolink: <http://autolink.com>

email: <fanghao90s@gmail.com>

reference link: [reference link][link id]

---

[link id]: http://sample1.com/ "optional title"

# Images

with alt text: ![alt text](/path/to/img.jpg "Optional title")

reference image: ![ref image][img id] reference img defined by the following(seebottom)

---

[img id]: url/to/img "Optional title attribute"

# Escaping Characters

use \ to escape character.
you can escape these chars: \\, \`, \*, \_, \{,  \}, \[,  \], \(,  \), \#, \+, \-, \., \!, \|

# Table

| Year  | Temperature (low)   | Temperature (high)   |
| :---- | :-----------------: | -------------------: |
| 1900  |               -10   |                 25   |
| 1910  |               -15   |                 30   |
| 1920  |               -10   |                 32   |

The `:` specify how to align, and is optional

# Footnote

foot note 1 [^1] and another, [^another]

[^1]: note one details
[^another]: can use markdown inside footnote like `code` or **bold**
    indent to add multiple lines, can also do code block:
    ```js
    // js code
    ```

# Definition List

Term
: this is the definition of `term`
: another definition

# Task List

- [ ] Undone Task
- [x] Done Task

# Emoji

:dog: is :joy:

for complete emoji shortcodes, see <https://gist.github.com/rxaviers/7360908>

# Math (for Kramdown with math engine MathJax)

see <https://www.mathjax.org/>
see <LaTeX.md>

delimiter: $$...$$, \[...\], \(...\)

but when in markdown context, you need escape \, like this: \\[...\\], \\(...\\)

---
