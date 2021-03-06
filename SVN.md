#概念

- `repository`: 项目仓库
- `working copy`: 工作拷贝
- `checking out`: 签出
- `export`: 导出
- `committing`: 提交
- `update`: 更新
- `tag`: 标签
- `trunk`: 主干
- `branching`: 分支
- `merging`: 合并
- `lazy copy`: 延迟拷贝
- `strick locking`: 严格加锁(签出的所有文件都为 只读)
- `optimistic locking`: 乐观加锁(签出的所有文件都为 可写, 通过 合并 处理 冲突)
- `properties`: 属性, 可以通过编辑 Subversion 配置文件自动设置属性
    + `svn:keywords`
    + `svn:needs-lock`
    + `svn:ignore`
    + `svn:eol-style`
    + `svn:mime-type`
    + `svn:executable`
    + `svn:externals`
- `keyword`: 关键字
    + `$LastChangedDate$ | $Date$`
    + `$LastChangedRevision$ | $Revision$ | $Rev$`
    + `$LastChangedBy$ | $Author$`
    + `$HeadURL$ | $URL$`
    + `$Id$`
- `revision identifier`: 版本标志符, 可以使用 ":" 来指定一个版本范围
    + 数字
    + {日期}
    + HEAD: 最新版本
    + BASE: 最后签出版本
    + COMMITTED: 最后提交版本
    + PREV: 最后提交的前一版本
- 文件标志
    + `A`: 添加
    + `U`: 更新
    + `D`: 删除
    + `G`: 合并
    + `C`: 冲突


#原理
- 交互流程:

```
                                check out, update
Repository <------> Network <-------------------> Working copy
                                    commit
```

- Subversion 使用的是项目仓库整体编号, 而不是文件具体编号
- Subversion 使用乐观加锁, 而不是严格加锁
- Subversion 可以使用三种协议连接服务器: svn, svn+ssh, http
- Subversion 跟踪属性的方式和跟踪文件一样, 都可以回溯到之前版本
- 版本库下面的 svnserv.conf 指定权限文件, 配置用户和权限需修改这个文件

#命令
- `svn-version`
- `svnadmin-version`
- `svnadmin create`: 建立版本库
- `svn import`: 初始化导入
- `svnserve -d -r 版本库路径`: 启动 svn 服务

--- 

- `svn info` // view repo detail
- `svn ls <repo>` // git branch -a

---

- `svn checkout <branch> <folder>` // git clone
- `svn mkdir`
- `svn add`
- `svn copy <currentBranch> <newBranch> -m 'message'` // git checkout -b
- `svn switch <branch>` // git checkout <branch>
- `svn update` // git pull
- `svn merge` // git merge <branch>
- `svn move`
- `svn commit -m 'message'` // git commit && git push
- `svn commit <file> -m 'message'` // commit a single file

---

- `svn status` // git status
- `svn diff` // git diff

--- 

- `svn log`
- `svn log --diff`
- `svn log -r <revision>`
- `svn log <file> -v -l3` // git log -n 3
- `svn revert . -R` // revert changes
- `svn revert <file>` // git checkout <file>

- `svn resolve --accept working . -R`
// merge conflicts, accept whatever the current directory structure is at this time

- `svn blame`

- `svn propset`
- `svn propget`
- `svn proplist`
- `svn propedit`
- `svn propdel`

- `svn lock [--force]`
- `svn unlock [--force]`

#Q&A
- svn close commandline means close svn server? how to solve this?
- diff with color
    1. install colordiff
    2. run `svn diff | colordiff`
