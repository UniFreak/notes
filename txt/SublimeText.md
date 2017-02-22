=============== 破解 ===============
2.02&3
----- BEGIN LICENSE -----
Andrew Weber
Single User License
EA7E-855605
813A03DD 5E4AD9E6 6C0EEB94 BC99798F
942194A6 02396E98 E62C9979 4BB979FE
91424C9D A45400BF F6747D88 2FB88078
90F5CC94 1CDC92DC 8457107A F151657B
1D22E383 A997F016 42397640 33F41CFC
E1D0AE85 A0BBD039 0E9C8D55 E1B89D5D
5CDB7036 E56DE1C0 EFCC0840 650CD3A6
B98FC99C 8FAC73EE D2B95564 DF450523
------ END LICENSE ------

=============== 自定义 ===============
自定义Snippets
    比如定义一个 `ci` 为 `http:\\console.info(args)` ，保存在 User\js-snippets\console-info.sublime-snippet ：
    <snippet>
        <content><![CDATA[console.info(${1})]]><\content>
        <tabTrigger>ci<\tabTrigger>
        <scope>source.js<\scope>
        <description>console.info<\description>
    <\snippet>
# Build

tools->build system->new build system

- HTML 

    ```
    {
        "C:\Program Files\Google\Chrome\Application\chrome.exe"
    }
    ```

保存为chrome.sublime-build


# 插件

- Package Control
- Composer
- ColorHelper
- PlantUML/Diagram
- CodeIntel
- IntelliDocs
- Origami
- BufferScroll
- EasyMotion
- Emmet(需要Pyv8插件)&Emmet CSS Snippet
- HostEdit
- ProjectManager
- CodeFormatter
- DocBlockr
- Plaintask
- MoveTab
- Nettuts+ Fetch
- MarkdownEditing
- Sublime Linter
    + SublimeLinter-PHP
    + SublimeLinter-JsHint
    + SublimeLinter-cssLint
    + SublimeLinter-Html-tidy
- Git
- Gist
- GitGutter
- PHPCS
- BracketHighlighter
- Synced Sidebar
- Goto Documentation
- Text Pastry
- CTags
- AdvancedNewFile
- Bootstrap 3 Snippet
- Emoji
- SASS
- HexViewer
- AlignTab
- TabsExtra
- FTPSync
- Plainnote
- Prefixr
- Code Alignment
- FindKeyConflict
- FileDiffs
- View in browsers
- SideBarEnhancements
- LiveRelaod
- GBK Encoding Support
- ColorPicker
- Markdown Preview
- Clipboard History           //sublime3集成了
- Clipboard Manager
- YUI Compressor/Minify/Minifier/ClentSide
- ES6-Toolkit
- JavascriptNext
- JSLint
- PackageResourceViewer
- SublimeGDB
- Open URL
- jQuery
- Sublime Tmpl
- Stackoverflow search
- PHPUnit
- PHPUnit Snippets
- Soda Theme/Phoenix Theme/sunnyvale
- Sublime FTP
- Xdebug
- File Navigator

# 自定义插件
    open_browser:
        import sublime, sublime_plugin
        import webbrowser
        class OpenBrowserCommand(sublime_plugin.TextCommand):
           def run(self,edit):
              url = self.view.file_name()
              webbrowser.open_new(url)