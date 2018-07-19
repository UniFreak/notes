# Crack

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

# Customization

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


# Plugins

- Package Control
- Composer
- ColorHelper
- ColorSublime
- PlantUML/Diagram
- IntelliDocs
- Origami
- BufferScroll
- EasyMotion
- Emmet(需要Pyv8插件)&Emmet CSS Snippet
- ProjectManager
- CodeFormatter
- DocBlockr
- MoveTab
- MarkdownExtends & MarkdownEditing
- Sublime Linter
    + SublimeLinter-PHP
    + SublimeLinter-JsHint
    + SublimeLinter-cssLint
    + SublimeLinter-Html-tidy
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
- FileDiffs/Sublimerge/Meld
- View in browsers
- SideBarEnhancements
- LiveRelaod
- GBK Encoding Support
- ColorPicker
- Markdown Preview
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
