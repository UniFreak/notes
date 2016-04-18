==================== Mappings =========================

Browsing
========

Ignoring
--------------
<S-Esc>|<Insert>temporarily ignore all vimperator key bindings
i				ignore next key and send it directly to the webpage

Opening
----------
o				open one or more URLs
O				open one or more URLs, based on current location
t				open one or more URLs in a new tab
T				open one or more URLs in a new tab, based on current location
w				open one or more URLs in a new window
W				open one or more URLs in a new window, based on current location
p				open (put) a URL based on the current clipboard contents in the current buffer
P				open (put) a URL based on the current clipboard contents in a new buffer
gP				open (put) a URL based on the current clipboard contents in a new buffer(without activate)
[count]<C-a>	increment last number in URL by 1/{count}
[count]<C-x>	decrement last number in URL by 1/{count}
~				open home directory

Scrolling
---------
[count]j		scroll document lines down [count] times
[count]k		scroll document lines up [count] times
[count]h		scroll document to the left [count] times
[count]l		scroll dcoument to the right [count] times
[count]<C-b>	scroll up(back) a full page [count] times
[count]<C-f>	scroll down(forward) a full page [count] times
[count]<C-d>	scroll down half a page [count] times
[count]<C-u>	scroll up half a page [count] times
0				scroll to the absolute left of the document
$				scroll to the absolute right of the document
[count]gg		go to the [count%] top of the documenet
[count]G		go to the [count%] end of the document
{count}%		scroll to {count} percent of the document


Stopping
--------
<C-c>			stop loading the current web page

Navigating
----------
<C-o>			go to an older position in the jump list
<C-i>			go to a newer position in the jump list
gh				open home page in current tab
gH				open homepage in a new tab
gt				go to the next tab
gT				go to the previous tab
g$				go to the last tab
g0				go to the first tab
[couont]gu		go to {count}th parent directory in URL
d				delete current tab and select the tab to the right
D				delete current buffer and select the tab to the left

Jumping
-------
Tab				advance keyboard focus
<S-Tab>			rewind keyboard focus
[count]gi		focus last|[count]th input field
[count]]f		focus next [count] frame
[count][f		focus previous [count] frame
[count]]]		follow the link labeled 'next' or '>' if it exists [count] times
[count][[		follow the link labeled 'prev', 'previous' or '<' if it exists [count] times

Zooming
-------
[count]zI		enlarge full zoom of current web page
[count]zM		enlarge full zoom of current web page even more
[count]zO		reduce full zoom of current web page
[count]zR		reduce full zoom of current web page even more
[count]zZ		set full zoom value of current web page
[count]zi		enlarge text zoom of current web page
[count]zm		enlarge text zoom of current page even more
[count]zo		reduce text zoom of current web page
[count]zr		reduce text zoom of current web page even more
[count]zz		set text zoom value of current web page

Copying
-------
y				yank current location to the clipboard
Y				copy selected text or current word

Reloading
---------
r				force reload current web page
R				force reload current web page while skipping the cache

Quitting
--------
ZQ				quit and don't save the session
ZZ				quit and save the session

Page-info
-----------
<C-g>/g<C-g>	print the current file infomation
gf				view source
gF				view source with an external editor


Command-line mode
=================
:					enter command line mode
/					search forward for a pattern
?					search backward for a pattern
<C-c>				exit Command-line mode without executing current command
<C-]>				extend Command-line mode abbreviation
<Up>				last command in current history
<Down>				next command in current history
<S-Up>|<PageUp>		last command in history
<S-Down>|<PageDown>	next command in history		

Insert mode
===========
i				start Insert mode
<C-i>			call external editor
<C-]>			extend Insert mode abbreviation

Options
=======
set						list all modified options
set all					list all options
set {option}?			display {option} value
set {option} [...]		set {option} value if {option} is boolean options, else diaplay {option} value
set no{option}	[...]	reset {option} if {option} is boolean options, else close {option}
set inv{option} [...]	revert boolean {option}
set {option}!={value} [...]
						change {option} value to !{value}
set {option}& [...]		reset {option} to default
set all&				reset all option to default
set {option}={value} [...]
						set {option}'s value to {value}
set {option}+={value} [...]
						increment {option}'s value by {value}
@unfinished

Text-search
===========
n				find next
N				find previous
*				find word under cursor
#				find word under cursor backwards




'				jump to the mark in the current buffer
.				repeat the last key event
;				start an extended hind mode@?
<C-S-N>			switch to next tab group
<C-S-P>			switch to prev tab group
<C-^>			select the alternate tab or the [count]th tab
<C-n>			go to the next tab
Esc				focus content
F1				open the help page
@				play a macro
@:				repeat the last Ex command
A				toggle bookmarked state of current URL
B				show buffer list
F				start QuickHind mode, but open link in a new tab
H				go back in the browser history
I				open an :ignorekeys prompt for the current domain or URL
L				go forward in the browser history
M				add new QuickMark for current URL
a				open a prompt to bookmark the current URL
b				open a prompt to switch buffers
c				start Caret mode
f				start QuickHint mode
g<lt>			redisplay the last command output
g@				go to an AppTab
gB				repeat last :buffer[!] command in reverse direction
gU				go to the root of the website
gb				repeat last :buffer[!] command
gn				jump to a QuickMark in a new tab
go				jump to a QuickMark
m				set mark at the cursor position
q				record a key sequence into a macro
u				undo closing of a tab

