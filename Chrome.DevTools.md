# Shortcuts
ctrl+shift+F            search
ctrl+p                  switch sources file

# Source
concept
	step in: if you are interested in this function and whatever functions this functions calls
	step over: if you are only interested in this function, but none external functions
	step out: if you are no longer interested in this function

ctrl+shift+o: jump between function definitions

# Network
concept
	time: total duration, from the start of the request to the receipt of the final byte in the response
	latency(time to first byte|TTFB): to load the first byte in the response
	`domContentLoaded` event: engine has completed parsing of the main document
	`load` event: all the page's resources retrieved
	HAR(HTTP Archive) file: contains a JSON data structure that describes the network "waterfall"

available filter type(filter format: <filter type>:<value>)
	domain
	has-response-header
	is
	larger-than
	method
	mime-type
	scheme
	set-cookie-name
	set-cookie-value
	set-cookie-domain
	status-code

# Timeline
concept
	three section: overview section at the top, a records view, and a toolbar
	four basic records groups: Loading, Scripting, Rendering, and Painting

	events mode: shows all recorded events by event category
	frames mode: shows your page's rendering performance
	memory mode: shows your page's memory usage over time

	painting is a two-step process that includes: draw calls and rasterization
		draw calls
			a list of things you'd like to draw
		rasterization
			the process of stepping through those draw calls and filling out actual pixels into buffers that can be uploaded to the GPU for compositing
usage
	zoom in zoom out use mouse middle key



in Elements, hit `h` after select a element will hide this element
in Elements->Style, shift+click color can change color representation
in Elements->Computed, the value is editable
you can find what event handler is registered by click that element node and inspect EventListener
in Elements->Style, ctrl+click a css value will take you direct to where it be defined
in Source->Source, select a word and ctrl+d to select the same next word(just like in sublime text)
in Source->Source, ctrl+p to bring up the script file switcher(just like in sublime text)
in Source->Source, right click the source file name, select `local modifications`, you can see all the history changes
in Soruce, you can click `{}` in left bottom to format a minified script
if you are in a server enviroment, you can right click in the Source->Source, and `add folder to workspace`, then map server file to local file. this way, changes will be instant viewable
there is multiple ways you can find where the js code is modifiying the page
	in Elements, right click element and choose `break on`
	set break point by click on the line number, or using the right panel's `DOM Breakpoints`, `XHR Breakpoints` and `Event Listener Breakpoints`
you can trace a script by using console.trace(), and `watch Expression` in the right panel of Script
`Call Stack` and `Scope Variable` help you understand how the script run and what state it's currently in
`Script->Snippets` works just like in sublime, you can find useful snippets here: github.com/bgrins/devtools-snippets
`ctrl+enter` in script to run it
in Timeline, `ctrl+e` to start/stop a recording

# Profile

# Audit

# Rendering

# Emulation

# Search
ctrl+shift+f to open

# Console API
console.log()
console.dir()
console.info()
console.warn()
console.error()
console.group()
console.groupEnd()
console.profile()
console.time()
console.timeEnd()
console.trace()
console.table()
debug()
monitor()

# Command API
$0
$()
$_
inspect()
getEventListeners()
keys()
monitorEvents()

Object.observe()
Object.defineProperty()
debugger