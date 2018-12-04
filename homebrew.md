# Referece
- doc: https://docs.brew.sh/
- `man brew`
- `brew help`
- `brew commands`

# Other simily tools
- MacPorts(try it) 
    +`/opt/local`, 
    + independent of OSX built-in, safer
    + no longer slower
    + now using git(previously svn rsync)
- Fink
    +`/sw`
    + pre-built, faster
    + outdated and too few packages
- Homebrew 
    +`/usr/local`
    + depend on OSX built-in, faster
    + using git
    + up to date packages

# Concepts
- Formula: The package definition
- Keg: The installation prefix of a Formula
- Cellar: all Kegs are installed here
- Kegs-only:
    + formula is installed only into the Cellar
    + It is not linked into /usr/local
    + Most tools will not find it
    + Use `brew link` as needed
- Tap: A Git repository of Formulae and/or commands
- Bottle:  Pre-compiled versions for formula
- Cask: An extension of Homebrew to install macOS native apps
- Brew Bundle: An extension of Homebrew to describe dependencies
- `homebrew/core`

# Behavior
- Choose `usr/local`, it's easier and safe and "just work"
- By default, Homebrew does not uninstall old versions of a formula 
- We aim to bottle everything
- If you need to run Homebrew in a multi-user environment, consider creating a separate user account especially for use of Homebrew
- Homebrew installs to the Cellar and then symlinks some of the installation into `/usr/local` so that other programs can see what’s going on
- If you install common libraries like `libexpat` yourself into `user/local`, it may cause trouble when trying to build certain Homebrew formula. `brew doctor` will warn you that
- Better to install your own stuff to the Cellar and then `brew link` it

# Basic usage
- First update the formulae and Homebrew itself: `brew update`
- You can now find out what is outdated with: `brew outdated`
- Upgrade everything with: `brew upgrade`
- Or upgrade a specific formula with: `brew upgrade <formula>`
- To stop something from being updated/upgraded: `brew pin <formula>`
- To allow that formulae to update again: `brew unpin <formula>`
- Remove old versions of a formula: `brew cleanup <formula>`
- Or clean up everything at once: `brew cleanup`
- Or to see what would be cleaned up: `brew cleanup -n`
- See download directory: `brew --cache`
- Create formula: `brew create URL`
- Edit formula: `brew edit <formula>`, `brew update` will merge your changes so you keep your personal mods
- What happend to formula: `brew log <formula>`
- `brew ls`
- `brew search`

# Tricks
- switch between php56 and php@7.1