=================== Commands ===============================
GUI
---
emenu			execute the specified menu item from the command line
addons			manage available extensions and themes
dialog			open a Vimperator dialog
	about
	addbookmark
	addons
	bookmarks
	checkupdates
	cleardata
	cookies
	console
	customizetoolbar
	dominspector
	downloads
	history
	import
	openfile
	pageinfo
	pagesource
	places
	preferences
	printpreview
	printsetup
	print
	saveframe
	savepage
	searchengines
	selectionsource
downloads					show progress of current downloads
extensions					list all extensions
extadd {file}				install an extension
extdelete {extension}|!		uninstall an|all extension
extdisable {extension}|!	disable an|all extension
extenable {extension}|!		enable an|all extension
extoptions {extension}|!	open an extension's preference dialog
sbclose						close the sidebar window
sidebar {name}				open the sidebar window
	
Browsing
========

Opening
-------
open 			open one or more URLs in the current tab
tabopen			open one or more URLs in a new tab
tabduplicate	duplicate current tab
winopen			open one or more URLs in a new window

Navigating
----------
[count]back [url|!]				go back to {count}|{url}|{first} page in the browser history
[couont]forward [url|!]			go forward to {count}|{url}|{last} page in the browser history
jumps							show history jumplist

Stopping
--------
stop			stop loading the current web page
stopall			stop loading all tab pages

Quitting
--------
quit			quit current tab
quitall/qall	quit vimperator
winclose		close window
winonly			close all other windows
wqall/xall		save the session and quit

Saving
------
saveas			save current document to disk

Reloading
---------
reload[!]		reload the current web page[while ignoring cache]
reloadall[!]	reload all tab pages[while ignoring cache]

Directory
-----------
cd [-|path]		change the current directory to last visited|{path}
pwd				print the current directory name

Page-info
-----------
pageinfo			print current file infomation
viewsource[!|URL]	view {URL} source [in external editor]

Zooming
-------
zoom[!] [value]				set zoom value of current page|text(?!) to [value]
zoom[!] +{value}|-{value}	increase|decrease current page|text(?!) zoom value by {value}

Frames
------
frameonly		show only the current frame's page

Stylesheets
-----------
pagestyle [stylesheet]	select the default|[stylesheet] style sheet to apply

Text-search
-----------
nohlsearch		remove the search highlighting


autocmd			execute commands automatically on events
bdelete			delete current buffer
beep			play a system beep
bmark			add a bookmark
bmarks			list or open multiple bookmarks
buffer			switch to a buffer
buffers			show a list of all buffers
cabbrev			abbreviate a key sequence in command line mode
cabclear		remove all abbreviations in command line mode
!				run a command
abbreviate		abbreviate a key sequence
abclear			remove all abbreviations
cmap			map a key sequence in command line mode
cmapclear		remove all mapping in command line mode
cnoremap		map a key sequence without remapping keys in command line mode
colorscheme		load a color scheme
comclear		delete all user-defined commands
command			list and define commands
cunabbrev		remove an abbreviation in commands line mode
cunmap			remove a mapping in command line mode
delbmarks		delete a bookmark
delcommand		delete the specified user-defined command
delmacros		delete macros
delmarks		delete the specified marks
delqmarks		delete the specified QuickMarks
delstyle		remove a user style sheet
doautoall		apply the autocommands matching the specified URL pattern to all buffers
doautocmd		apply the autocommands matching the specified URL pattern to the current buffers
echo			echo the expression
echoerr			echo the expression as an error message
echomsg			echo the expression as an informationalmessage
execute			execute the argument as an Ex command
finish			stop sourcing a script file
hardcopy		print current document
help			open the help page
helpall			open the single unchunked help page
highlight		set the style of certain display elements
history			show recently vistied URLs
iabbrev			abbreviate a key sequence in insert mode
iabclear		remove all abbreviations in insert mode
ignorekeys		ignore all (or most) vimperator keys for certain URLs
imap			map a key sequence in insert mode
imapclear		remove all mappings in insert mode
inoremap		map a key sequence without remapping keys in insert mode
iunabbrev		remove an abbreviation in insert mode
iunmap			remove a mapping in insert mode
javascript		run a javascript command throught eval()
keepalt			execute a command without changing the current alternate buffer
let				set or list a variable
loadplugins		load all plugins immediately
macros			list all macros
map				map a key sequence
mapclear		remove all mapping
mark			mark current location within the web page
marks			show all location marks of current web page
messages		display previous given messages
messclear		clear the :messages list
mkvimperatorrc 	write current key mappings and changed options to the config file
nmap			map a key sequence in normal mode
nmapclear		remove all mapping in normal mode
nnoremap		map a key sequence without remapping keys in normal mode
noremap			map a key sequence without remapping keys
normal			execute normal mode commands
nunmap			remove a mapping in normal mode
play			replay a recorded macro
preferences		show firefox preferences
qmark			show all QuickMarks
scriptnames		list all sourced script names
setglobal		set global option
setlocal		set local option
silent			run a command silently
source			read Ex commands from a file
style			add or list user styles
styledisable	disable a user style sheet
styleenable		enable a user style sheet
styletoggle		toggle a user style sheet
tab				execute a command and tell it to output in a new tab
tabattach		attach the current tab to another window
tabdetach		detach current tab to its own window
tabdo			execute a command in each tab
tabgroups		manage tab groups
tablast			switch to the last tab
tabmove			move the current tab after tab N
tabnext			switch to the next or [count]th tab
tabonly			close all other tabs
tabprevious		switch to the previous tab or go [count] tabs back
tabrewind		switch to the first tab
time			profile a piece of code or run a command multiple times
unabbreviate	remove an abbreviation
undo			undo closing of a tab
undoall			undo closing of all closed tabs
unlet			delete a variable
unmap			remove a mapping
usage			list all commands, mapping and options with a short description
verbose			execute a command with 'verbose' set
version			show version information
vmap			map a key sequence in visual mode
vmapclear		remove all mapping in visual mode
vnorempa		map a key sequence without remapping keys in visual mode
vunmap			remove a mapping in visual mode
window			execute a command and tell it to output in a new window
restart			force Vimperator to restart
runtime			source the specified file from each directory in 'runtimepath'
sanitize		clear private data


