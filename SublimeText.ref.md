# See

- <https://www.sublimetext.com/docs/3/api_reference.html>
- <https://sublime-text-unofficial-documentation.readthedocs.io/en/latest/reference/reference.html>

# Settings

extension: `.sublime-settings`

## Global
- theme
- scroll_speed
- hot_exit
- remember_open_files
- open_files_in_new_window
- close_window_whem_empty
- show_full_path
- preview_on_click
- folder_exclude_patterns
- file_exclude_patterns
- binary_file_patterns
- show_tab_close_buttons
- mouse_wheel_switches_tabs
- ignored_packages

## File
- auto_indent
- smart_indent
- indent_to_bracket
- tab_size
- translate_tabs_to_spaces
- use_tab_stops
- trim_automatic_white_space
- detect_indentation
- draw_white_space
- trim_tailing_white_space_on_save
- tab_completion
- auto_complete
- auto_complete_size_limit
- auto_complete_delay
- auto_complete_selector
- auto_complete_triggers
- auto_complete_commit_on_tab
- auto_complete_with_fields
- auto_complete_cycle
- auto_close_tags
- shift_tab_unindent
- copy_with_empty_selection
- find_selected_text
- auto_find_in_selection
- drag_text

## Visual
- always_show_minimap_viewport
- color_scheme
- font_face
- font_size
- font_options: bold, italic, no_antialias, gray_antialias, subpixel_antialias, directwrite
- gutter
- line_numbers
- margin
- fold_buttons
- fade_fold_buttons
- rulers
- draw_minimap_border
- highlight_line
- line_padding_top, line_padding_bottom
- caret_style: smooth, phase, blink, solid
- caret_extra_top, caret_extra_bottom, caret_extra_width, caret_extra_end
- word_wrap
- wrap_width
- indent_subsequent_lines
- draw_centered
- match_brackets, match_brackets_content, match_brackets_square, match_brackets_braces, match_brackets_angle
- match_tags
- match_selection
- draw_indent_guides
- indent_guide_options: draw_normal, draw_active
- show_definitions
- tree_animation_enabled
- animation_enabled
- highlight_modified_tabs
- bold_folder_labels
- use_simple_full_screen
- gnu_window_buffer
- overlay_scroll_bar
- enable_tab_scrolling
- show_encoding
- show_line_endings
- remember_full_screen
- always_prompt_for_file_reload
- create_window_at_startup
- show_panel_on_build
- index_files
- index_workers
- index_exclude_patterns

## Automatic
- auto_match_enabled
- save_on_focus_lost
- word_seperators
- ensure_newline_at_eof_on_save

## System and Misc
- is_widget
- spell_check
- dictionary
- spelling_selector
- fallback_encoding
- default_encoding
- enable_hexadecimal_encoding
- default_line_ending

## Build and Error Navigation
- result_file_regex
- result_line_regex
- result_base_dir
- build_env

## File and Directory
- default_dir
- atomic_save

## Input
- command_mode
- move_to_limit_on_up_down


# Project

menu: `Project -> Edit Project`

config file
- `.sublime-project` contain project definition
- `.sublime-workspace` contain

Config Options
- folders
    + path
    + name
    + folder_exclude_patterns
    + folder_include_patterns
    + file_exclude_patterns
    + file_include_patterns
    + follow_symlinks
- settings
- build-systems

# Build System

file extension: `.build-system`

## Variables: only apply to cmd, shell_cmd and working_dir config option
- $file_path
- $file
- $file_name
- $file_extension
- $file_base_name
- $folder
- $project
- $project_path
- $project_name
- $project_extension
- $project_base_name
- $packages
- $platform

Variable Placeholder
- ${project_name:Default} : emit Default if $project_name is None
- ${file/\.php/\.txt} : replace .php with .txt

## Config Options

When build, default run Default package's `exec` command
You can use `target` option to override this.
If you do, you can add **any number of extra options** to `.sublime-build` file
The corresponding taget command will receive them as `**kwargs`

Meta
- target: should be a sublime.WindowCommand
- file_patterns
- keyfiles
- cancel
- selector
- window, osx, linux
- variants
    + name
    + cmd

`exec` target options
- cmd: array of command and arguments
- shell_cmd: string of command and arguments
- working_dir
- encoding
- env
- shell
- path
- file_regex
- line_regex
- syntax
- quite
- word_wrap

# Key Bindings

file: `.sublime-keymap`

## Config Options
- keys
- command
- args
- context
    + key
    + operator
    + operand
    + match_all

## Context

Key can be arbitary

built-in keys:
- auto_complete_visible
- has_next_field
- has_prev_field
- num_selections
- overlay_visible
- panel_visible
- following_text
- preceding_text
- selection_empty
- setting.x
- text
- selector
- panel_has_focus
- panel

Operators
- equal, not_equal
- regex_match, not_regex_match
- regex_contains, not_regex_contains

# Menu

file: `.sublime-menu`

availabel menus:

- Main.sublime-menu: Primary menu for the application
- Side Bar Mount Point.sublime-menu: Context menu for top-level folders in the side bar
- Side Bar.sublime-menu: Context menu for files and folders in the side bar
- Tab Context.sublime-menu: Context menu for file tabs
- Context.sublime-menu: Context menu for text areas
- Find in Files.sublime-menu: Menu shown when clicking the ... button in Find in Files panel
- Widget Context.sublime-menu: Context menu for text inputs in various panels

Config Options
- caption
- mnemonic
- command
- args
- children
- id
- platform

# Syntax Definition

file: `sublime-syntax` YAML file or `.tmLanguage `

top level structure:
- header
- contexts
- variables

## Header
- name
- file_extensions
- first_line_match
- scope
- hidden

