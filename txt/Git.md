# Concept

- git track changes, not files
- staged files are files we have told git that are ready to be committed
if you want commit changes, you must firstly add the changes to stage using `add`
- `HEAD` point to current branch pointer
- and current branch pointer(like `master`, `dev`) point to newest commit
- creating branch or merge two branch is only a thing of modifing branch pointers, so it's blazing fast
- `tag` is like a unmovable branch pointer
- when developers are working on a feature or bug they'll often create a copy (aka. branch)
- a commit in a git repository records a snapshot of all the files in your directory, specify this commit by its hash
- branches in git are incredibly lightweight as well. They are simply references to a specific commit, a branch essentially says "I want to include the work of this commit and all parent commits."
- merging in git creates a special commit that has two unique parents.
- rebasing essentially takes a set of commits, "copies" them, and plops them down somewhere else
- `HEAD` is the symbolic name for the currently checked out commit -- it's essentially what commit you're working on top of
- you can't push to the checked-out branch of a non-bare repo, hence the existence of bare repo
- author v.s commiter
    + author 指的是实际作出修改的人
    + commiter 指的是最后将工作成果提交到仓库的人
- git status flow

|Area       |working directory|staging area|repository(.git)|
|-----------|-----------------|------------|----------------|
|file status|modified         |staged      |committed       |

- 撤消/重做
    + 最后一次提交: `git commit --amend` (不要在你最后一次提交被推送后还去修改它)
    + 最后 n 次提交: `git rebase -i HEAD~<n>` (利用此也可以删除, 压制, 拆分提交)
    + 已经暂存的文件: `git reset HEAD <fileName>`
    + 对文件的修改: `git checkout -- <fileNam>`
    + 大面积分支修改: `git filter-branch`

- 远程仓库可用种协议
    - 本地: /opt/git/project.git
    - SSH: ssh://uer@server:project.git
    - git: git://
    - HTTP(S): http://localhost/project.git

- pull ≈ fetch + merge
- `blob` 对象: 表示文件快照内容
- `tree` 对象: 记录目录树内容及其中各个文件对应 `blob` 对象索引
- `commit` 对象: 包含指向 `tree` 对象和零个或多个上个 `commit` 对象的索引, 和其他提交信息元数据
- `tag` 有两种: lightweight, annotated
- `branch`: 本质上仅仅是个指向 `commit` 对象的可变指针. 有本地和远程之分, 远程分支用 `远程仓库名/分支名` 表示
- `HEAD`: 指向当前分支的特殊指针(可以理解为当前分支的别名)
- `reflog`: 记录这几个月 `HEAD` 和分支引用的日志. 这些日志只存在于本地
`commit` 对象的几种引用方式
    + 简短 SHA, 如 `ca82a6d`
    + 使用祖先引用, 如 `ca82a6d^^`, 或 `ca82a6d~2`, 或混合使用
    + 直接使用分支名, 如 `topic1`
    + 使用 `reflog` 产生的记录, 如 `HEAD@{0}`
    + 使用类似 `master@{yesterday}`
    + 使用 `A..B`: 指定在 B 分支但不在 A 分支中的 `commit` 对象, 等同于 `^refA refB` 和 `refB --not refA`
    + 使用 `A...B`: 指定在 A 分支亦或在 B 分支中的 `commit` 对象(配合 log 的 --left-right 选项更有效)
- 合并分支时可能遇到三种情况
    + fast foward: 分支指针只要右移就能完成分支合并
    + 无冲突合并: git 自行进行三方合并运算
    + 冲突合并
- 分支衍合(假设在 B 分支中衍合 A 分支:git rebase A)
    1. git 会回到两个分支最近的共同祖先, 根据当前分支后续的历次提交对象生成一系列文件补丁
    2. 一 A 最后一个提交对象为出发点, 逐个应用之前准备好的补丁
    3. 生成新的提交对象, 从而改写 B 的提交历史, 使它成为 A 分支的直接下游
    衍合一般用于想要得到一个能在远程分支上干净应用的补丁
衍合与合并
    衍合是按照每行的修改次序重演一遍修改, 而合并是把最终结果合在一起
    一旦分支中的提交对象发布到公共仓库, 就千万不要对该分支进行衍合操作
挑拣(cherry-pick)
    只选取特定的提交对象进行衍合

toSolve
    !!ssh won't work => because I cloned git repo not using ssh protocal!!

