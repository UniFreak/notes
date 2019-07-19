# Referece

- <https://www.sublimetext.com/docs/3/>
- <https://sublime-text-unofficial-documentation.readthedocs.io/en/latest/>``
- <https://code.tutsplus.com/tutorials/how-to-create-a-sublime-text-2-plugin--net-22685>

# Basic

Package types

- plugins
- syntax highlighting definitions
- menus
- snippets

Package can be stored as

- zipped package: `.sublime-package` file
- loose package: unzipped within a directory (can overwrite zipped `.sublime-package`)

Can be stored in:

- `<executable_path>/Packages/` (`sublime.executable_path()`)for built-in zipped package
- `<data_path>/Installed Packages/` (`sublime.installed_packages_path()`) for zipped package installed by user
- `<data_path>/Packages/` (`sublime.packages_path()`)is for user loose packages

Package ordering comes into effect when merging files between packages

`Default` and `User.Default` is always ordered first, and `User` is always ordered last. Packages other than `Default` and `User` are ordered alphabetically.

To create new package, create a new directory under `<data_path>/Installed Packages/`

To override a file in an existing package, just create a file with the same name under the `Packages/<Package Name>/` directory

# Concepts

`token` (like `if` keyword) can be in multiple scope

`scopes` are named like `keywork.control.php`, and assigned to the text by the syntax

`color scheme` assigns colors and font styles to scopes

`theme` controls such elements as buttons select lists, the sidebar and tabs

`selectors` are means to match scope names

# Scopes

naming: see <https://macromates.com/manual/en/language_grammars#naming_conventions>

built-in:

- `comment.`
- `constant.`
- `entity.`
- `invalid.`
- `keyword.`
- `markup.`
- `meta.`
- `punctuation.`
- `source.`
- `storage.`
- `string.`
- `support.`
- `text.`
- `variable.`

# Selector

match sequence:

- hierachy: <selector> <selector>
- OR: <selector> | <selector>
- OR: <selector> , <selector>
- AND: <selector> & <selector>
- NOT: - <selector>
- grouping: (<selector> <ops> <selector>)

# Setting file

valid variable:
- `${pacakges}`
- `${platform}`

priority:
- `Packages/Default/Preferences.sublime-settings`
- `Packages/Default/Preferences (<platform>).sublime-settings`
- `Packages/User/Preferences.sublime-settings`
- `<Project Settings>`
- `Packages/<syntax>/<syntax>.sublime-settings`
- `Packages/User/<syntax>.sublime-settings`
- `<Buffer Specific Settings>`

# Key Bindings JSON

use `.sublime-keymap` json file

example:

```json
[
    {
        "keys": ["super+shift+9"], // required
        "command": "set_layout", // required
        "args": // args to command
        {
            "cols": [0.0, 0.33, 0.66, 1.0],
            "rows": [0.0, 0.33, 0.66, 1.0],
            "cells":
            [
                [0, 0, 1, 1], [1, 0, 2, 1], [2, 0, 3, 1],
                [0, 1, 1, 2], [1, 1, 2, 2], [2, 1, 3, 2],
                [0, 2, 1, 3], [1, 2, 2, 3], [2, 2, 3, 3]
            ]
        },
        "context": // restrict to a specific situation
        [
            {"key": "panel", "operand": "find"},
            {"key": "panel_has_focus"},
        ]
    },
]
```

# Color Scheme

use `.sublime-color-scheme` json file

example:

```json
{
    "name": "Example Color Scheme",
    "globals":
    {
        "background": "rgb(34, 34, 34)",
        "foreground": "#EEEEEE",
        "caret": "white"
    },
    "rules":
    [
        {
            "name": "Comment",
            "scope": "comment",
            "foreground": "#888888"
        },
        {
            "name": "String",
            "scope": "string",
            "foreground": "hsla(50, 100%, 50%, 1)"
        },
        {
            "name": "Number",
            "scope": "constant.numeric",
            "foreground": "#7F00FF",
            "font_style": "italic"
        }
    ]
}
```

# Themes

use `.sublime-theme` json file

example:

```json
[
    // Set up the textures for a button
    {
        "class": "button_control",
        "layer0.tint": [0, 0, 0],
        "layer0.opacity": 1.0,
        "layer1.texture": "Theme - Example/textures/button_background.png",
        "layer1.inner_margin": 4,
        "layer1.opacity": 1.0,
        "layer2.texture": "Theme - Example/textures/button_highlight.png",
        "layer2.inner_margin": 4,
        "layer2.opacity": 0.0,
        "content_margin": [4, 8, 4, 8]
    },
    // Show the highlight texture when the button is hovered
    {
        "class": "button_control",
        "attributes": ["hover"],
        "layer2.opacity": 1.0
    },
    // Basic text label style
    {
        "class": "label_control",
        "fg": [240, 240, 240],
        "font.bold": true
    },
    // Brighten labels contained in a button on hover
    {
        "class": "label_control",
        "parents": [{"class": "button_control", "attributes": ["hover"]}],
        "fg": [255, 255, 255]
    }
]
```

# Menu

use `.sublime-menu.` json file

availabel menus:

- Main.sublime-menu: Primary menu for the application
- Side Bar Mount Point.sublime-menu: Context menu for top-level folders in the side bar
- Side Bar.sublime-menu: Context menu for files and folders in the side bar
- Tab Context.sublime-menu: Context menu for file tabs
- Context.sublime-menu: Context menu for text areas
- Find in Files.sublime-menu: Menu shown when clicking the ... button in Find in Files panel
- Widget Context.sublime-menu: Context menu for text inputs in various panels

