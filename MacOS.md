# Code names For OSX
OS X 10.5 Leopard (Chablis)
OS X 10.6 Snow Leopard
OS X 10.7 Lion (Barolo)
OS X 10.8 Mountain Lion (Zinfandel)
OS X 10.9 Mavericks (Cabernet)
OS X 10.10: Yosemite (Syrah)
OS X 10.11: El Capitan (Gala)
macOS 10.12: Sierra (Fuji)
macOS 10.13: High Sierra (Lobo)
macOS 10.14: Mojave (Liberty)

# Dev Life

## Things break after system upgrade:

```sh
sudo rm -rf /Library/Developer/CommandLineTools
sudo xcode-select --install
```

## Upgrading Bash to version 4

```sh
$ brew install bash
$ sudo bash -c 'echo /usr/local/bin/bash >> /etc/shells'
$ chsh -s /usr/local/bin/bash 
```

and make shell script start with `#!/usr/bin/env bash`

## Install GNU `find`

```sh
$ brew install findutils
# add path into ~/.bash_profile
PATH=$(brew --prefix)/opt/findutils/libexec/gnubin:$PATH
```
