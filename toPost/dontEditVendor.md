# Intro

说两个我在团队开发中遇见的真实例子:

团队的 PHP 项目多数使用 laravel 框架, 并使用 composer 来管理包依赖和进行自动加载.

我为项目写了一个 log 工具, 这个工具依赖 GuzzleHttp 包. 有一天我更新了一版代码之后, 发现 log 工具报错, 走查代码发现是因为 GuzzleHttp 包中的 Client 类被人改了. 这个包受 composer 管理, 很难预料到会有人直接改动它的源码.

另一个事儿:

同事试图通过 composer 安装 box/spout 包, composer 会自动更新所有项目依赖的包, 但是因为有些包 (比如 elasticsearch/elasticsearch) 的源码被改动, 如果继续安装的话, 会导致这些改动被冲掉, 所以只好放弃. 不知道现在找没找到不更新其他包的解决方案.

这两种问题都是因为直接改动 composer 所管理的包目录 `./vendor` 中的代码导致的.

**不要直接改动 `./vendor` 下的代码, 这应是每一个 PHP 开发的共识**

# ref
- irc
- https://www.reddit.com/r/PHP/comments/2s90fy/is_modifying_the_source_code_in_my_vendor_folder/
- https://janmarten.name/random/vendor-development.html
- composer documentation
    + https://getcomposer.org/doc/06-config.md#preferred-install
    + https://getcomposer.org/doc/articles/aliases.md#aliases
- https://stackoverflow.com/questions/19387387/how-to-edit-composer-loaded-vendor-code-the-right-way-in-php

# Understand

先理解下典型的 composer 使用流程:

1. 通过 `composer require` 来安装项目所依赖的包, 所有的 composer 包会被放到 `./vendor/` 目录中. 而这个目录应该被 vcs 忽略
2. composer 也会生成一个 `composer.lock` 文件, 这个文件包含了所有项目所依赖的包的版本快照. 通过自动构建运行 `composer install` 来根据这个快照安装响应版本的包
3. 假设有一个依赖的包发布了一个安全补丁, 则可以通过 `composer update` 来安装这个补丁

这个过程中有一点需要注意: `composer require` 和 `composer update` 的时候, composer 会自动检测各包有没有可用的版本更新, 并自动更新




- best practice: <https://blog.martinhujer.cz/17-tips-for-using-composer-efficiently/>
- typical composer dev flow, see <https://www.codementor.io/jadjoubran/php-tutorial-getting-started-with-composer-8sbn6fb6t>
- composer and `./vendor` directory
- composer isntallation strategy: auto(default), dist, source
    + dist -> don't edit
    + source -> good to go?
- `update` or `install` will auto update unrelated versions

# Why not
- `composer update` or `composer install` will accidentally blow away changes

If you change anything inside the vendor directory, your next composer update/install will write over your changes

you may break other's code who depend on the changed package. like YangLiang ALog

# When you can

most time, we don't need. unless you are
- the owner of the package, or
- a contributor of the pacakge

useful when patching bugs or writing new features

Whenever your package is installed using the source strategy, you are good to go on editing files in your vendor directory


`$ composer require --prefer-source monolog/monolog:1.23.0`
then edit logger.php
then edit composer.json `monolog/monolog:^1.24`

```bash
$ cd ./vendor/monolog/monolog/
$ git status
HEAD detached at 1.24.0
Changes not staged for commit:
  (use "git add <file>..." to update what will be committed)
  (use "git checkout -- <file>..." to discard changes in working directory)

    modified:   src/Monolog/Logger.php

no changes added to commit (use "git add" and/or "git commit -a")

$ cd -
$ composer status -v
You have changes in the following dependencies:
/Users/fanghao/Env/mine/www/uxin/qlog/vendor/monolog/monolog:
    M src/Monolog/Logger.php

$ composer update --prefer-source monolog/monolog
Loading composer repositories with package information
Updating dependencies (including require-dev)
Package operations: 0 installs, 1 update, 0 removals
  - Updating monolog/monolog (1.23.0 => 1.24.0):     The package has modified files:
    M src/Monolog/Logger.php
    Discard changes [y,n,v,d,s,?]? ?
    y - discard changes and apply the update
    n - abort the update and let you manually clean things up
    v - view modified files
    d - view local modifications (diff)
    s - stash changes and try to reapply them after the update
    ? - print help
    Discard changes [y,n,v,d,s,?]?
```

at this point, you can choose how to apply change, discard or release it

# Continually dev


# What should
- version only `composer.json` and `composer.lock`
- extending, not editing class
- replace alias in DIC

# Useful tools
- `composer status`
