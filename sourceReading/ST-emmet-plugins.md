# Concepts

PyV8 + threading
    emmet-plugin.JSContext < PYV8.JSContext < _PyV8.JSContext_
        .locals: local variable within context
        .eval()
    loader

emmet-plugin.JSContext run these fileswhen init
    emmet-app.js: the real js emmet
    bootstrap.js: proxy to js emmet functionality for python

command run in context (.sublime-keymap), context decide run or not

TextCommand:
- CommandAsYouTypeBase
    run:
        - show panel for command, then process_panel_input and run_command
          which then call view.run_command to run `insert_snippet` TextCommand
          `insert_snippet` is a built-in command
        - or run_on_input
    panel_input?
-> WrapAsYouType -> ExpandsAsYouType && UpdateAsYouType

- RunEmmetAction
- ExpandAbbreviationByTab: trigger by tab
    do TabAndCompletionHandler.expand_by_tab()
        show html_elements_attributes, html_attributes_values generated completion list
        or run_action('expand_abbreviation')
    or run built-in insert_best_completion command


EventListner:
- ActionContextHandler: run action when
    1. context key starts with `emmet_action_enabled`
    2. action not disabled with `disable_keymap_action` setting
    ONLY RETURN TRUE, do NOTHING
- TabExpandHandler


action

snippets.json:
    snippets vs abbreviation
    extends
completion

caniuse: Can I Use

Subliem Text
    regions are accociated with key `__emmet__`

# Entrance

EventListner:
    ActionContextHandler()
    TabExpandHandler()
    on_query_context() + keymap

plugin_loaded() -> init

# Coodie

current caret position: `view.sel()[0].begin()`

decide source scope: `sublime.score_selector(cur_scope, 'source.css'):`

# Question

how `emmet.require()` works?

# TODO

dig on python threading
    Why and when
    Timer()
