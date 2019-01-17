# package installation name:
- ps: procps
- ifconfig: net-tools

# enviroment variables
- see all: `set`
- see one: `echo "$HOME"`
- set new:
    + temporary: `export PATH=${PATH}:${HOME}/bin`
    + permanent: `vi ~/.bash_profile` & append `export PATH=${PATH}:${HOME}/bin`

# search for package
- apt-cache search <name>
- use http://packages.ubuntu.com/

# useful utils
- `tree`: output directory tree

# crontab expression
minute hour day(month) month day(week)

any: *
list: ,
range: -
step: /

# Coodie:
- find out whether port 80 is in use: `sudo lsof -i:80 | grep LISTEN`