example:

```json
[
    {
        "caption": "File",
        "mnemonic": "F",
        "id": "file",
        "children":
        [
            { "command": "new_file", "caption": "New File", "mnemonic": "N" },

            { "command": "prompt_open_file", "caption": "Open File…", "mnemonic": "O", "platform": "!OSX" },
            { "command": "prompt_open_folder", "caption": "Open Folder…", "platform": "!OSX" },
            { "command": "prompt_open", "caption": "Open…", "platform": "OSX" }
        ]
    }
]
```


# Syntax Definition

use `sublime-syntax` YAML file or `.tmLanguage ` file

example:

```yaml
%YAML 1.2
---
name: C
file_extensions: [c, h]
scope: source.c

contexts:
  main:
    - match: \b(if|else|for|while)\b
      scope: keyword.control.c
```

# Plugin

lifecycle

1. importing: may not call any API functions except `sublime.version()`, `sublime.platform()`, `sublime.architecture()` and `sublime.channel()`
2. module level `plugin_loaded()`
3. module level `plugin_unloaded()`

Types

- python built-in
- `location(abs_path, rel_path, (row, col))`
- `point`: an int represent the offset from the beginning of the editor buffer
- `value`: any of the Python data types bool, int, float, str, list or dict
- `dip`: a float that represents a device-independent pixel
- `vector`: a tuple of (dip, dip) representing x and y coordinates
- `CommandInputHandler`: a subclass of either `TextInputHandler` or `ListInputHandler`

# Api

## Types

- `location`: a tuple of (str, str, (int, int)) that contains information about a location of a symbol. The first string is the absolute file path, the second is the file path relative to the project, the third element is a two-element tuple of the row and column.
- `point`: an int that represents the offset from the beginning of the editor buffer. The View methods text_point() and rowcol() allow converting to and from this format.
- `value`: any of the Python data types bool, int, float, str, list or dict.
- `dip`: a float that represents a device-independent pixel.
- `vector`: a tuple of (dip, dip) representing x and y coordinates.
- `CommandInputHandler`: a subclass of either TextInputHandler or ListInputHandler.

## sublime module

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
```

## sublime class

```
sublime.Sheet.
    id()
    window()
    view()
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
sublime.Phantom.
    Phantom()
sublime.PhantomSet.
    update()
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
```

## sublime_plugin module

```
sublime_plugin.
    (no method)
```

## sublime_plugin class

```
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
sublime_plugin.ViewEventListener
    is_applicable(settings)
    applies_to_primary_view_only()
sublime_plugin.ApplicationCommand.
    // do not have a reference to any specific window or file/buffer and are more rarely used
    run(<args>)
    is_enabled(<args>)
    is_visible(<args>)
    is_checked(<args>)
    description(<args>)
sublime_plugin.WindowCommand
    // provide references to the current window via a `Window` object
    run(<args>)
    is_enabled(<args>)
    is_visible(<args>)
    description(<args>)
sublime_plugin.TextCommand
    // provide access to the contents of the selected file/buffer via `View` object
    run(edit, <args>)
    is_enabled(<args>)
    is_visible(<args>)
    description(<args>)
    want_event()
sublime_plugin.TextInputHandler
    name()
    placeholder()
    initial_text()
    preview(text)
    validate(text)
    cancel()
    confirm(text)
    next_input(args)
    description(text)
sublime_plugin.ListInputHandler
    name()
    list_items()
    placeholder()
    initial_text()
    preview(value)
    validate(value)
    cancel()
    confirm(value)
    next_input(args)
    description(value, text)
```

# Workflow

## Referecne

- <https://forum.sublimetext.com/t/workflow-for-plugin-development-package-control-and-github/30156>

## Q&A:

- where is `Default`?

see <https://stackoverflow.com/questions/18709422/where-are-the-default-packages-in-sublime-text-3-on-ubuntu>

- Plugin vs Package?

A `plugin` is some code that extends the editor.  A `package` is a container that is used to distribute a plugin.  A package may contain more then just the actual plugin (for example a README, a theme, a syntax file, etc.)


## Guide line:

-  `Default` package acts as a good reference for figuring out how to do things and what is possible
- `Preferences > Key Bindings - Default` to see valid built-in commands
-  use `PackageResourceViewer`
- `User/` directory is protected from overwrites during upgrades, etc., and unless you're planning on creating a customized theme or color scheme for redistribution through Package Control, it's best practice to keep your files in there

## Step
0. Project structure
- git folder <Proj>
- ln -s <Proj> to <SublimeTestPackageDir>

1. Menu `new plugin...`
- use `self.view` to refer current view
- consider use `threadings` to prevent user interface from freezing

2. Save

- default to save into `Packages/Users/`, you may want to save rather into `Pacakges/<YourPkg>/`
- filename are not restricted to be the same with class name
- any subclass of `sublime_plugin` classes can be run as a command
- the created command is lowercase of the class name, say `ExampleCommand` --> `example`

3. in console, run `view.run_command('example')` to run the command

4. Key bindings

-  are usually OS-specific, means that three key bindings files will need to be created
-  file shoule be named as
    + `Default (Linux).sublime-keymap`
    + `Default (OSX).sublime-keymap`
    + `Default (Windows).sublime-keymap`
- ensure the key binding is not already used, use `Preferences > Key Bindings – Default` to find out
- try and test your keybindings out on a real keyboard

5. Menu

6. Distribute (via packagecontrol)

- host source in github
- fork channel file and edit it
- push merge request
- see <https://packagecontrol.io/docs>
