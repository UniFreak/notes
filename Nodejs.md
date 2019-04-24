# Refs
- handbook on node: <https://github.com/maxogden/art-of-node>
- handbook on stream: <https://github.com/substack/stream-handbook>
- online tuts: <https://nodeschool.io/>
- interactive offline tuts: <https://github.com/workshopper/learnyounode>
- style guide: <https://github.com/felixge/node-style-guide>

# What

Designed for solving I/O problems and it doesn't know much about 'business logic'

A I/O platform that you are encouraged to build modules on top of

Use Non-blocking I/O

Handles I/O with: callbacks, events, streams and modules

# Callbacks

Are just functions that get executed at some later time

Node uses mostly asynchronous code, requires you to think non-linearly

# Events

Aka observer pattern or pub/sub

Callbacks are a one-to-one relationship between the thing waiting for the callback and the thing calling the callback

Events are the same exact pattern except with a many-to-many API

# Stream

API made the same for the network and file system

# Modules

Core modules and npm modules