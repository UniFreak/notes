# Crack

```
—– BEGIN LICENSE —–
riku
Single User License
EA7E-806996
60C55C64D0195F15A118D93ECE0849B3
30C432F529F7BFAAF6568C6BFDDA1868
D6DF14D0464281D64A7E2EBB32558D84
148EF8041694AC00B9FA17D6119A6286
611D11E26BB48DCF19F76CB1CC7B995E
F41F7BFAB3348963FF69F163A70ABBEA
2526B73B523AA28BF66AFEF3ED3D1D21
BC6CB3B5B6D183FF5C755DE7007C6C41
—— END LICENSE ——
```


# Build

tools->build system->new build system

- Open by default app(typora): md, html...

```json
{
    "cmd": ["open", "$file"],
    "file_regex": ".md$"
}
```

- php

```json
{
    "shell_cmd": "/usr/local/opt/php@5.6/bin/php -f $file",
    "selector": "source.php"
}
```

- python

```json
{
    "shell_cmd": "python -u \"$file\"",
    "file_regex": "^[ ]*File \"(...*?)\", line ([0-9]*)",
    "selector": "source.python",

    "env": {"PYTHONIOENCODING": "utf-8"},

    "variants":
    [
        {
            "name": "Syntax Check",
            "shell_cmd": "python -m py_compile \"${file}\""
        }
    ]
}
```


# Plugins

Basic: 

- Package Control
- ColorHelper
- ColorSublime
- PlantUML/Diagram
- IntelliDocs
- Origami
- BufferScroll
- EasyMotion
- ProjectManager
- CodeFormatter
- MoveTab
- Synced Sidebar
- AdvancedNewFile
- GitGutter


Coding:

- Composer
- Anaconda
- Python Debugger
- Emmet & Emmet CSS Snippet
- DocBlockr
- MarkdownExtends & MarkdownEditing
- Sublime Linter
    + SublimeLinter-PHP
    + SublimeLinter-JsHint
    + SublimeLinter-cssLint
    + SublimeLinter-Html-tidy
    + SublimeLinter-pycodestyle
- BracketHighlighter
- CTags
- Plainnote
- Prefixr
- Code Alignment
- FileDiffs/Sublimerge/Meld
- SideBarEnhancements
- GBK Encoding Support
- Sublime Tmpl
- Xdebug

# Write your own plugin

```python
    open_browser:
        import sublime, sublime_plugin
        import webbrowser
        class OpenBrowserCommand(sublime_plugin.TextCommand):
           def run(self,edit):
              url = self.view.file_name()
              webbrowser.open_new(url)
```