# Version code/Commit Id
<something like: cb926e7ea50ad11b8f9e909c05226233bf755030>
HEAD        current version
HEAD^       last version
HEAD^^  last two version
<and so on...>
HEAD~100    last 100 version

# Installation
Install using pacakge manager
    a. yum install git-core
    b. apt-get install git

Install from source
    1. wget -O git-2.2.0.tar.gz https://codeload.github.com/git/git/tar.gz/v2.2.0
    2. tar -xzf git-2.2.0.tar.gz
    3. cd git-2.2.0
    4. make configure
    5. ./configure --prefix=$HOME/git
    6. make prefix=$HOME/git
    7. make install
    8. edit ~/.bash_profile, add $HOME/git/bin & $HOME/git/libexec/git-core to $PATH
    9. relogin and git anywhere

# Configuration
file location
    /etc/gitconfig          `git config --system` will write this file
    ~/.gitconfig            `git config --global` will write this file
    <wd>/.git/config        `git config` will write this file
    <wd>/.gitattributes | <wd>/.git/info/attributes

use .gitignore to add ignore list like
    System auto generated file(Thumb.db, ethumbs.db, Desktop.ini ...)
    Script auto generated file(*.py, *.so, *.egg, *.tmp, dist ...)
    Other needn't to be tracked file(images, passwords ...)

conf field
    客户端 git config:
    core.editor
    core.pager
    core.excludefile
    core.autocrlf
    core.whitespace
    commit.template
    user.signingkey
    help.autocorrect
    color.ui
    color.branch
    color.diff
    color.interactive
    color.status

    服务器端 git config:
    receive.fsckObjects
    receive.denyNonFastForwards
    receive.denyDeletes

    git attributes:

# Commands
git config
    --system
    --global
    --list
git help <verb>
git <verb> --help

git init
    --bare
    --shared
git clone
    --bare
git add <file>
    -i
    -p
git rm
    -f
    -cached
git mv
git status
git diff
    --cached|staged
git commit
    -v
    -a
    -m
    --amend
git log
    -p
    --stat
    --shortstat
    --name-only
    --name-status
    --abbrev-commit
    --relative-date
    --left-right
    --pretty=[oneline|short|full|fuller|format:<format>]
        format placeholder: %H  %h  %T  %t  %P  %p  %an %ae %ad %ar %cn %ce %cd %cr %s
    --graph

    -<num>
    --since
    --until
    --author
    --grep
    --committer
    --path
    --not

    --all-match
    --no-merges
git show
git rev-parse
git reset
    --hard <versionCode>
    HEAD <filename>
git checkout -- <filename>
git reflog

git remote
    show
    rename
    remove
    -v
    --add <name> <repoURL>
git fetch
git merge
git pull
git push
    --tags

git tag
    -a  <annotedTagName> [<commitHash>]
    -s
    -v
    -m
    -l
git describe
git archive
    --prefix
    --format
git shortlog
    --no-merges
    --not

git branch
    -d
    -v
    --merged
    --no-merged
git checkout
    -b
    --track
git stash
    save
    list [<options>]
    show [<stash>]
    pop [--index] [-q|--quiet] [<stash>]
    apply [--index]
    drop [-q|--quiet] [<stash>]
    clear
    branch <branchname> [<stash>]

    create         // useful for scripting
    store          // useful for scripting
git merge
    --no-commit
    --squash
git rebase
    --onto
    -i
git cherry-pick


git diff
    --check
    --cached
git request-pull
git format-patch
    -M
git send-email
git apply
    --check
git am
    --resolved
    --skip
    --abort
    -3
    -i

git revert
git filter-branch
    --tree-filter
    --subdirectory-filter
    --commit-filter

git blame
    -L
    -C
git bisect
    start
    bad
    good
    reset

git submodule
    add
    init
    update
git read-tree
git diff-tree
# Other thing
set colorful output(this is default since 1.8.4)
    git config --global color.ui auto
    git config --global core.whitespace cr-at-eol

# Questions
why need two step: add & commit to commit? what's the difference?
    so you have more option and be more flexible when commit
what's the difference between `clone` and `remote add`?
    clonw will clone the repo to your local
    remote add only add a alias to remote repo address
what if I don't commit and don't stash then switch to other branch directly?
    you can't, if the working directory is not clean
add to git repo's directory from another directory? and sync the two?