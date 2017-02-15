# enviroment variables
- see all: `set`
- see one: `echo "$HOME"`
- set new: 
    + temporary: `export PATH=${PATH}:${HOME}/bin`
    + permanent: `vi ~/.bash_profile` & append `export PATH=${PATH}:${HOME}/bin`

# search for package
- apt-cache search <name>
- use http://packages.ubuntu.com/