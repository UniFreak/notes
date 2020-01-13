# See

- <https://www.sublimetext.com/docs/3/>
- <https://sublime-text-unofficial-documentation.readthedocs.io/en/latest/>
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

`scopes` are named like `keyword.control.php`, and assigned to the text by the syntax

`color scheme` assigns colors and font styles to scopes

`theme` controls such elements as buttons select lists, the sidebar and tabs

`selectors` are means to match scope names

key binding
    `context`

sublime contain window contain sheet
sheet ie tab contain view or image preview
view has a underlying buffer
    scratch buffer are never reported as dirty (has unsaved modifications)
    private setting
    viewport (5, 5): 5 is pixel, means current viewable portion offset of buffer
    edit exist to group buffer modification

abc

# 2 vs 3

2 use python 2.6, 3 use python 3.3

3: plugin run in `plugin_host` separate process

3: all top-level statements in your module must not call any functions from the sublime module

# Scope Nameing

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

# MiniHtml

see <https://www.sublimetext.com/docs/3/minihtml.html>

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

# Workflow

See: <https://forum.sublimetext.com/t/workflow-for-plugin-development-package-control-and-github/30156>

## Q&A:

- where is `Default`?

see <https://stackoverflow.com/questions/18709422/where-are-the-default-packages-in-sublime-text-3-on-ubuntu>

You can extract it with `PackageResourceViewer` package

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

# Notes

if a setting isn’t loading after creating a new setting file, restart Sublime

