# Intro

official site: <https://www.latex-project.org/>
all kinds of material, packages around TEX: <https://ctan.org/>

tutorial:
online book (no math): <http://latex.silmaril.ie/>

LATEX (created by L. B. Lamport) is one of a number of ‘dialects’ of TEX, all based on the version of TEX created by D. E. Knuth which is known as Plain TEX

LaTeX (pronounce: Lah-tech) is a high-quality typesetting system; it includes features designed for the production of technical and scientific documentation. LaTeX is the de facto standard for the communication and publication of scientific documents

LaTeX is not a word processor: leave document design to document designers, and to let authors get on with writing documents

We apply the LATEX program to the input file and then use the printer to print out the so-called ‘DVI’ file produced by the LATEX program

# Concepts

Distributions
: MiKTeX, TeX Live, … These are the large collections of TeX-related software to be downloaded and installed. When someone says “I need to install TeX on my machine”, they're usually looking for a distribution.

Front ends and editors
: Emacs, vim, TeXworks, TeXShop, TeXnicCenter, WinEdt, … These editors are what you use to create a document file. Some (e.g., TeXShop) are devoted specifically to TeX, others (e.g., Emacs) can be used to edit any sort of file. TeX documents are independent of any particular editor; the TeX typesetting program itself does not include an editor.

Engines
: TeX, pdfTeX, XeTeX, LuaTeX, … These are the executable binaries which implement different TeX variants. For example, pdfTeX implements direct PDF output (which is not in Knuth's original TeX), LuaTeX provides access to many internals via the embedded Lua language, etc. When someone says “TeX can't find my fonts”, they usually mean an engine.

Formats
: LaTeX, plain TeX, … These are the TeX-based languages in which one actually writes documents. When someone says “TeX is giving me a mysterious error”, they usually mean a format. (Incidentally, “LaTeX” has meant “LaTeX2e” for many years now.)

Packages
: geometry, lm, … These are add-ons to the basic TeX system, developed independently, providing additional typesetting features, fonts, documentation, etc. A package might or might not work with any given format and/or engine; for example, many are designed specifically for LaTeX, but there are plenty of others, too. The CTAN sites provide access to the vast majority of packages in the TeX world; CTAN is generally the source used by the distributions.

Output formats
: At a high level, the output format that gets used depends on the program you invoke. If you run latex (which implements the LaTeX format), you will get DVI; if you run pdflatex (which also implements the LaTeX format), you will get PDF.
: To get HTML, XML, etc., output, the tex4ht program can be used (run htlatex). TeX4ht uses TeX to do its job, but no TeX engine implements native HTML output. The lwarp LaTeX package causes LaTeX to output HTML5. The LaTeXML Perl program independently parses LaTeX documents and generates various output formats.

# control sequences
\ { } $ ^ _ % ~ # &

Most control sequences consist of a backslash \ followed by a string of (upper or lower case) letters

another variety of control sequence which consists of a backslash followed by a single character that is not a letter. Examples of control sequences of this sort are \{, \" and \$

$ is used when one is changing from ordinary text to a mathematical expression and when one is changing back to ordinary text

