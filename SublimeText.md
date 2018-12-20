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
- DocBlockr_Python
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

# Api

## module

```
sublime.
    set_timeout(callback, delay)
    set_async_timeout(callback, delay)
    status_message(string)
    error_message(string)
    message_dialog(string)
    ok_cancel_dialog(string, <ok_title>)
    yes_no_cancel_dialog(string, <yes_title>, <no_title>)
    load_resource(name)
    load_binary_resource(name)
    find_resource(pattern)
    encode_value(value, <pretty>)
    decode_value(string)
    expand_variables(value, variables)
    load_settings(base_name)
    save_settings(base_name)
    windows()
    active_window()
    packages_path()
    installed_packages_path()
    cache_path()
    get_clipboard(<size_limit>)
    set_clipboard(string)
    score_selector(scope, selector)
    run_command(string, <args>)
    log_commands(flag)
    log_input(flag)
    log_result_regex(flag)
    version()
    platform()
    arch()
sublime_plugin.
    (no method)
```

## class

```
sublime.View.
    id()
    buffer_id()
    file_name()
    name()
    set_name(name)
    is_loading()
    is_dirty()
    is_read_only()
    set_read_only(value)
    is_scratch()
    set_scratch(value)
    settings()
    window()
    run_command(string, <args>)
    size()
    substr(region)
    substr(point)
    insert(edit, point, string)
    erase(edit, region)
    replace(edit, region, string)
    sel()
    line(point)
    line(region)
    full_line(point)
    full_line(region)
    split_by_newlines(region)
    word(point)
    word(region)
    classify(point)
    find_by_class(point, forward, classes, <separators>)
    expand_by_class(point, class, <separators>)
    expand_by_class(region, classes, <separators>)
    find(pattern, formPosition, <flags>)
    find_all(pattern, <flags>, <format>, <extractions>)
    rowcol(point)
    text_point(row, col)
    set_syntax_file(syntax_file)
    extract_scope(point)
    scope_name(point)
    score_selector(point, selector)
    find_by_selector(selector)
    show(point, <show_surrounds>)
    show(region, <show_surrounds>)
    show(region_set, <show_surrounds>)
    show_at_center(point)
    show_at_center(region)
    visible_region()
    viewport_position()
    set_viewport_position(vector, <animate>)
    viewport_extent()
    layout_extent()
    text_to_laytout()
    layout_to_text(vector)
    window_to_layout(vector)
    window_to_text(vector)
    line_height()
    em_width()
    add_regions(key, [regions], <scope>, <icon>, <flags>)
    get_regions(key)
    erase_regions(key)
    set_status(key, value)
    get_status(key)
    erase_status(key)
    command_history(index, <modifying_only>)
    change_count()
    fold([regions])
    fold(region)
    unfold([regions])
    encoding()
    set_encoding(encoding)
    line_endings()
    set_line_endings(line_endings)
    overwrite_status()
    set_overwrite_status(enabled)
    symbols(line_endings)
    show_popup_menus(items, on_done, <flags>)
sublime.Selection.
    clear()
    add(region)
    add_all(region_set)
    subtract(region)
    contains(region)
sublime.Region.
    Region(a, b)
    a
    b
    xpos
    begin()
    end()
    size()
    empty()
    cover(region)
    intersection(region)
    intersects(region)
    contains(region)
    contains(point)
sublime.Edit.
    (no methods)
sublime.Window.
    id()
    new_file()
    open_file(file_name, <flags>)
    find_open_file(file_name)
    active_view()
    active_view_in_group(group)
    views()
    views_in_group(group)
    num_groups()
    active_group()
    focus_group(group)
    focus_view(view)
    get_view_index(view)
    set_view_index(view, group, index)
    folders()
    project_file_name()
    project_data()
    set_project_data()
    run_command(string, <args>)
    show_quick_panel(items, on_done, <flags>, <selected_index>, <on_highlighted>)
    show_input_panel(caption, initial_text, on_done, on_change, on_cancel)
    create_output_panel(name)
    lookup_symbol_in_index(symbol)
    lookup_symbol_in_open_files(symbol)
    extract_variables()
sublime.Settings.
    get(name)
    get(name, default)
    set(name, value)
    erase(name)
    has(name)
    add_on_change(key, on_change)
    clear_on_change(key)

sublime_plugin.EventListener.
    on_new(view)
    on_new_async(view)
    on_clone(view)
    on_clone_async(view)
    on_load(view)
    on_pre_close(view)
    on_close(view)
    on_pre_save(view)
    on_pre_save_async(view)
    on_post_save(view)
    on_post_save_async(view)
    on_modified(view)
    on_modified_async(view)
    on_selection_modified(view)
    on_selection_modified_async(view)
    on_activated(view)
    on_activated_async(view)
    on_deactivated(view)
    on_deactivated_async(view)
    on_text_command(view, command_name, args)
    on_window_command(window, command_name, args)
    post_text_command(view, command_name, args)
    post_window_command(window, command_name, args)
    on_query_context(view, key, operator, operand, match_all)
sublime_plugin.ApplicationCommand.
    run(<args>)
    is_enabled(<args>)
    is_visible(<args>)
    is_checked(<args>)
    description(<args>)
sublime_plugin.WindowCommand
    run(<args>)
    is_enabled(<args>)
    is_visible(<args>)
    description(<args>)
sublime_plugin.TextCommand
    run(edit, <args>)
    is_enabled(<args>)
    is_visible(<args>)
    description(<args>)
    want_event()
```
