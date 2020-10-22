# 国内镜像
- https://mirror.tuna.tsinghua.edu.cn/help/homebrew/

# Repo

replace with Chinese repo:

```
# 中国科大:
cd "$(brew --repo)"
git remote set-url origin https://mirrors.ustc.edu.cn/brew.git
cd "$(brew --repo)/Library/Taps/homebrew/homebrew-core"
git remote set-url origin https://mirrors.ustc.edu.cn/homebrew-core.git
echo 'export HOMEBREW_BOTTLE_DOMAIN=https://mirrors.ustc.edu.cn/homebrew-bottles' >> ~/.bash_profile
source ~/.bash_profile
$ brew update

# 清华大学:
cd "$(brew --repo)"
git remote set-url origin https://mirrors.tuna.tsinghua.edu.cn/git/homebrew/brew.git
cd "$(brew --repo)/Library/Taps/homebrew/homebrew-core"
git remote set-url origin https://mirrors.tuna.tsinghua.edu.cn/git/homebrew/homebrew-core.git
echo 'export HOMEBREW_BOTTLE_DOMAIN=https://mirrors.tuna.tsinghua.edu.cn/homebrew-bottles' >> ~/.bash_profile
$ source ~/.bash_profile
$ brew update
```

阿里云

```
cd "$(brew --repo)"
git remote set-url origin https://mirrors.aliyun.com/homebrew/brew.git
cd "$(brew --repo)/Library/Taps/homebrew/homebrew-core"
git remote set-url origin https://mirrors.aliyun.com/homebrew/homebrew-core.git
echo 'export HOMEBREW_BOTTLE_DOMAIN=https://mirrors.aliyun.com/homebrew/homebrew-bottles' >> ~/.bash_profile
source ~/.bash_profile
```

诊断

```
# 诊断Homebrew的问题:
brew doctor

# 重置brew.git设置:
cd "$(brew --repo)"
git fetch
git reset --hard origin/master

# homebrew-core.git同理:
cd "$(brew --repo)/Library/Taps/homebrew/homebrew-core"
git fetch
git reset --hard origin/master

# 应用生效:
brew update
```

重置源

```
# 重置brew.git:
cd "$(brew --repo)"
git remote set-url origin https://github.com/Homebrew/brew.git

# 重置homebrew-core.git:
cd "$(brew --repo)/Library/Taps/homebrew/homebrew-core"
git remote set-url origin https://github.com/Homebrew/homebrew-core.git
```

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
- swich versions: `brew switch <pkg> <version>`

# Tricks
- switch between php56 and php@7.1

# Fixs

p: `brew doctor` gives `cannot load such file -- active_support/core_ext/object/blank (LoadError)`
f: run `brew update-reset`