## Contexts
Match patterns
- meta_scope
- meta_content_scope
- meta_include_prototype
- clear_scopes

Match patterns
- match
- scope
- captures
- push
- pop
- set
- embed
    + escape
    + embed_scope
    + escape_captures

Include patterns
- include

# Themes

file: `.sublime-theme`

theme is specified with `rules` and `variables`
each rule use class, attributes, settings, parents, platforms keys to match element
properties affects the look and behavior of elements

all rules are tested, in order, against each element
textures in a theme are specified using PNG images
unit specified with dip
padding and margin specified with a integer, an array of two int or an array of four int

Topmost level
- variables
- ruls

## Attributes

All
- hover

Luminosity
- file_light: V from 0.60-1.00
- file_medium: V from 0.30-0.59
- file_medium_dark: V from 0.10-0.29
- file_dark: V from 0.00-0.09

## Properties

Common
- layer0.*
- layer1.*
- layer2.*
- layer3.*
- hit_test_level

Layer
- layer#.tint
- layer#.texture
- layer#.inner_margin
- layer#.draw_center
- layer#.repeat

Value Animation
- target
- speed
- interpolation

Texture Animation
- keyframes
- loop
- frame_time

Texture Tinting
- tint_index
- tint_modifier

Font
- font.face
- font.size
- font.bold
- font.italic

Shadow
- shadow_color
- shadow_offset

Filter Label
- fg
- match_fg
- bg
- selected_fg
- selected_match_fg
- font.size

Data Label
- dark_content
- row_padding

Styled Label
- border_color
- background_color

## Elements

Different elements support different set of attributes and properties

Windows
- title_bar
- window
- edit_window
- switch_project_window

Side Bar
- sidebar_container
- sidebar_tree
- tree_row
- sidebar_heading
- file_system_entr
- sidebar_label
- close_button
- disclosure_button_control
- icon_folder
- icon_folder_loading
- icon_folder_dup
- icon_folder_type
- vcs_status_badge

Tabs
- tabset_control
- tab_control
- tab_label
- tab_close_button
- scroll_tab_left_butoon
- scroll_tab_right_butoon
- show_tabs_dropdown_button

Quick Panel
- overlay_control
- quick_panel
- mini_quick_panel_row
- quick_panel_row
- quick_panel_label
- quick_panel_path_label

Views
Panels
Status Bar
Dialogs
Scroll Bars
Inputs
Buttons
Labels
Tool Tips

# Color Scheme

file: `.sublime-color-scheme`

Color can be specified in these formats
- Hex RGB
- Hex RGBA
- RGB functional notation
- RGBA functional notation
- HSL functional notation
- HSLA functional notation
- Named: CSS color names

Color also can be specified as variable and referenced with `var()` combined with adjusters:
- blend()
- blenda()
- alpha()
- saturation()
- lightness()

Top level structure
- name
- globals
- rules
- variables

## Config Options

Global
- background
- foreground
- invisibles
- caret
- block_caret
- line_highlight

Accents
- misspelling
- fold_marker
- minimap_border
- accent

CSS
- popup_css
- phantom_css

Gutter
- gutter
- gutter_foreground

Diff
- line_diff_width
- line_diff_added
- line_diff_modified
- line_diff_deleted

Selection
- selection
- selection_foreground
- selection_border
- selection_border_width
- inactive_selection
- inactive_selection_foreground
- selection_corner_style
- selection_corner_radius

Find
- highlight
- find_highlight
- find_highlight_foreground

Guide
- guide
- active_guide
- stack_guide

Brackets
- brackets_options
- brackets_foreground
- bracket_contents_options
- bracket_contents_foreground

Tags
- tags_options
- tags_foreground

Shadows
- shadow
- shadow_width

## Scope Rules

## Customization

# Completions

file: `.sublime-completions`

Config options
- scope
- completions
    + trigger
    + contents: see snippets


# Metadata File

Metadata are parameters that can be assigned to certain text sections using scope selectors

file: `.tmPrefereces` XML, use Property List format

Top level structure

```xml
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE plist PUBLIC "-//Apple//DTD PLIST 1.0//EN" "http://www.apple.com/DTDs/PropertyList-1.0.dtd">
<plist version="1.0">
<dict>
   ...
</dict>
</plist>
```

Topmost Keys
- name
- scope
- settings
- uuid

## Setting Keya

Indentation
- increaseIndentPattern
- decreaseIndentPattern
- bracketIndentNextLinePattern
- disableIndentNextLinePattern
- unIndentedLinePattern

Completion
- cancelCompletion

Symbol
- showInSymbolList
- showInIndexedSymbolList
- symbolTransformation
- symbolIndexTransformation

Shell
- shellVariables
    + name
    + value

## Marker
- TM_COMMENT_START, TM_COMMENT_START_2, TM_COMMENT_START_3...
- TM_COMMENT_END, TM_COMMENT_END_2, TM_COMMENT_END_3...
- TM_COMMENT_DISABLE_INDENT

# Command Palette

file `.sublime-commands`

Config Option
- caption
- command
- args

# Built-in Commands

see <https://www.sublimetext.com/docs/commands>, NOT complete!

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
sublime.CLASS.
    sublime.CLASS_WORD_START
    sublime.CLASS_WORD_END
    sublime.CLASS_PUNCTUATION_START
    sublime.CLASS_PUNCTUATION_END
    sublime.CLASS_SUB_WORD_START
    sublime.CLASS_SUB_WORD_END
    sublime.CLASS_LINE_START
    sublime.CLASS_LINE_END
    sublime.CLASS_EMPTY_LINE
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
    match_selector(point, selector)
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
    set_layout(layout)
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
    on_query_completions(view, prefix, location)
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