Options
=======
activate			define when tabs are automatically activated
animations			enabled animation
apptab				pin the current tab as app tab
autocomplete		automatically list completions while typing
cdpath				list of directories searched when executing :cd
complete			items shich are completed at the :open prompts
defsearch			set the default search engine
editor				set the external text editor
encoding 			sets the current buffer's character encoding
errorbells			ring the bell when an error message is displayed
eventignore			list of autocommand event names which should be ignored
exrc				allow reading of an RC file in the current directory
extendedhinttags	XPath string of hintable elements activated by ';'
fileencoding		sets the character encoding of read and written files
focuscontent		try to stay in normal mode after loading a web page
followhints			change the behaviour of <Return> in hint mode
fullscreen			show the current window fullscreen
helpfile			name of the main help file
hintchars			what characters to user for labeling hints
hintinputs			how text input fields are hinted
hintmatching		how links are matched
hinttags			XPath string of hintable elements activated by 'f' and 'F'
hinttimeout			timeout before automatically following a non-unique numerical hint
history				number of Ex commands and search patterns to store in the command-line this._history
hlsearch			highlight previous search pattern matches
ignorecase			ignore case in search patterns
incsearch			show where the search pattern matches as it is typed
insertmode			use insert mode as the default for text areas
inspectcontentobjects
					allow completion of javascript objects coming from web content. POSSIBLY INSCURE!
linksearch			limit the search to hyperlink text
loadplugins			load plugin scripts when starting up
maxitems			number of messages to store in the message this._history
messagetimeout		automatically hide messages after a timeout (in ms)
newtab				define which commands should output in a new tab by default
nextpattern			patterns to use when guessing the 'next' page in a document sequence
online				set the 'work offline' option
pageinfo			desired info in the :pageinfo output
popups				where to show requested popup windows
previouspattern		patterns to use when guessing the 'previous' page in a document sequence
runtimepath			list of directories searched for runtime files
sanitizeitems		the default list of private items to sanitize
sanitizetimespan	the default sanitize time span
scroll				number of lines to scroll with <C-u> and <C-d> commands
scrollbars			show scrollbars in the content window when needed
shell				shell to use for executing :! and :run commands
shellcmdflag		flag passed to shell when executing :! and :run commands
showstatuslinks		show the destination of the link under the cursor in the status bar
smallicons			show small or normal size icons in the main toolbar
smartcase			override the 'ignorecase' option if the pattern contains uppercase characters
status				define which information to show in the status bar
suggestengines		engine alias which has a feture of suggest
tabnumbers 			show small numbers at each tab to allow quicker selection
titlestring			change the title of the window
tootlbars			show or hide toolbars
urlseparator		set the separator regex used to separate multiple URL args
usermode			show current website with a minimal style sheet to make it easily accessible
verbose				define which info messages are displayed
visualbell			use visual bell instead of beeping on errors
wildmode			define how command line completion works
wordseparators		how words are split for hintmatching
yankencodedurl		set the yank mode copying encoded URL
